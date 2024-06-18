@extends('admin.main')

@section('content')
@php
        use App\Helper\Helper as CustomHelper;
    @endphp
    <table >
        <thead >
            <tr style="border-bottom: 2px solid #777777;  height: 40px; ">
                <th style="width: 50px;">ID</th>
                <th>Tiêu đề</th>
                <th>Link dẫn</th>
                <th>Ảnh</th>
                <th>Active</th>
                <th>Update</th>
                <th></th>
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $key =>$slider)
            
         
                <tr style="height: 40px;">
                        <td>
                            {{$slider->id}}
                        </td>
                        <td> {{$slider->name}}</td>
                        
                        <td> {{$slider->url}}</td>
                        <td> <a href="{{$slider->thumb}}" target="_blank">
                            <img src="{{$slider->thumb}}" height="60px" alt="">
                        </a></td>
                        <td> {!! \App\Helper\Helper::active ($slider->active) !!}</td>
                        <td>{{ $slider->updated_at }}</td>
                        <td> 
                        <a class="btn btn-primary btn-sm" href="/admin/slider/edit/ {{$slider->id}} "  >
                        <i class="ti-pencil-alt"></i>
                         </a>
                         <a class="btn btn-danger btn-sm" href="#" onclick="RemoveRow( {{$slider->id }}, '/admin/slider/destroy')">
                        <i class="ti-trash"></i>
                        </a> 
                        
                        </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
    {{ $sliders->links()}}
    </div>
@endsection
