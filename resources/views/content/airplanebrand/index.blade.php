@extends('layouts/contentNavbarLayout')

@section('title', 'Quản lý hãng bay')

@section('content')
    <div class="card">
        <h5 class="card-header">Quản lý hãng bay</h5>
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif
        <div class="table-responsive text-nowrap">
            <a href="{{ route('admin.airplane_brand.formAdd') }}"> <button class="btn btn-primary mb-5">Thêm hãng
                    bay</button></a>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên hãng bay</th>
                        <th>Thông tin</th>
                        <th>Trạng thái</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($list as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $item->name }}</strong>
                            </td>
                            <td><textarea name="" id="" disabled cols="30" rows="10">{{ $item->information }}</textarea></td>
                            <td><span
                                    class="badge bg-label-primary me-1">{{ $item->status == 0 ? 'Chưa hoạt động' : 'Hoạt động' }}</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.airplane_brand.formEdit', ['id' => $item->id]) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Sửa</a>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.airplane_brand.remove', ['id' => $item->id]) }}" onclick="return confirm('Bạn chắc chưa?')"><i
                                                class="bx bx-trash me-1"></i>
                                            Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
