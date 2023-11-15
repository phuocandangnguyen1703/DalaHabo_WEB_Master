@extends('admin.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Thông tin tài khoản</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="/admin">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Thông tin tài khoản</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="" role="alert" id="alert"></div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if(Auth::user()->image)
                            <img class="profile-user-img img-fluid img-circle admin-picture"
                                src="{{Auth::user()->image}}"
                                alt="User profile picture">
                            @else
                            <img class="profile-user-img img-fluid img-circle admin-picture"
                                src="/template/admin/dist/img/avatar6.png"
                                alt="User profile picture">
                            @endif
                        </div>

                        <h3 class="profile-username text-center admin-name">{{Auth::user()->name}}</h3>

                        <p class="text-muted text-center">{{Auth::user()->role->name}}</p>

                        <input type="file" name="admin_image" id="admin_image" style="opacity: 0; height: 1px; display:none" accept="image/*">
                        <a href="javascript:void(0)" class="btn btn-primary btn-block" id="change_avatar_btn">
                            <i class="fa fas fa-edit mr-1"></i> <b>Ảnh đại diện</b>  
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color:white;">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Thông tin</a></li>
                            <li class="nav-item"><a class="nav-link" href="#changepwd" data-toggle="tab">Đổi mật khẩu</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            @include('admin.alert')
                            <div class="active tab-pane" id="info">
                                <form action="" method="POST" id="profile-user-form">
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-11">
                                            <label for="email" class="col-form-label">Email đăng nhập</label>
                                            <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-5">
                                            <label for="name" class="col-form-label">Tên người dùng</label>
                                            <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" placeholder="Tên người dùng">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="role_id" class="col-form-label">Vai trò</label>
                                            <input type="text" name="role_id" value="{{Auth::user()->role->name}}" class="form-control" readonly>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="phone" class="col-form-label">Số điện thoại</label>
                                            <input type="text" name="phone" value="{{Auth::user()->phone}}" class="form-control" placeholder="Số điện thoại">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-group mb-0 mt-2">
                                            <button type="submit" class="btn btn-primary float-right">Cập nhật thông tin</button>
                                        </div>
                                    </div>
                                    @csrf
                                </form>
                            </div>

                            <div class="tab-pane" id="changepwd">
                                <form action="/admin/user-profile/change-password" method="POST" id="form-pwd">
                                    <input type="hidden" name="email" value="{{Auth::user()->email}}">
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-11">
                                            <label for="old_password" class="col-form-label">Mật khẩu cũ</label>
                                            <input type="password" name="old_password" class="form-control" placeholder="Mật khẩu cũ" id="old_password">
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-11">
                                            <label for="new_password" class="col-form-label">Mật khẩu mới</label>
                                            <input type="password" name="new_password" class="form-control" placeholder="Mật khẩu mới" id="new_password">
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-11">
                                            <label for="confirm_password" class="col-form-label">Xác nhận mật khẩu</label>
                                            <input type="password" name="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu">
                                        </div>
                                    </div>
                                    
                                    <div class="row justify-content-center">
                                        <div class="form-group mb-0 mt-2">
                                            <button type="submit" class="btn btn-primary float-right">Đổi mật khẩu</button>
                                        </div>
                                    </div>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')
<script>
    $(function () {
        $('#admin_image').ijaboCropTool({
            preview : '.admin-picture',
            setRatio:1,
            allowedExtensions: ['jpg', 'jpeg','png'],
            buttonsText:['CROP','QUIT'],
            buttonsColor:['#30bf7d','#ee5155', -15],
            processUrl:'{{ route("admin.update.picture") }}',
            onSuccess:function(message, element, status){
                alert(message);
            },
            onError:function(message, element, status){
                alert(message);
            }
       });
    });

    $(document).on('click', '#change_avatar_btn', function(){
        $('#admin_image').click();
    })

    $(document).on('submit', '#profile-user-form', function(e) {
        e.preventDefault();
    })
</script>
@endsection