@extends('backend.layouts.main')

@section('title', 'Danh sách đơn hàng')

@section('content')
    <h1>Danh sách đơn hàng</h1>
    <div style='margin: 10px 0 ;'>
        <form action="{{ htmlspecialchars($_SERVER['REQUEST_URI']) }}" method="get" class='form-inline' name='search_orders'>
            <div>
                <input type="text" class='form-control' placeholder='Nhập tên đơn hàng bạn muốn tìm kiếm...' name='search' style="width: 350px; margin-right:20px;" value="{{ $searchKeyword }}" autocomplete="off">
            </div>

            <div>
                <select name="sort" id="" class='form-control'>
                    <option value="" {{$sort == '' ? "selected" : ""}}>Sắp xếp</option>
                    <option value="name_asc"{{ $sort == 'name_asc' ? 'selected' : ''}}>Tên khách hàng tăng dần</option>
                    <option value="name_desc" {{ $sort == 'name_desc' ? 'selected' : ''}}>Tên khách hàng giảm dần</option>
                </select>
            </div>
            <input type="hidden" name='page' value='1'>
            <div>
                <input type="submit" value="Lọc kết quả" class="btn btn-primary" style="margin: 0 10px;">
            </div>
            <div>
                <a href="" class="btn btn-warning" id='clear_search'>Clear Filter</a>
            </div>
        </form>
    </div>
    {{ $orders->links()}}
    <div>
        <a href="{{asset('backend/orders/create')}}" class="btn btn-info">Thêm đơn hàng</a>
    </div>
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
        @foreach($orders as $order)
            <tr>
                
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_phone }}</td>
                <td>{{ $order->customer_email }}</td>
                <td>
                    {{ $order_status_defined[$order->order_status] }}
                </td>
                <td>{{ $order->total_product }}</td>
                <td>{{ $order->total_price }}</td>
                <td>
                    <a href='{{ asset("backend/orders/edit/$order->id") }}' class="btn btn-warning">Sửa</a>
                    <a href='{{ asset("backend/orders/delete/$order->id") }}' class="btn btn-danger">Xóa</a>
                </td>

                
            </tr>
        @endforeach
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
    {{ $orders->links()}}
@endsection
@section('appendjs')
    <script>
        $(document).ready(function () {
            $('#clear_search').on('click', function (e) {
                e.preventDefault();
                $("input[name='search']").val('');
                $("select[name='sort']").val('');
                $("form[name='search_orders']").trigger("submit");
            });

            $("a.page-link").on("click", function(e) {
                e.preventDefault();

                var rel = $(this).attr("rel");

                if (rel == 'next')
                {
                    var page = $("body").find('.page-item.active > .page-link').eq(0).text();
                    page = parseInt(page);
                    page += 1;
                } else if (rel == 'prev')
                {
                    var page = $("body").find('.page-item.active > .page-link').eq(0).text();
                    page = parseInt(page);
                    page -= 1;
                } else { var page = $(this).text(); }

                page = parseInt(page);
                console.log(page);

                $("input[name='page']").val(page);

                $("form[name='search_orders']").trigger('submit');

            });
        });
    </script>
@endsection