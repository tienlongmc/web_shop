@extends('admin.main')

@section('content')
@php
        use App\Helper\Helper as CustomHelper;
    @endphp
    <table >
        <thead >
            <tr style="border-bottom: 2px solid #777777;  height: 40px; ">
                <th style="width: 50px;">ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 100px;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {!!CustomHelper::menus($menus)!!}
        </tbody>
    </table>
   
@endsection
