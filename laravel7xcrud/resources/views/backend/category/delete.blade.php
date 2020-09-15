@extends('backend.layouts.main')

@section('title', 'Xóa danh mục')

@section('content')
    <h1>Xóa Danh Mục</h1>
    <h2>Bạn có chắc chắn muốn xóa danh mục?</h2>
    <form action="{{ asset("backend/category/destroy/$category->id")}}" method="get">
        <div class="form-group">
            <label for="">ID danh mục</label>
            <p>{{ $category->id }}</p>
        </div>
        <div class="form-group">
            <label for="">Tên danh mục</label>
            <p>{{ $category->name }}</p>
        </div>
        <input type="submit" class="btn btn-danger" value="Xác nhận xóa Danh mục">
    </form>
    
@endsection