@extends('admin.main')
@section('head')
    <script src="/ckeditor5-build-classic/ckeditor.js"></script>
@endsection


@section('content')
<!-- <script src="/templates/admin/js/main.js"></script> -->



<form action=""  method="POST" enctype="multipart/form-data">
     <!-- tạo token -->
    @csrf
                <div class="card-body">
                  <div class="form-group" >
                    
                    <table style="width:100%" >
                    <tr>
                        <th style="width:40%;padding: 0 20px 0 0"> 
                            <label for="menu">Tên Sản Phẩm</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Enter name">
                        </th>
                        <th style="width:40%">  
                            <label for="menu">Danh Mục</label>
                            <select name ="menu_id" class="form-control" id="">
                           
                            @foreach($menus as $menu)
                                <option  value="{{$menu->id}}" >{{$menu->name}}</option>
                            @endforeach
                            </select>
                        </th> 
                    </tr>
                    <tr>
                        <th style="width:40%;padding: 20px 20px 0 0"> 
                            <div class="form-group">
                                <label for="menu">Giá gốc: </label>
                                <input type="number" name="price" class="form-control" id="price">
                            </div>
                        </th>
                        <th style="width:40%;padding: 20px 20px 0 0">  
                            <div class="form-group">
                                <label for="menu">Giá giảm: </label>
                                <input type="number" name="price_sale" class="form-control" id="price_sale">
                            </div>
                        </th> 
                    </tr>
                    </table>
                  </div>
                
                  <div class="form-group">
                    <label for="menu">Mô Tả</label>
                   <textarea name="description"  class="form-control" id="" cols="30" rows="4"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="menu">Mô Tả Chi Tiết</label>
                    <textarea name="content" id ="content"  class="form-control" id="" cols="30" rows="4"></textarea>
                  </div>
                 
                  <div class="form-group">
                    <label for="menu">Input Img</label>
                  <input class="form-control" name="file" type="file" id="upload">
                  <div id="image_show">

                  </div>
                  <input type="hidden" name="thumb" id="thumb">
                  </div>
                       
                        <div class="form-group">
                       <label for="">Kích Hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input custom-control-input-danger" type="radio" id="active" name="active" value="1" checked="">
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" value="0"  id="no_active" name="active">
                          <label for="active" class="custom-control-label">Không</label>
                        </div>
                      </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Tạo Sản Phẩm</button>
                </div>
                
              </form>
              <!-- <script src="/templates/admin/js/main.js"></script> -->
            
@endsection

@section('foot')
<script>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
            
    </script>
@endsection