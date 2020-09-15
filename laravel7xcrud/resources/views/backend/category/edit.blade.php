@extends('backend.layouts.main')

@section('title', 'Sửa danh mục')

@section('appendjs')
<!-- Load file js của tinymce -->
<script src="{{asset('/be-assets/js/tinymce/tinymce.min.js')}}"></script>

<script type="text/javascript">
    tinymce.init({
        selector: '#desc'
    });
</script>
@endsection
@section('content')
    <h1>Sửa danh mục</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url("/backend/category/update/$category->id")}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Tên danh mục</label>
            <input type="text" name="name" id="name" class="form-control" value='{{ $category->name }}'>
        </div>
        <div class="form-group">
            <label for="">Slug danh mục</label>
            <input type="text" name="slug" id="slug" class="form-control" value='{{ $category->slug }}'>
        </div>
        <div class="form-group">
            <label for="">Ảnh danh mục</label>
            <input type="file" name="image" id="image" class="form-control">
            @if ($category->image)
                <?php
                    $category->image = str_replace('public/', '', $category->image);
                ?>
                <img src="{{asset("storage/$category->image")}}" alt="" style="width: 150px; height: auto">
            @endif
        </div>
        <div class="form-group">
            <label for="">Mô tả danh mục</label>
            <textarea name="desc" id="desc" cols="30" rows="10">{{ $category->desc }}'</textarea>
        </div>
        <button type="submit" class="btn btn-info">Cập nhật danh mục</button>
    </form>
@endsection