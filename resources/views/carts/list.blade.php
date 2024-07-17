@extends('main')

@section('content')
<style>
  /* Đặt màu nền ban đầu cho các hàng trong bảng */
  .table_row .delete_link {
        background-color: transparent;
    }

    /* Định nghĩa keyframes để thay đổi màu nền */
    @keyframes ChangeColor {
        from {
            background-color: transparent;
        }
        to {
			border-color: #717fe0;
			background-color: #717fe0;
        }
    }

    /* Áp dụng hiệu ứng chuyển màu cho hàng cha của delete_link khi hover */
    .delete_link:hover {
        animation: ChangeColor 2s forwards;
		animation-iteration-count: 1;
		cursor: pointer;
    }

    /* Để đảm bảo rằng chỉ hàng hiện tại được chuyển màu */
    .delete_link:hover i {
        color: darkblue
     } 
	
   .stext-111,.bor8{
	font-family: "Playwrite AU VIC", cursive;
   }
</style>


<form class="bg0 p-t-75 p-b-85 m-t-40" method="post">
@include('admin.alert')
@if(count($products) != 0)
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50 p-r-40">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							 @php $total = 0; @endphp
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4" style="text-align:center;">Quantity</th>
									<th class="column-5">Total</th>
									<th class="column-6"></th>
								</tr>
                           @foreach ($products as $key =>$product )
						  @php
						  $price = $product->price_sale != 0 ?$product->price_sale: $product->price ;
						  $price_end = $price * $carts[$product->id];
						  $total += $price_end;
						  @endphp
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="{{$product->thumb}}" alt="IMG">
										</div>
									</td>
									<td class="column-2" >{{$product->name}}</td>
									<td class="column-3">{{$price}}</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num_product[{{$product->id}}]" value="{{$carts[$product->id]}}">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5">{{$price_end}}</td>
									<th class="column-5 delete_link" data-href="/carts/delete/{{ $product->id }}"><a href="/carts/delete/{{ $product->id }}"><i class="zmdi zmdi-delete" style="font-size: 30px; text-align: center;"></i></a></th>
								</tr>
								@endforeach	
								
							</table>
							
							
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>
							<input type="submit" value="Update Cart"   formaction="/update-cart"
                                    class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                @csrf
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50" >
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30 fontne">
							Cart Total
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
								{{number_format($total,0,'','.')}}
								</span>
							</div>
						</div>

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm" style="font-family: none;">
								<p class="stext-111 cl6 p-t-2">
									There are no shipping methods available. Please double check your address, or contact us if you need any help.
								</p>
								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										Thông tin khách hàng
									</span>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="time">
											<option>Select a country...</option>
											<option>Viet Nam</option>
											<option>Trung Quốc</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" placeholder="Tên khách hàng" required>
									</div>
									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" placeholder="Số điện thoại" required>
									</div>
									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" placeholder="Địa Chỉ" required>
									</div>
									<div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="email" placeholder="Email Liên Hệ">
                                        </div>

                                        <div class="bor8 bg0 m-b-12">
                                            <textarea class="cl8 plh3 size-111 p-lr-15" name="content"  placeholder="Ghi Chú"></textarea>
                                        </div>
										
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
								{{number_format($total,0,'','.')}}
								</span>
							</div>
						</div>

						<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                               Đặt Hàng
                            </button>
					</div>
				</div>
			</div>
		</div>
	
	</form>
	<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete_link').forEach(function(th) {
            th.addEventListener('click', function() {
                window.location.href = th.getAttribute('data-href');
            });
        });
    });
</script>
	@else
			<div class="text-center">Giỏ hàng trống</div>
	@endif
@endsection