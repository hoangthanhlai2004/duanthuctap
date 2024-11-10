@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Categories</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Categories</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Categories
    </div>
    @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
      @endif
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($listCategories as $index => $Categories)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $Categories->name }}</td>
                    <td>{{ $Categories->slug }}</td>
                    <td>{{ $Categories->active == 1 ? 'Hiển Thị' : 'Ẩn' }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $Categories->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('categories.destroy', $Categories->id) }}" class="d-inline" method="POST"
                            onsubmit="return confirm('Bạn có đồng ý xóa hay không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('categories.trash') }}" class="btn btn-primary"> <i class="fa-solid fa-trash"></i> Thùng rác</a>
    </div>
</div>
@endsection
