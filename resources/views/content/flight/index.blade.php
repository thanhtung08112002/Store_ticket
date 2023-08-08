@extends('layouts/contentNavbarLayout')

@section('title', 'Quản lý máy bay')

@section('content')
    <div class="card">
        <h5 class="card-header">Quản lý chuyến bay</h5>
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif
        <div class="table-responsive text-nowrap">
            <a href="{{ route('admin.flight.formAdd') }}"> <button class="btn btn-primary mb-5">Thêm chuyến
                    bay</button></a>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên máy bay</th>
                        <th>Tên chuyến bay</th>
                        <th>Ảnh</th>
                        <th>Số chỗ</th>
                        <th>Địa điểm bắt đầu</th>
                        <th>Địa điểm kết thúc</th>
                        <th>Thời gian</th>
                        <th>Thông tin chuyến bay</th>
                        <th>Loại đi</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($list as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->airplane_name }}</td>
                            <td>{{ $item->name }}</td>
                            <td><img width="100px" height="100px" src="{{ Storage::url(  $item->image) }}" alt=""></td>
                            <td>{{ $item->qty_seat }}</td>
                            <td>{{ $item->location_start }}</td>
                            <td>{{ $item->location_end }}</td>
                            <td>{{ $item->time_start }}</td>
                            <td><textarea name="" id="" disabled cols="30" rows="10">{{ $item->information }}</textarea></td>
                            <td>{{ $item->type_way }}</td>
                            <td>{{ $item->price }}</td>
                            <td><span  class="badge bg-label-primary me-1"> {{ $item->status == 0 ? 'Chưa hoạt động' : 'Đã hoạt động' }}</span></td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td> <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('admin.flight.formEdit', ['id' => $item->id]) }}"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Sửa</a>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.flight.remove', ['id' => $item->id]) }}"
                                        onclick="return confirm('Bạn chắc chưa?')"><i class="bx bx-trash me-1"></i>
                                        Xóa</a>
                                </div>
                            </div></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
