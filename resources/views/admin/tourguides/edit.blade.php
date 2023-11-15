@extends('admin.main')

@section('header')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <h1>{{$title}}</h1>
            </div>
            <div class="col-sm-8">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="/admin">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#"></a>{{$title}}</li>
                    <li class="breadcrumb-item"><a href="/admin/tourguides/all">{{$menu}}</a></li>
                    <li class="breadcrumb-item">{{$item}}</li>
                    <li class="breadcrumb-item active" aria-current="page">Cập nhật</li>
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
                    <h3 class="card-title">{{$item}}</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="/admin/tourguides/edit/{{$tourguide->id}}" method="POST" id="edit-tourguide-form">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-4">
                                <label for="name" class="col-form-label">Họ tên</label>
                                <input type="text" name="name" value="{{$tourguide->name}}" class="form-control" placeholder="Họ tên">
                                <span class="error invalid-feedback name_error"></span>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="gender" class="col-form-label">Giới tính</label>
                                <select name="gender" class="form-control">
                                    <option value="0" {{$tourguide->gender === 0 ? 'selected' : ''}}>Nam</option>
                                    <option value="1" {{$tourguide->gender === 1 ? 'selected' : ''}}>Nữ</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="dob" class="col-form-label">Ngày sinh</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" name="dob" value="{{$tourguide->dob}}" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Ngày sinh"/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <span class="error invalid-feedback dob_error"></span>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Email</label>
                                <input type="text" name="email" value="{{$tourguide->email}}" class="form-control" placeholder="Email liên lạc">
                                <span class="error invalid-feedback email_error"></span>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="name" class="col-form-label">Số điện thoại</label>
                                <input type="text" name="phone" value="{{$tourguide->phone}}" class="form-control" placeholder="Số điện thoại liên lạc">
                                <span class="error invalid-feedback phone_error"></span>
                            </div> 
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label for="price" class="col-form-label">Giá thuê (VNĐ/Giờ)</label>
                                <input type="text" name="rental_price" value="{{$tourguide->rental_price}}" class="form-control" placeholder="Giá thuê">
                                <span class="error invalid-feedback rental_price_error"></span>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label class="col-form-label">Tóm tắt</label>
                                <textarea style="resize:none" rows="4" name="short_description" class="form-control" id="summary" placeholder="Tóm tắt về hướng dẫn viên..">{{$tourguide->short_description}}</textarea>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label class="col-form-label">Mô tả chi tiết</label>
                                <textarea name="description" class="form-control" id="description" placeholder="Mô tả địa điểm">{{$tourguide->description}}</textarea>
                            </div>
                            
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Cập nhật</button>
                        <a class="btn btn-light" href="{{url()->previous()}}" onClick="">
                            <i class="fas fa-chevron-left mr-2"></i>
                            <span>Trở về</span>
                        </a>
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
        CKEDITOR.replace('description', {
            extraPlugins: 'editorplaceholder',
            height: 200,
            resize_minWidth: 200,
            resize_minHeight: 300,
            editorplaceholder: 'Mô tả chi tiết về hướng dẫn viên...',
            removeButtons: 'PasteFromWord',
            filebrowserImageUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.config.toolbarGroups = [
            { name: 'mode'},
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
            { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
            { name: 'links' },
            { name: 'insert' },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'styles' },
            { name: 'colors' },
            { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align'] },
            { name: 'tools'}
        ]
    </script>

    <script>
        $(function () {
            $('#edit-tourguide-form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                    },
                    rental_price: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Vui lòng nhập họ tên"
                    },
                    email: {
                        required: "Vui lòng nhập email",
                        email: "Email không hợp lệ"
                    },
                    phone: {
                        required: "Vui lòng nhập số điện thoại"
                    },
                    rental_price: {
                        required: "Vui lòng nhập giá thuê"
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
                }
            });
        });
    </script>
@endsection