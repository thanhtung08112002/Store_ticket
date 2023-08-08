@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="chart success"
                                        class="rounded">
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Số đơn chưa xác nhận</span>
                            <h3 class="card-title mb-2">{{ $countTicketPending }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                        class="rounded">
                                </div>
                             
                            </div>
                            <span class="fw-semibold d-block mb-1">Số đơn đã xác nhận</span>
                            <h3 class="card-title mb-2">{{ $countTicketSuccess }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-4 mb-4">
                  <div class="card">
                      <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0">
                                  <img src="{{ asset('assets/img/icons/unicons/wallet.png') }}" alt="Credit Card"
                                      class="rounded">
                              </div>
                            
                          </div>
                          <span class="fw-semibold d-block mb-1">Số đơn đã hủy</span>
                            <h3 class="card-title mb-2">{{ $countTicketCancel }}</h3>
                      </div>
                  </div>
              </div>
            </div>
        </div>
        <!-- Total Revenue -->

        <!--/ Total Revenue -->
    
            @endsection
