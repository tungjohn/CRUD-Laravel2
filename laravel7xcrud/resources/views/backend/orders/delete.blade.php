@extends('backend.layouts.main')

@section('title', 'xóa đơn hàng')

@section('content')
    <h1>Xóa đơn hàng</h1>
    <h2>Bạn có chắc chắn muốn xóa đơn hàng?</h2>
    <form action="{{ url("/backend/orders/destroy/$order->id") }}" method="post" name="order_delete">
    @csrf
        <div class="form-group">
            <label for="">ID đơn hàng: </label>
            <span>{{ $order->id }}</span>
        </div>
        <div class="form-group">
            <label for="">Tên khách hàng: </label>
            <span>{{ $order->customer_name }}</span>
        </div>
        <div class="form-group">
            <label for="">Giá trị đơn hàng: </label>
            <span>{{ $order->total_price }}</span>
        </div>
        <button type="submit" class="btn btn-danger">Xác nhận xóa đơn hàng</button>
    </form>
@endsection