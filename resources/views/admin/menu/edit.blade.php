@extends('admin.main')
@section('head')
    <script src="/ckeditor5-build-classic/ckeditor.js"></script>
@endsection
@section('content')
<form action="" method="POST">
     <!-- tạo token -->
    @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="menu">Tên Danh Mục</label>
                    <input type="text" name="name" value="{{$menu->name}}" class="form-control" id="name" placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label for="menu">Danh Mục</label>
                    <select name="parent_id" class="form-control" id="">
                        <option value="0" {{$menu->parent_id==0 ? 'selected':''}} >Danh Mục Cha</option>
                        @foreach($menus as $menuParent)
                      
                        <option value="{{$menuParent->id}}" 
                        {{ $menu->parent_id==$menuParent->id ? 'selected': ''}} >
                        {{$menuParent->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="menu">Mô Tả</label>
                   <textarea name="description"  class="form-control" id="" cols="30" rows="4">{{$menu->description}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="menu">Mô Tả Chi Tiết</label>
                    <textarea name="content" id ="content"  class="form-control" id="" cols="30" rows="4">{{$menu->content}}</textarea>
                  </div>
                  <div class="form-group">
                       <label for="">Kích Hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input custom-control-input-danger" value="1" type="radio" id="active" name="active" {{$menu->active== 1 ? 'checked=""':''}}>
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" value="0"  id="no_active" name="active"  {{$menu->active==0? 'checked=""':''}}>
                          <label for="active" class="custom-control-label">không</label>
                        </div>
                      </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhập Danh Mục</button>
                </div>
              </form>
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