
<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.header')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h2"><b>DalaHabo Admin</b></a>
        </div>
        
        <div class="card-body">
            <h4 style="padding-bottom: 8px;" class="text-center">Đăng nhập</h4>

            @include('admin.alert')

            <form action="/admin/login/store" method="post">
                <div class="input-group mb-3">
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
            
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-7">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember_token" id="remember_token">
                            <label for="remember_token" class="font-weight-normal">Lưu mật khẩu</label>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-2 mb-3">
                    <button type="submit" class="btn btn-block btn-primary">Đăng nhập</button>
                </div>
               
                
                @csrf
            </form>
            
            <!-- <div class="social-auth-links text-center mt-2 mb-3">
                <hr data-content="Hoặc" class="hr-text mb-4 mt-4">
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Đăng nhập với Google+
                </a>
            </div> -->

            <p class="mb-1">
                Bạn quên mật khẩu? <a href="/admin/forgot-password">Đặt lại mật khẩu</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
    @include('admin.footer')
</body>
</html>
