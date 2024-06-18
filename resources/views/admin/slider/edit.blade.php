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
                            <label for="menu">Tiêu đề</label>
                            <input type="text" name="name" value="{{$slider->name}}" class="form-control" id="name" placeholder="Enter title">
                        </th>
                        <th style="width:40%">  
                            <label for="menu">Đường dẫn</label>
                            <input type="text" name="url" value="{{$slider->url}}" class="form-control" id="name" placeholder="Enter url">
                        </th> 
                    </tr>
                    <tr>
                        
                    </tr>
                    </table>
                  </div>
                
                  <div class="form-group">
                    <label for="menu">Sắp xếp</label>
                  <input class="form-control" name="sort_by" type="number" value ="{{$slider->sort_by}}">
                 
                 
                  <div class="form-group">
                    <label for="menu">Ảnh minh họa</label>
                  <input class="form-control" name="file" type="file" id="upload">
                  <div id="image_show">
                      <a href="{{$slider->thumb}}"><img src="{{$slider->thumb}}" width="100px" alt=""></a>
                  </div>
                  <input type="hidden" name="thumb" id="thumb">
                  </div>

                        <div class="form-group">
                       <label for="">Kích Hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input custom-control-input-danger" type="radio" id="active" name="active" value="1" {{$slider->active==1 ? 'checked':''}}>
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" value="0"  id="no_active" name="active" {{$slider->active==0 ? 'checked':''}}>
                          <label for="active" class="custom-control-label">Không</label>
                        </div>
                      </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Tạo Slider</button>
                </div>
                
              </form>
              <!-- <script src="/templates/admin/js/main.js"></script> -->
            
@endsection

@section('foot')
