@extends('backend.layouts.main')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <h1>Danh sách sản phẩm</h1>
    <div style="padding: 10px; border: 1px solid #4e73df; margin-bottom: 10px;">
        <!-- LỌC SẢN PHẨM -->
        <form name="search_product" method="get" action="{{ htmlspecialchars($_SERVER['REQUEST_URI']) }}" class="form-inline"> <!-- $_SERVER["REQUEST_URI"] trả về url trên trình duyệt không kèm theo domain cùng chuỗi query string trên url -->

            <!-- TẠO BỘ LỌC SẢN PHẨM -->
            <input type="text" name="product_name" value="{{$searchKeyword}}" class="form-control" style="width: 350px; margin-right:20px;" placeholder="Nhập tên sản phẩm bạn muốn tìm kiếm..." autocomplete="off">

            
            <!-- LỌC THEO TRẠNG THÁI SẢN PHẨM -->
            
            <select name="product_status" class="form-control" style="width: 200px; margin-right: 20px;" id="">
                <option value="">Lọc theo trạng thái</option>
                <option value="1" {{ $productStatus == 1 ? "selected" : ""}}  >Đang mở bán</option>
                <option value="2" {{ $productStatus == 2 ? "selected" : ""}}  >Ngừng bán</option>
            </select>
            <!-- LỌC THEO DANH MỤC SẢN PHẨM -->
            <select name="category_sort" id="" class="form-control" style="margin-right: 20px">
                <option value="">Lọc theo danh mục</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}" {{$category->id == $category_sort ? 'selected' : ''}}>{{ $category->name}}</option>
                @endforeach
            </select>
            <!-- SORT - SẮP XẾP THEO CÁC TRƯỜNG TĂNG DẦN HOẶC GIẢM DẦN -->
            <select name="product_sort" class="form-control" style="width: 150px; margin-right: 20px;" id="">
                <option value="" {{$sort == '' ? "selected" : ""}}>Sắp xếp</option>
                <option value="price_asc" {{$sort == 'price_asc' ? "selected" : ""}}>Giá tăng dần</option>
                <option value="price_desc" {{$sort == 'price_desc' ? "selected" : ""}}>Giá giảm dần</option>
                <option value="quantity_asc" {{$sort == 'quantity_asc' ? "selected" : ""}}>Tồn kho tăng dần</option>
                <option value="quantity_desc" {{$sort == 'quantity_desc' ? "selected" : ""}}>Tồn kho giảm dần</option>
            </select>
            
            <!-- BUTTON LỌC -->
            <div style="padding: 10px 0">
                <input type="submit" name="search" class="btn btn-success" value="Lọc kết quả">
            </div>

            <!-- XÓA BỘ LỌC -->
            <div style="padding: 10px 0;">
                <a href="#" id="clear-search" class="btn btn-warning">Clear filter</a>
            </div>
            <input type="hidden" name="page" value="1">
        </form>
    </div>
    {{$products->links()}}
    <div style='padding: 20px;'>
        <a href="{{ url('backend/product/create') }}" class="btn btn-info">Thêm Sản Phẩm</a>
    </div>
        <!-- in biến status đã thêm trong ProductsController->store() -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID sản phẩm</th>
                <th>Ảnh đại diện</th>
                <th>Tên sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Tồn kho</th>
                <th>Mô tả</th>
                <th>Danh mục sản phẩm</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </tfoot>
            <tbody>
            @if (isset($products) && !empty($products))
                @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                <!-- Hiển thị ảnh trong index -->
                @if($product->product_image)
                    <?php
                        $product->product_image = str_replace('public/', '', $product->product_image);
                    ?>
                    <img src="{{ asset("storage/$product->product_image") }}" alt="" style="width:200px; height: auto;">
                @endif
                </td>
                <td>
                    {{ $product->product_name }}
                    @if($product->product_status == 1)
                        <p><span class="bg-success text-white">Đang mở bán</span></p>
                    @endif
                    @if($product->product_status == 2)
                        <p><span class="bg-danger text-white">Ngừng bán</span></p>
                    @endif
                </td>
                <td>{{ $product->product_price }} USD</td>
                <td>{{ $product->product_quantity }}</td>
                <td>{!! $product->product_desc !!}</td> 
                <td>{{ $product->category_id}}</td>
                <td>
                    <a href="{{asset('/backend/product/edit')}}/{{$product->id}}" class="btn btn-warning">Sửa</a>
                    <a href="{{asset('/backend/product/delete')}}/{{$product->id}}" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
                @endforeach
            @else
                Chưa có bản ghi nào trong bảng này
            @endif
            </tbody>
        </table>
        {{$products->links()}}
@endsection
@section('appendjs')
    <script type="text/javascript">
        $(document).ready(function () {
            /* Xóa lọc */
            $("#clear-search").on('click', function (e) {
                //e.preventDefault() ngăn chặn hành động mặc định của #clear-search

                e.preventDefault();
                //đặt giá trị cho input là rỗng
                $("input[name='product_name']").val('');
                $("select[name='product_status']").val('');
                $("select[name='product_sort']").val('');
                $("select[name='category_sort']").val('')
                //kích hoạt tự động submit
                $("form[name='search_product']").trigger("submit");

            });
            /* Chuyển trang vẫn giữ nguyên giá trị vừa lọc */
            $("a.page-link").on("click", function (e) {
                e.preventDefault();
                var rel = $(this).attr("rel");

                if (rel == 'next') {
                    var page = $('body').find('.page-item.active > .page-link').eq(0).text();

                    console.log(" : " + page);
                    page = parseInt(page);
                    page +=1;
                } else if (rel == 'prev') {
                    var page = $('body').find('.page-item.active > .page-link').eq(0).text();
                    console.log(page);
                    
                    page = parseInt(page);
                    page -=1;
                } else {
                    var page = $(this).text();
                }
                console.log(page);

                page = parseInt(page);

                $("input[name='page']").val(page);

                $("form[name='search_product']").trigger("submit");
            });
        });
    </script>
@endsection