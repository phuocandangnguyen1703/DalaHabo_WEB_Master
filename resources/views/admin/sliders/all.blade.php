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
                    <li class="breadcrumb-item">{{$title}}</li>
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
                    <form action="" role="form" style="width: 400px">
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
                    <button class="btn btn-danger btn-sm d-none" id="deleteAllBtn" onClick="removeAll('/admin/sliders/destroy-selected', 'sliders-table')">
                        Xóa
                    </button>
                </div>
                
            </div>
            
        </div>
        <!-- /.card-header -->

        <div class="card-body p-0 table-responsive">
            <table class="table table-hover table-bordered table-striped" id="sliders-table">
                <thead>
                    <tr>
                        <th style="width:2%"><input type="checkbox" name="main_checkbox"><label></label></th>
                        <th style="width:8%">STT</th>
                        <th>Tên slider</th>
                        <th>Đường dẫn</th>
                        <th style="width:20%">Hình ảnh</th>
                        <th style="width:15%">Ngày cập nhật</th>
                        <th style="width:10%" class="text-center">Trạng thái</th>
                        <th style="width:10%" class="text-center">Sửa/ Xóa</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($sliders as $key => $slider)
                        <tr id="{{$slider->id}}" name="item">
                            <td>
                                <input type="checkbox" id="item_checkbox" name="item_checkbox" data-id="{{$slider->id}}">
                                <!-- <label for="slider_checkbox"></label> -->
                            </td>
                            <td>{{$key + 1}}.</td>
                            <td>{{$slider->name}}</td>
                            <td>{{$slider->url}}</td>
                            <td>
                                <a href="{{$slider->image}}" target="_blank">
                                    <img src="{{$slider->image}}" width="60%">
                                </a>
                            </td>
                            <td class="timestamp">{{$slider->updated_at}}</td>
                            <td class="text-center">
                                {!! \App\Helpers\Helper::active($slider->active) !!}
                            </td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm " href="/admin/sliders/edit/{{$slider->id}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger btn-sm" href="#"
                                    onClick="removeRow('{{$slider->id}}', '/admin/sliders/destroy', 'sliders-table')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer clearfix" id="count">
            <?php $count = count($sliders); ?>
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