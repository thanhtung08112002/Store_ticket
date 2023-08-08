@extends('layouts/contentNavbarLayout')

@section('title', 'Quản lý thông tin đặt vé máy bay')

@section('content')
    <div class="card">
        <h5 class="card-header">Quản lý thông tin đặt vé máy bay</h5>
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên người đặt</th>
                        <th>Giới tính</th>
                        <th>Ngày tháng năm sinh</th>
                        <th>CMND/CCCD/Hộ chiếu</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Hãng bay</th>
                        <th>Tên máy bay</th>
                        <th>Tên chuyến bay</th>
                        <th>Ảnh</th>
                        <th>Số chỗ đã đặt</th>
                        <th>Địa điểm bắt đầu</th>
                        <th>Địa điểm kết thúc</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thông tin chuyến bay</th>
                        <th>Loại đi</th>
                        <th>Loại ghế ngồi</th>
                        <th>Tổng giá</th>
                        <th>Tổng giá sau khi giảm</th>
                        <th>Phương thức thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($listOrder as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->fullname }}</td>
                            <td>{{ $item->gender == 0 ? 'Nam' : 'Nữ' }}</td>
                            <td>{{ $item->birthday }}</td>
                            <td>{{ $item->passport_cccd }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ ucfirst($item->airplane_brand_name) }}</td>
                            <td>{{ $item->airplane_name }}</td>
                            <td>{{ $item->flight_name }}</td>
                            <td><img width="120px" height="120px" src="{{ Storage::url($item->image) }}" alt="">
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->location_start }}</td>
                            <td>{{ $item->location_end }}</td>
                            <td>{{ $item->time_start }}</td>
                            <td>{{ $item->information }}</td>
                            <td>{{ $item->type_way }}</td>
                            <td>{{ $item->type_seat }}</td>
                            <td>{{ format_money($item->order_total, 'VNĐ') }}</td>
                            <td>{{ format_money($item->order_total_discount, 'VNĐ') ?? '0 VNĐ' }}</td>
                            <td>{{ ucfirst($item->type_payment ?? 'Thông thường') }}</td>
                            @if (Auth::user()->role != 1)
                                <td class="status-order-{{ $item->id }}">
                                    @if ($item->status == 0)
                                        <span class='badge bg-label-warning me-1'>Chờ xác nhận</span>
                                    @elseif($item->status == -1)
                                        <span class='badge bg-label-danger me-1'>Đã hủy</span>
                                    @else
                                        <span class='badge bg-label-success me-1'>Đã xác nhận</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                            @else
                                <td class="status-order-{{ $item->id }}">
                                    @if ($item->status == 0)
                                        <span class='badge bg-label-warning me-1'>Chờ xác nhận</span> <button
                                            data-id='{{ $item->id }}' data-email=' {{ $item->email }}'
                                            class='btn btn-primary btn-check-done'>Xác nhận</button> <button
                                            data-id='{{ $item->id }}' data-email=' {{ $item->email }}'
                                            class='btn btn-danger btn-check-cancel'>Hủy</button>
                                    @elseif($item->status == -1)
                                        <span class='badge bg-label-danger me-1'>Đã hủy</span>
                                    @else
                                        <span class='badge bg-label-success me-1'>Đã xác nhận</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                            @endif
                            <td class="ticketplane-{{ $item->id }}">
                                @if ($item->status == 1)
                                    <a href="{{ route('admin.order.details', $item->id) }}">Vé</a>
                                @elseif ($item->status == -1)
                                    <span style="color: red">Vé đã hủy</span>
                                @else
                                    <span style="color: red">Vé chưa được tạo</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="text-align:center;margin: auto !important;padding:12px 12px 0 12px">
            {{ $listOrder->links() }}
        </div>


    </div>



@endsection

@section('css')
    <style>
        .relative.z-0.inline-flex.shadow-sm.rounded-md {
            display: none
        }
    </style>
@endsection
@section('scripts')
    <script>
        $('.btn-check-done').click(function() {
            let cf = confirm('Họ đã thanh toán rồi ?');
            if (cf) {
                let id = $(this).data('id');
                let email = $(this).data('email');
                $(this).attr("disabled", true)
                $(`button.btn-check-cancel[data-id=${id}]`).attr("disabled", true)
                $.ajax({
                    type: "put",
                    url: "{{ route('admin.order.update') }}",
                    data: {
                        id: id,
                        email: email
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function(response) {
                        toastr.success("Thay đổi trạng thái thành công, Email đã được chuyển đi");
                        $(`.status-order-${id}`).html(
                            "<span class='badge bg-label-success me-1'>Đã xác nhận</span>")
                        $(`.ticketplane-${id}`).html(
                            `  <a href='/admin/order/details/${id}'>Vé</a>`)
                    }
                });
            }
        })

        $('.btn-check-cancel').click(function() {
            let cf = confirm('Xác nhận hủy');
            if (cf) {
                $(this).attr("disabled", true)
                let id = $(this).data('id');
                let email = $(this).data('email');
                $(`button.btn-check-done[data-id=${id}]`).attr("disabled", true)
                $.ajax({
                    type: "put",
                    url: "{{ route('admin.order.cancel') }}",
                    data: {
                        id: id,
                        email: email
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function(response) {
                        toastr.success("Hủy thành công, Email đã được chuyển đi");
                        $(`.status-order-${id}`).html(
                            "<span class='badge bg-label-danger me-1'>Đã hủy</span>")
                        $(`.ticketplane-${id}`).html(
                            `  <span style="color: red">Vé đã hủy</span>`)
                    }
                });
            }
        })
    </script>
@endsection
