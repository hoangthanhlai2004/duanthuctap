@extends('layouts.admin')


@section('content')
    <h1 class="mt-4">Comments</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Comments</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Comments
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
                        <th>Tên Người Dùng</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Nội Dung</th>
                        <th>Thời Gian</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Tên Người Dùng</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Nội Dung</th>
                        <th>Thời Gian</th>
                        <th>Hành Động</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($listBinhLuan as $index => $comment)
                        <tr>

                            <td>{{ $index + 1 }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->product->ten_san_pham }}</td>
                            <td>{{ $comment->noi_dung }}</td>
                            <td>{{ $comment->thoi_gian }}</td>
                            <td>
                                <form action="{{ route('comment.destroy', $comment->id) }}" class="d-inline" method="POST"
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
            <a href="" class="btn btn-primary"> <i class="fa-solid fa-trash"></i> Thùng rác</a>
            {{-- {{ route('comments.trash') }} --}}
        </div>
    </div>
@endsection
