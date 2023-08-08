@extends('layouts/contentNavbarLayout')

@section('title', 'Thêm hãng bay')

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Thêm chuyến bay</h5>
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
                <form action="{{ route('admin.flight.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="infor">Máy bay</label>
                        <select name="airplane" id="" class="form-control">
                            <option value="">--Mời chọn--</option>
                            @foreach ($listAirplane as $item)
                                <option value="{{ $item->id }}">{{ $item->airplane_name}} ({{ ucfirst($item->name) }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="flight_name">Tên chuyến bay</label>
                        <input type="text" class="form-control" id="flight_name" name="flight_name" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="location_start">Địa điểm bắt đầu</label>
                        <input type="text" class="form-control" id="location_start" name="location_start" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="location_end">Địa điểm kết thúc</label>
                        <input type="text" class="form-control" id="location_end" name="location_end" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="time_start">Thời gian</label>
                        <input type="datetime-local" class="form-control" id="time_start" name="time_start" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="information">Thông tin chuyến bay</label>
                        <textarea name="information" class="form-control" id="information"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="about">Loại đi</label>
                        <select name="type_way" id="status" class="form-control">
                            <option value="1 chiều">1 chiều</option>
                            <option value="2 chiều">2 chiều</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Giá</label>
                        <input type="number" class="form-control" min="1" id="price" name="price" />
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
                                        src="data:image/jpeg;base64,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"
                                        alt="your image" style="max-width: 200px; height:100px; margin-bottom: 10px;"
                                        class="img-fluid" />
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0">Không hoạt động</option>
                            <option value="1">Hoạt động</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
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
