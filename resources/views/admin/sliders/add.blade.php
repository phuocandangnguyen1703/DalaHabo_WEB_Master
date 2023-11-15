@extends('admin.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>{{$title}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="/admin">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#"></a>{{$title}}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$menu}}</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{$menu}}</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="/admin/sliders/create" method="POST" id="add-slider-form">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-5">
                                <label for="name" class="col-form-label">Tên slider</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Tên slider">
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="col-form-label">Đường dẫn</label>
                                <input type="text" name="url" value="{{old('url')}}" class="form-control" placeholder="Đường dẫn">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <label class="col-form-label">Hình ảnh</label>
                                <div class="form-group custom-file">
                                    <input type="file" class="custom-file-input"  name="upload" id="upload" accept="image/*"> 
                                    <label class="custom-file-label" for="upload" name="file" id="file"></label>
                                    <input type="hidden" name="image" id="image">
                                    <input type="hidden" name="folder" value="sliders" id="folder">
                                </div>
                                <div id="image_show" class="mt-3 col-md-3 pl-0">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-11">
                                <label class="col-form-label">Trạng thái</label>
                                <div class="mt-2 ml-1 row">
                                    <div class="custom-control custom-radio col-5">
                                        <input class="custom-control-input" type="radio" value="1" id="active" name="active" checked>
                                        <label for="active" class="custom-control-label font-weight-normal">Hiển thị</label>
                                    </div>
                                    <div class="custom-control custom-radio col-5">
                                        <input class="custom-control-input" type="radio" value="0" id="inactive" name="active">
                                        <label for="inactive" class="custom-control-label font-weight-normal">Ẩn</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Tạo mới</button>
                    </div>
                    @csrf
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
@endsection

@section('footer')
    <script>
        $(function (e) {
            $('#add-slider-form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    upload: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Vui lòng nhập tên slider",
                    },
                    upload: {
                        required: "Vui lòng thêm hình ảnh",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection