@extends('admin.main')

@section('content')
@php
        use App\Helper\Helper as CustomHelper;
    @endphp
    <table >
        <thead >
            <tr style="border-bottom: 2px solid #777777;  height: 40px; ">
                <th style="width: 50px;">ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Danh Mục</th>
                <th>Giá Gốc</th>
                <th>Giá Khuyến Mại</th>
                <th>Ảnh</th>
                <th>Active</th>
                <th>Update</th>
                <th></th>
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $key =>$product)
            
         
                <tr style="height: 40px;">
                        <td>
                            {{$product->id}}
                        </td>
                        <td> {{$product->name}}</td>
                        <td> {{$product->menu->name}}</td>
                        <td> {{$product->price}}</td>
                        <td> {{$product->price_sale}}</td>
                        <td> <a href="{{$product->thumb}}" target="_blank">
                            <img src="{{$product->thumb}}" height="60px" alt="">
                        </a></td>
                        <td> {!! \App\Helper\Helper::active ($product->active) !!}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td> 
                        <a class="btn btn-primary btn-sm" href="/admin/product/edit/ {{$product->id}} "  >
                        <i class="ti-pencil-alt"></i>
                         </a>
                         <a class="btn btn-danger btn-sm" href="#" onclick="RemoveRow( {{$product->id }}, '/admin/product/destroy')">
                        <i class="ti-trash"></i>
                        </a> 
                        
                        </td>
                </tr>
                @endforeach
        </tbody>
    </table>
   
@endsection
