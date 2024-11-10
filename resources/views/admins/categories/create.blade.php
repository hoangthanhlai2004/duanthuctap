@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Categories</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Categories</li>
</ol>

<div class=" mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Categories
    </div>
    <form action="{{ route('categories.store') }}" method="POST" >

        {{-- Làm việc với form laravel --}}
        {{-- 
        CSRF Field : là 1 trường ẩn mà laravel bắt buộc phải có trong form cho mục đích bảo mật

        --}}
        @csrf

        <div class="mb-3">
            <label for="" class="form-label">Tên Danh Mục</label>
            <input type="text" class="form-control" id="slug" name="name" placeholder="Nhập tên..." onkeyup="ChangeToSlug()">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Slug</label>
            <input type="text" class="form-control" name="slug" id="convert_slug"
                placeholder="Nhập...">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Trạng thái</label>
            <select name="active" class="form-select">
                <option value="1" selected>Hiển Thị</option>
                <option value="0">Ẩn</option>
            </select>
        </div>

        <div class="mb-3 d-flex justify-content-center">
            <button type="reset" class="btn btn-outline-secondary me-3">Nhập lại</button>
            <button type="submit" class="btn btn-success">Thêm mới</button>
        </div>
    </form>
</div>
@endsection
