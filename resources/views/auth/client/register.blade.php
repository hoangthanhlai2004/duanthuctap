@extends('layouts.login')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Tạo tài khoản</h3></div>
                <div class="card-body">
                    <form action="{{ route('clients.register') }}" method="POST">

                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input name="name" class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" />
                                    <label for="inputFirstName">Họ và tên</label>
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" name="email"  id="inputEmail" type="email" placeholder="name@example.com" />
                            <label for="inputEmail">Email</label>
                        </div>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="row mb-3 mt-3">
                            <div class="col-md-12">
                                <div class="form-floating mb-md-0">
                                    <input class="form-control" name="password"  id="inputPassword" type="password" placeholder="Create a password" />
                                    <label for="inputPassword">Mật khẩu</label>
                                </div>
                            </div>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="col-md-12 mt-3">
                                <div class="form-floating mb-md-0">
                                    <input class="form-control"  name="password_confirmation"  id="inputPasswordConfirm" type="password" placeholder="Confirm password" />
                                    <label for="inputPasswordConfirm">Xác nhận</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid"><button class="btn btn-primary btn-block" type="submit">Tạo tài khoản</button></div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a href="{{ route('clients.login') }}">Đã có tài khoản? Đăng nhập</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
