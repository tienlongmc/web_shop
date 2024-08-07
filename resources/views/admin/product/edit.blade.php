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
                            <input type="text" name="name" value="{{$product->name}}" class="form-control" id="name" placeholder="Enter name">
                        </th>
                        <th style="width:40%">  
                            <label for="menu">Danh Mục</label>
                            <select name ="menu_id" class="form-control" id="">
                           
                            @foreach($menus as $menu)
                                <option  value="{{$menu->id}}" {{$product->menu_id==$menu->id? 'selected' : ' '}} >{{$menu->name}}</option>
                            @endforeach
                            </select>
                        </th> 
                    </tr>
                    <tr>
                        <th style="width:40%;padding: 20px 20px 0 0"> 
                            <div class="form-group">
                                <label for="menu">Giá gốc: </label>
                                <input type="number"  value="{{$product->price}}"  name="price" class="form-control" id="price">
                            </div>
                        </th>
                        <th style="width:40%;padding: 20px 20px 0 0">  
                            <div class="form-group">
                                <label for="menu">Giá giảm: </label>
                                <input type="number" name="price_sale"  value="{{$product->price_sale}}"  class="form-control" id="price_sale">
                            </div>
                        </th> 
                    </tr>
                    </table>
                  </div>
                
                  <div class="form-group">
                    <label for="menu">Mô tả</label>
                   <textarea name="description" value=""  class="form-control" id="" cols="30" rows="4">{{$product->description }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="menu">Mô tả chi tiết</label>
                    <textarea name="content" id="content" class="form-control" cols="30" rows="4">{{ $product->content }}</textarea>
                  </div>
                 
                  <div class="form-group">
                    <label for="menu">Ảnh minh họa</label>
                  <input class="form-control" name="file" type="file" id="upload">
                  <div id="image_show">
                        <a href="$product->thumb" target = "_blank">
                            <img src="{{$product->thumb}}" width="100px" alt="Ảnh không hoạt động">
                        </a>
                  </div>
                  <input type="hidden" name="thumb" value="{{$product->thumb}}" id="thumb">
                  </div>
                       
                        <div class="form-group">
                       <label for="">Kích Hoạt</label>
                            <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                              {{ $product->active == 1 ? ' checked=""' : '' }}>
                          <label for="active" class="custom-control-label">Có</label>
                      </div>
                      <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                              {{ $product->active == 0 ? ' checked=""' : '' }}>
                          <label for="no_active" class="custom-control-label">Không</label>
                      </div>
                      </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhập Sản Phẩm</button>
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