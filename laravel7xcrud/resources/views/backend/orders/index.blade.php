@extends('backend.layouts.main')

@section('title', 'Danh sách đơn hàng')

@section('content')
    <h1>Danh sách đơn hàng</h1>
    <div style='margin: 10px 0 ;'>
        <form action="{{ htmlspecialchars($_SERVER['REQUEST_URI']) }}" method="post" class='form-inline'>
            <div>
                <input type="text" class='form-control' placeholder='Nhập tên đơn hàng bạn muốn tìm kiếm...' name='' style="width: 350px; margin-right:20px;">
            </div>

            <div>
                <select name="" id="" class='form-control'>
                    <option value="">Sắp xếp</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>
            <input type="submit" value="Lọc kết quả" class="btn btn-primary" style="margin: 0 10px;">
            <a href="" class="btn btn-warning">Clear Filter</a>
        </form>
    </div>
    <a href="{{asset('backend/orders/create')}}" class="btn btn-info">Thêm đơn hàng</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID đơn hàng</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Trạng thái</th>
                <th>Tổng số sản phẩm</th>
                <th>Tổng tiền</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="" class="btn btn-warning">Sửa</a>
                    <a href="" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>ID đơn hàng</td>
                <td>Tên khách hàng</td>
                <td>Số điện thoại</td>
                <td>Email</td>
                <td>Trạng thái</td>
                <td>Tổng số sản phẩm</td>
                <td>Tổng tiền</td>
                <td>Hành động</td>
            </tr>
        </tfoot>
        
    </table>
@endsection