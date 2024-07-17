<?php


namespace App\Http\Services;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use GuzzleHttp\Psr7\Request;
use App\Models\Customer;
use App\Models\Carts;
use App\Jobs\SendMail;

class CartService
{
    public function create($request)
    {
        
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');
        
        if ($qty <= 0 || $product_id <= 0) {
            Session()->flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }
        
        $carts = Session()->get('carts'); // Đảm bảo $carts luôn là một mảng
        // if (!is_array($carts)) {
        //     $carts = [];
        // }
        if (!isset($carts[$product_id])) {
            // Nếu sản phẩm chưa tồn tại, thêm vào giỏ hàng
            $carts[$product_id] = $qty;
        } else {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
            $carts[$product_id] += $qty;
        }
        
        Session()->put('carts', $carts);
        return true;
    }
    public function getProduct(){
        $carts = Session()->get('carts');
        if(is_null($carts)){
            return [];
        }
        $product_id = array_keys($carts);
        return Product::select('id','name','price_sale','thumb')
        ->where('active',1)
        ->whereIn('id',$product_id)
        ->get();
    }
    public function update($request)
    {
        Session()->put('carts', $request->input('num_product'));
        return true;
    }
    public function remove($id){
        $carts = Session()->get('carts');
        unset($carts[$id]);  
        Session()->put('carts', $carts);
    }
    public function addCart($request){
        try{
            DB::beginTransaction();
            $carts = Session()->get('carts'); // Đảm bảo $carts luôn là một mảng
            if (is_null($carts)) return false;

            $customer = Customer::create([
                'name' => $request->input('name'),
                'phone'=> $request->input('phone'),
                'address'=> $request->input('address'),
                'email'=> $request->input('email'),
                'content'=> $request->input('content')
            ]);
            
          
            $this->inforProductCart($carts,$customer->id);

            DB::commit();
            $customer_id = $customer->id;
            Session()->flash('success','Đặt Hàng Thành Công');
            SendMail::dispatch($request->input('email'), $customer_id)->delay(now()->addSeconds(30));
            Session()->forget('carts');
        }catch(\Exception $err){
            DB::rollBack();
            Session()->flash('err','Lỗi đặt hàng rồi gọi tổng đài để tý fix');
            return false;
        }
        return true;
    }
    protected function inforProductCart($carts,$customer_id){
        $product_id = array_keys($carts);
        $products= Product::select('id','name','price_sale','thumb')
        ->where('active',1)
        ->whereIn('id',$product_id)
        ->get();


        $data = [];
        foreach ( $products as $key =>$product ){
            $price = $carts[$product->id] * ( $product->price_sale != 0 ?$product->price_sale:$product->price);
            $data[] = [
                'customer_id' =>$customer_id,
                'product_id' =>$product->id,
                'pty' => $carts[$product->id],
                'price' => $price
            ];
        }
        return Carts::insert($data);
       
    }
}