@extends('layouts/contentNavbarLayout')

@section('title', 'Thêm hãng bay')

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Sửa thông tin máy bay</h5>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <ul>

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <form action="{{ route('admin.airplane.edit',['id'=>$itemEdit->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="infor">Tên hãng máy bay</label>
                        <select name="airplane_brand" id="" class="form-control">
                            @foreach ($airplane_brand as $item)
                                <option value="{{ $item->id }}" @selected($item->id == $itemEdit->airplane_brand_id)>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="airplane_name">Tên máy bay</label>
                        <input type="text" class="form-control" id="airplane_name" value="{{ $itemEdit->airplane_name }}" name="airplane_name" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="qty_seat">Số chỗ</label>
                        <input type="number" class="form-control" min='1' id="qty_seat" value="{{ $itemEdit->qty_seat }}" name="qty_seat" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="about">Thông tin</label>
                        <textarea name="about" class="form-control" id="about">{{ $itemEdit->about }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0" @selected($itemEdit->status == 0)>Không hoạt động</option>
                            <option value="1" @selected($itemEdit->status == 1)>Hoạt động</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </form>
            </div>
        </div>
    </div>

@endsection
