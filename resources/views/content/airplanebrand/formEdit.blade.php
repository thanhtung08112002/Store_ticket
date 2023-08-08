@extends('layouts/contentNavbarLayout')

@section('title', 'Thêm hãng bay')

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Sửa hãng bay</h5>
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
                <form action="{{ route('admin.airplane_brand.edit',['id'=>$itemEdit->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="name">Tên hãng</label>
                        <input type="text" class="form-control" id="name" value="{{ $itemEdit->name }}" name="name" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="infor">Thông tin</label>
                        <textarea name="information" class="form-control" id="" cols="30" rows="10">{{ $itemEdit->name }}</textarea>
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
