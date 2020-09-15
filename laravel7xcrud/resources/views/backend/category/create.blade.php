@extends('backend.layouts.main')

@section('title', 'Tạo danh mục')

@section('appendjs')
    <!-- tinymce -->
    <script src="{{asset('/be-assets/js/tinymce/tinymce.min.js')}}"></script>


    <script type='text/javascript'>
        tinymce.init({
            selector: '#desc'
        });
    </script>
@endsection

@section('content')
    <h1>Tạo dạnh mục mới</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <form name='category' action="{{ url('/backend/category/store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="">Tên danh mục</label>
            <input type="text" class="form-control" name='name' id='name'>
        </div>
        <div class="form-group">
            <label for="">Slug danh mục</label>
            <input type="text" class="form-control" name='slug' id='slug'>
        </div>
        <div class="form-group">
            <label for="">Ảnh danh mục</label>
            <input type="file" class="form-control" name='image' id='image'>
        </div>
        <div class="form-group">
            <label for="">Slug danh mục</label>
            <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-info">Thêm danh mục</button>
    </form>
@endsection