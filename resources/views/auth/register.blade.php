@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection


@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 25, 'withbg' => '#696cff'])</span>
                                <span
                                    class="app-brand-text demo text-body fw-bolder">{{ config('variables.templateName') }}</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Hãy tạo tài khoản ở đây 🚀</h4>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                @php
                                    toastr()->error($error, 'Thông báo');
                                @endphp
                            @endforeach
                        @endif
                        <form id="formAuthentication" class="mb-3" action="" method="POST">
                          @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Họ và tên" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email đăng nhập">
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Mật khẩu</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>


                            <button class="btn btn-primary d-grid w-100">
                                Đăng ký
                            </button>
                        </form>

                        <p class="text-center">
                            <span>Bạn đã có tài khoản?</span>
                            <a href="{{ route('login') }}">
                                <span>Đăng nhập tại đây</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Register Card -->
        </div>
    </div>
    </div>
@endsection
