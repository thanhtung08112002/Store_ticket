@extends('client.layouts.checkoutlayout')


@section('main')
    <div class='container'>
        <div class='row' style='padding-top:25px; padding-bottom:25px;'>
            <div class='col-md-12'>
                <div id='mainContentWrapper'>
                    <h2 style="text-align: center;">
                        Vui lòng kiểm tra kĩ. Store Plane Ticket trân trọng cảm ơn!
                    </h2>
                    <hr />
                    <div class="shopping_cart">
                        @if ($errors->any()) 
                        <ul>
                            @foreach ($errors->all() as $error )
                                <li style="color:red">{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                        <form class="form-horizontal" role="form" action="{{ route('client.cart.pay') }}" method="post"
                            id="payment-form">
                            @csrf

                            <div class="panel-group" id="accordion">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Thông
                                                tin và
                                                liên hệ</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse in collapse show">
                                        <div class="panel-body">
                                            <table class="table table-striped" style="font-weight: bold;">
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="fullname">Họ và tên:</label>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" id="fullname" name="fullname"
                                                             type="text" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_last_name">Giới tính:</label>
                                                    </td>
                                                    <td>
                                                        <select name="gender" class="form-control">
                                                            <option value="0">Nam</option>
                                                            <option value="1">Nữ</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_birthday">Ngày tháng năm sinh</label>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" id="id_birthday" name="birthday"
                                                             type="date" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address">Địa chỉ:</label>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" id="id_address" name="address"
                                                             type="text" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="passport">Số hộ chiếu/ CCCD:</label>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" id="passport" name="passport"
                                                            type="text" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="phone">Số điện thoại:</label>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" id="phone" name="phone"
                                                             type="number" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="email">Email:</label>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" id="email" name="email"
                                                             type="email" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Đơn
                                            đặt</a>
                                        <input type="text" hidden name="id" value="{{ $flight->id }}">
                                    </h4>
                                </div>
                            </div>
                            <div id="collapseOne" class="panel-collapse in collapse show">
                                <div class="panel-body">
                                    <div class="items">
                                        <div class="12">
                                            <table class="table table-striped">
                                                <tr>
                                                    <td>
                                                        <ul>
                                                            <li>Tên chuyến bay: {{ $flight->name }} </li>
                                                            <li>Điểm bắt đầu: {{ $flight->location_start }} </li>
                                                            <li>Điểm đến: {{ $flight->location_end }}</li>
                                                            <li>Thời gian bắt đầu: {{ $flight->type_way }}</li>
                                                            <li>Loại vé: {{ $flight->location_end }}</li>
                                                            <li data-price="{{ $flight->price }}" class="price_flight">Giá:
                                                                {{ $flight->price }}VNĐ/Vé</li>
                                                            <li>Thông tin: </li>
                                                            <textarea disabled class="form-control">{{ $flight->information }} </textarea>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12 control-label" for="card-holder-name">Mã ưu đãi</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="coupon" name="coupon"
                                                    placeholder="Coupon">
                                                <br>
                                                <span class="btn btn-success btn-check-coupon">Kiểm tra</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12 control-label" for="card-holder-name">Số người (Bao
                                                gồm
                                                cả người lớn và trẻ em )</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="qty_person"
                                                    name="qty_person" value="1" min="1"
                                                    max="{{ $flight->qty_seat }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div style="text-align: center;">
                                                <h3>Order Total</h3>
                                                <h3><span style="color:green;" class="orderTotal">{{ $flight->price }}
                                                        VNĐ</span></h3>
                                                <h3><span
                                                        style="display: none;color:green;"class="orderTotalDiscount"></span>
                                                </h3>
                                            </div>
                                        </div>
                                        <button type="submit" name="normal" class="btn-payment btn btn-success btn-lg"
                                            style="width:100%;">Thanh
                                            toán
                                        </button>
                                        <button type="submit" name="vnpay" value="1" class="mt-5 btn-payment btn btn-primary btn-lg"
                                            style="width:100%;">VNPay
                                        </button>
                                        <input type="text" class="inpOrderTotal" name="orderTotal"
                                            value="{{ $flight->price }}"  hidden>
                                        <input type="text" class="inpOrderTotalDiscount" name="orderTotalDiscount"
                                             value="0" hidden>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            let qtyPersion = $('#qty_person');
            let coupon = $('#coupon');
            let price = $('.price_flight').data('price');
            let orderTotal = $('.orderTotal')
            let orderTotalDiscount = $('.orderTotalDiscount');
            let inpOrderTotal = $('.inpOrderTotal')
            let inpOrderTotalDiscount = $('.inpOrderTotalDiscount');


            $(".btn-check-coupon").click(function(e) {
                if (coupon.val() == "") {
                    $(coupon).css('border', '1px solid red');
                    toastr.error("Hãy điền mã ưu đãi của bạn");
                    orderTotal.css('text-decoration-line', 'none')
                    orderTotalDiscount.css('display', 'none')
                    inpOrderTotalDiscount.val(0)

                    return false;
                }
                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": true,
                    "positionClass": "toast-top-right"
                };
                $(coupon).css('border', '1px solid black');
                $.ajax({
                    type: "GET",
                    url: `/ajax/checkDiscount/${coupon.val()}`,
                    dataType: "json",
                    success: function(response) {
                        let discount = response.discount
                        let qty = qtyPersion.val()

                        let totalDiscount = (qty * price) - ((discount) / 100 * (qty * price))
                        inpOrderTotalDiscount.val(totalDiscount)
                        orderTotalDiscount.text(`${totalDiscount} VNĐ`)
                        orderTotalDiscount.css('display', 'block')
                        orderTotal.css('text-decoration-line', 'line-through')
                    },
                    error: function(response) {
                        toastr.error(response.responseJSON.message);
                        orderTotal.css('text-decoration-line', 'none')
                        orderTotalDiscount.css('display', 'none')
                        inpOrderTotalDiscount.val(0)

                    }
                });
            });

            $(qtyPersion).change(function(e) {
                let qty = (e.currentTarget.value);
                let total = qty * price
                orderTotal.text(`${total} VNĐ`)
                orderTotal.css('text-decoration-line', 'none')
                orderTotalDiscount.css('display', 'none')
                inpOrderTotal.val(total)
                inpOrderTotalDiscount.val(0)
            });
        </script>
    @endsection
