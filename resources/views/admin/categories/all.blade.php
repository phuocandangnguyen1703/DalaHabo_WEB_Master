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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$menu}}</h3>
            <div class="col">
                <!-- <div class="float-left">
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
                </div> -->

                <div class="float-right">
                    <!-- <a class="btn btn-default btn-sm mr-1" href="/admin/sliders/create">
                        <i class="fas fa-print mr-1"></i> <span>Excel</span> 
                    </a> -->
                    <button class="btn btn-danger btn-sm d-none" id="deleteAllBtn" onClick="removeAll('/admin/categories/destroy-selected', 'categories-table')">
                        Xóa
                    </button>
                </div>
            </div>
            
        </div>
        <!-- /.card-header -->

        <div class="card-body p-0 table-responsive">
        
            <table class="table table-hover table-bordered table-striped" id="categories-table">
                <thead>
                    <tr>
                        <th style="width:2%"><input type="checkbox" name="main_checkbox"><label></label></th>
                        <th style="width:8%">STT</th>
                        <th style="width:20%">Tên danh mục</th>
                        <th style="width:45%">Mô tả</th>
                        <th style="width:10%" class="text-center">Trạng thái</th>
                        <th style="width:10%" class="text-center">Sửa/Xóa</th>
                    </tr>
                </thead>

                <tbody>
                    {!! \App\Helpers\Helper::category($categories) !!}
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer clearfix" id="count">
            <?php $count = count($categories); ?>
            <?php if($count === 0) : ?>
                <strong>Chưa có dữ liệu</strong>
            <?php else : ?>
                <strong>Số lượng: {{$count}}</strong>
            <?php endif; ?>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</section>
@endsection