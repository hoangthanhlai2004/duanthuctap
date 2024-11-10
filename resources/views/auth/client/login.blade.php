@extends('layouts.login')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Đăng nhập</h3></div>
                <div class="card-body">

                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <form action="{{ route('clients.login') }}" method="POST">

                        @csrf

                        <div class="form-floating mb-3">
                            <input class="form-control" name="email" id="inputEmail" type="text" placeholder="name@example.com" />
                            <label for="inputEmail">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control"  name="password" id="inputPassword" type="password" placeholder="Password" />
                            <label for="inputPassword">Mật khẩu</label>
                        </div>
                        {{-- <div class="form-check mb-3">
                            <input class="form-check-input"  id="inputRememberPassword" type="checkbox" value="" />
                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                        </div> --}}
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            {{-- <a class="small" href="password.html">Forgot Password?</a> --}}
                            <button class="btn btn-primary" type="submit">Đăng nhập</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a href="{{ route('clients.register') }}">Chưa có tài khoản? Đăng ký</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

