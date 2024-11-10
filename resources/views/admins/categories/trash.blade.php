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
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Active</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Active</th>
                    <th>Manage</th>
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
                        <a href="{{ route('categories.restore', $Categories->id) }}" class="btn btn-warning">Khôi phục</a>
                        <a href="{{ route('categories.forceDelete', $Categories->id) }}" onclick="return confirm('Bạn có muốn xóa không?')" class="btn btn-danger">Xóa</a>

                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Trở lại</a>
    </div>
</div>
@endsection
