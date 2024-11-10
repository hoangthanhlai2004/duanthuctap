 @extends('layouts.admin')

 @section('content')
     <h1 class="mt-4">
         Order</h1>
     <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item active">Order</li>
     </ol>
   
     <div class="card mb-4">
         <div class="card-header">
             <i class="fa fa-shopping-cart"></i>
             Order
         </div>
         @if (session('success'))
             <div class="alert alert-success">
                 {{ session('success') }}
             </div>
         @endif
         @if (session('error'))
         <div class="alert alert-danger">
             {{ session('error') }}
         </div>
     @endif
         <div class="card-body">
             <table id="datatablesSimple">
                 <thead>
                     <tr>
                         <th>Mã Đơn Hàng</th>
                         <th>Họ và tên</th>
                         <th>Ngày đặt hàng</th>
                         <th>Điện thoại</th>
                         <th>Trạng thái</th>
                         <th>Hành động</th>
                     </tr>
                 </thead>
                 {{-- <tfoot>
                     <tr>
                        <th>#</th>
                        <th>Tên</th>
                
                        <th>Điện thoại</th>
                        <th>Trạng thái</th>
                        <th>Ngày mua</th>
                        <th>Hành động</th>
                     </tr>
                 </tfoot> --}}
                 <tbody>
                     @foreach ($listOrder as $index => $item)
                         <tr>
                             <td>{{ $item->code }}</td>
                             <td>{{ $item->name }}</td>
                             <td>{{ $item->created_at->format('d/m/Y') }}</td>
                             <td>{{ $item->phone }}</td>
                             <td>
                                <form action="{{ route('order.update', $item->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select w-75"
                                    onchange="confirmSubmit(this)" 
                                    data-default-value = "{{ $item->status }}">
                                        @foreach ($status as $key => $value)
                                            <option value="{{ $key }}" 
                                            {{ $key == $item->status ? 'selected' : '' }}
                                            {{ $key == 'huy_don_hang' ? 'disabled' : '' }}>
                                            {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </form>
                                 
                             </td>
                           
                             <td>
                                 <a href="{{ route('order.show', $item->id) }}" class="btn btn-secondary"><i class="fa fa-eye"></i></a>
                                 @if ($item->status === 'huy_don_hang')
                                 <form action="{{ route('order.destroy', $item->id) }}" class="d-inline" method="POST"
                                    onsubmit="return confirm('Bạn có đồng ý xóa hay không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                                 @endif
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
             <a href="{{ route('order.trash') }}" class="btn btn-danger"> <i class="fa-solid fa-trash"></i> Thùng rác</a>
         </div>
     </div>
 @endsection

 @section('js')
     <script>
        function confirmSubmit(selectElement){
            var form = selectElement.form;
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            var defaultValue = selectElement.getAttribute('data-default-value');

            if (confirm('Bạn có chắc chắn thay đổi trạng thái đơn hàng thành"' + selectedOption + '" không?')) {
                form.submit();
            }else {
                selectElement.value = defaultValue;
            }
        }
     </script>
 @endsection