@extends('backend.layouts.main')

@section('title', 'Danh sách danh mục')

@section('content')
    <h1>Danh sách danh mục</h1>
    <div style="padding: 10px; border: 1px solid #4e73df; margin-bottom: 10px;">

        <form name="search_category" action="{{ htmlspecialchars($_SERVER['REQUEST_URI'])}}" class="form-inline" method='get'>
        
                <input type="text" name="category_name"  value="{{ $searchKeyword }}" class='form-control' placeholder="Nhập tên danh mục bạn muốn tìm kiếm..." autocomplete='off' style="width: 350px; margin-right:20px;">

                <select name="category_sort" id="" class="form-control">
                    <option value="" {{ $sort == '' ? 'selected' : ''}}>Sắp xếp</option>
                    <option value="name_asc" {{ $sort == 'name_asc' ? 'selected' : ''}}>Tên danh mục: A-Z</option>
                    <option value="name_desc" {{ $sort == 'name_desc' ? 'selected' : ''}}>Tên danh mục: Z-A</option>
                </select>
                <div style='padding: 10px 0; margin-left: 10px'>
                    <input type="submit" name='search' value="Lọc kết quả" class="btn btn-success">
                </div>
                <div style='padding: 10px 10px;'>
                    <a href='#' name='clear_search' id='clear_search' class='btn btn-warning'>Xóa Bộ Lọc</a>
                </div>
                <input type="hidden" name='page' value='1'>
        </form>
    </div>
        {{$categorys->links()}}
    <div style="padding: 10px 0">
        <a href="{{asset('backend/category/create')}}" class="btn btn-info">Thêm danh mục</a>
    </div>
    
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status')}}
        </div>
    @endif
    <table class="table table-bordered" width=100% cellspacing=0>
        <thead>
            <tr>
                <th>ID danh mục</th>
                <th>Ảnh đại diện</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        @if (isset($categorys) && !empty($categorys))
            @foreach($categorys as $category)
        <tr>
            <td>{{ $category->id }}</td>
            @if (isset($category->image))
                <?php
                    $category->image = str_replace('public/', '', $category->image);
                ?>
                <td>
                    <img src="{{ asset("/storage/$category->image")}}" alt="" style="width:200px; height: auto;">
                </td>
            @endif
            <td>{{ $category->name }}</td>
            <td>
                <a href="{{ asset("backend/category/edit/$category->id")}}" class="btn btn-warning">Sửa danh mục</a>
                <a href="{{ asset("backend/category/delete/$category->id")}}" class="btn btn-danger">Xóa danh mục</a>
            </td>
        </tr>
            @endforeach
        @endif
        </tbody>
        <tfoot>
            <tr>
                <td>ID danh mục</td>
                <td>Ảnh đại diện</td>
                <td>Tên danh mục</td>
                <td>Hành động</td>
            </tr>
        </tfoot>
    </table>
    {{$categorys->links()}}

@endsection
@section('appendjs')
    <script type='text/javascript'>
        $(document).ready(function () {
            $("#clear_search").on("click", function(e) {
                e.preventDefault();
                $("input[name='category_name']").val('');
                $("select[name='category_sort']").val('');
                $("form[name='search_category']").trigger('submit');
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

                $("form[name='search_category']").trigger('submit');

            });
        });
    </script>
@endsection
