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
                    <li class="breadcrumb-item"><a href="/admin/users/all">{{$menu}}</a></li>
                    <li class="breadcrumb-item"><a href="#"></a>{{$item}}</li>
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
                <form action="/admin/users/edit/{{$user->id}}" method="POST" id="edit-user-form">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label for="email" class="col-form-label">Email đăng nhập</label>
                                <input type="text" name="email" value="{{$user->email}}" class="form-control" placeholder="Email đăng nhập" readonly>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-md-5">
                                <label for="name" class="col-form-label">Tên hiển thị</label>
                                <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Tên hiển thị">
                                <span class="error invalid-feedback name_error"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="role_id" class="col-form-label">Vai trò</label>
                                <select name="role_id" class="form-control">    
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}" {{$user->role_id === $role->id ? 'selected' : ''}}>
                                            {{$role->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="phone" class="col-form-label">Số điện thoại</label>
                                <input type="text" name="phone" value="{{$user->phone}}" class="form-control" placeholder="Số điện thoại">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Cập nhật</button>
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
        $(function () {
            $('#edit-user-form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Vui lòng nhập tên hiển thị",
                    }
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