@extends('layouts/contentNavbarLayout')

@section('title', 'Thêm hãng bay')

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Sửa chuyến bay</h5>
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
                <form action="{{ route('admin.flight.edit', ['id' => $itemEdit->id]) }}" method="POST"  enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="infor">Máy bay</label>
                        <select name="airplane" id="" class="form-control">
                            <option value="">--Mời chọn--</option>
                            @foreach ($listAirplane as $item)
                                <option value="{{ $item->id }}" @selected($item->id == $itemEdit->airplane_id)>{{ $item->airplane_name}} ({{ ucfirst($item->name) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="flight_name">Tên chuyến bay</label>
                        <input type="text" class="form-control" id="flight_name" value="{{ $itemEdit->name }}" name="flight_name" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="location_start">Địa điểm bắt đầu</label>
                        <input type="text" class="form-control" id="location_start" value="{{ $itemEdit->location_start }}" name="location_start" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="location_end">Địa điểm kết thúc</label>
                        <input type="text" class="form-control" id="location_end" value="{{ $itemEdit->location_end }}" name="location_end" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="time_start">Thời gian</label>
                        <input type="datetime-local" class="form-control" id="time_start" value="{{ $itemEdit->time_start }}" name="time_start" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="information">Thông tin chuyến bay</label>
                        <textarea name="information" class="form-control" id="information">{{ $itemEdit->information }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="about">Loại đi</label>
                        <select name="type_way" id="status" class="form-control">
                            <option value="1 chiều" @selected($itemEdit->type_way== '1 chiều')>1 chiều</option>
                            <option value="2 chiều"@selected($itemEdit->type_way== '2 chiều')>2 chiều</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Giá</label>
                        <input type="number" class="form-control" min="1" id="price" value="{{ $itemEdit->price }}" name="price" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="image">Ảnh</label>
                        <input type="file" name="image" accept="image/*"
                        class="form-control-file form-control @error('image') is-invalid @enderror" id="cmt_truoc">
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-8">
                            <div class="row">
                                <div class="col-xs-6">
                                    <img id="mat_truoc_preview"
                                        src="{{ Storage::url( $itemEdit->image) }}"
                                        alt="your image" style="max-width: 200px; height:100px; margin-bottom: 10px;"
                                        class="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0" @selected($itemEdit->status== 0)>Không hoạt động</option>
                            <option value="1" @selected($itemEdit->status== 1)>Hoạt động</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(function() {
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $(selector).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#cmt_truoc").change(function() {
                readURL(this, '#mat_truoc_preview');
            });

        });
    </script>
@endsection