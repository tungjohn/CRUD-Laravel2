@extends('backend.layouts.main')

@section('title', 'Sửa đơn hàng')

@section('content')
    <h1>Cập nhật đơn hàng</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status')}}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url("/backend/orders/update/$order->id") }}" method='post' name='orders' enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Tên khách hàng</label>
            <input type="text" class="form-control" name='customer_name' value="{{ $order->customer_name }}">
        </div>
        <div class="form-group">
            <label for="">email</label>
            <input type="text" class="form-control" name='customer_email' value="{{ $order->customer_email }}">
        </div>
        <div class="form-group">
            <label for="">Số điện thoại</label>
            <input type="text" class="form-control" name='customer_phone' value="{{ $order->customer_phone }}">
        </div>
        <div class="form-group">
            <label for="">Trạng thái đơn hàng</label>
            <select name="order_status" id="order_status" class="form-control" style="width: 250px">
                <option value="1" {{ $order->order_status == 1 ? 'selected' : ''}}>Đang chờ xác nhận</option>
                <option value="2" {{ $order->order_status == 2 ? 'selected' : ''}}>Đã xác nhận</option>
                <option value="3" {{ $order->order_status == 3 ? 'selected' : ''}}>Đang vận chuyển</option>
                <option value="4" {{ $order->order_status == 4 ? 'selected' : ''}}>Hoàn tất</option>
                <option value="5" {{ $order->order_status == 5 ? 'selected' : ''}}>Đơn hủy</option>
                <option value="6" {{ $order->order_status == 6 ? 'selected' : ''}}>Đã hoàn tiền (Hủy đơn)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Địa chỉ</label>
            <textarea name="customer_address" id="customer_address" cols="30" rows="3" class="form-control">{{ $order->customer_address }}</textarea>
        </div>
        <div class="form-group">
            <label for="">Sản phẩm trong đơn hàng</label>

            <table class="table table-bordered" id="dataTable" cellspacing='0' width='100%'>
                <thead>
                    <tr>
                        <th>Id sản phẩm</th>
                        <th>Ảnh đại diện</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Tổng giá</th>
                    </tr>
                </thead>
                <tbody id="list-cart-product">
                    @foreach($productInOrders as $productInOrder)
                        <tr id="tr-{{ $productInOrder->id}}">
                            <td>{{$productInOrder->id}}</td>
                            <td>
                                @if ($productInOrder->product_image)
                                <?php 
                                $productInOrder->product_image = str_replace("public/", "", $productInOrder->product_image); 
                                ?>
                                <div>
                                    <img src="{{asset("storage/$productInOrder->product_image")}}" alt="" style="width: 200px; height: auto">
                                </div>
                                @endif
                            </td>
                            <td>{{$productInOrder->product_name}}</td>
                            <td>{{$productInOrder->quantity}}</td>
                            <td class="product_price">{{$productInOrder->product_price}}</td>
                            <td class="product_price_total">{{$productInOrder->product_price * $productInOrder->quantity}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p>Tổng tiền thanh toán: {{$order->total_price}}</p>
            <div class="form-group">
                <label for="">Ghi chú:</label>
                <textarea name="order_note" class="form-control" id="order_note" cols="30" rows="3">{{ $order->order_note }}</textarea>
            </div>
            <button type="submit" class="btn btn-info">Cập nhật đơn hàng</button>
        </div>
    </form>
@endsection