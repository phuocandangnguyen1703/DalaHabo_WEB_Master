@extends('admin.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>{{$menu}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="/admin">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">{{$title}}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$menu}}</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    @include('admin.alert')
    <div class="card">
        <div class="card-header">
            <!-- <h3 class="card-title"><strong>{{$menu}}</strong></h3>

            <div class="pl-3 m-0 float-right">
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 350px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Tiêu đề, đường dẫn, trạng thái,...">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div> -->

            <form action="" class="form-inline" role="form">
                <div class="input-group input-group-sm" style="width: 250px">
                    <label for="keyword" class="sr-only"></label>
                    <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-header -->

        <div class="card-body p-0 table-responsive">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width:8%">ID</th>
                        <th style="width:12%">Tiêu đề</th>
                        <th style="width:10%">Tác giả</th>
                        <th style="width:20%">Tóm tắt</th>
                        <th style="width:10%">Thumbnail</th>
                        <th style="width:10%">Ngày đăng</th>
                        <th style="width:10%">Ngày cập nhật</th>
                        <th style="width:10%" class="text-center">Sửa/Xóa</th>
                    </tr>
                </thead>

                <tbody >
                        <tr>
                            <td>1.</td>
                            <td>7 địa điểm không thể bỏ qua khi đến Đà Lạt</td>
                            <td>Gia Hân</td>
                            <td>7 địa điểm không thể bỏ qua khi đến Đà Lạt khi đến Đà Lạt khi đến Đà Lạt khi đến Đà Lạt khi đến Đà Lạt</td>
                            <td>
                                <a href="/storage/uploads/places/PIMG2021120761aec88023758.jpg" target="_blank">
                                    <img src="/storage/uploads/places/PIMG2021120761aec88023758.jpg" width="100%">
                                </a>
                            </td>
                            <td class="timestamp">2021-12-01 22:11:07</td>
                            <td class="timestamp">2021-12-02 02:09:16</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm " href="#">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                   
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer clearfix">
            
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</section>
@endsection