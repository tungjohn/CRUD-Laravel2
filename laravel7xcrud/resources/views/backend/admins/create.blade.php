@extends('backend.layouts.main')

@section('title', 'Tạo mới admin')

@section('content')
    <h1>Tạo mới admin</h1>

    <form name="" action="{{ url('/backend/admins/store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Tên: </label>
            <input type="text" class="form-control" name="name" value="{{ old('name', '')}}">
        </div>
        <div class="form-group">
            <label for="">Email: </label>
            <input type="text" class="form-control" name="email" value="{{ old('email', '')}}">
        </div>
        <div class="form-group">
            <label for="">Ảnh đại diện: </label>
            <input type="file" class="form-control" name="avatar">
        </div>
        <div class="form-group">
            <label for="">Mật khẩu: </label>
            <input type="text" class="form-control" name="password" value="{{ old('password', '')}}">
        </div>
        <div class="form-group">
            <label for="">Nhập lại Mật khẩu: </label>
            <input type="text" class="form-control" name="password_confirmation" value="{{ old('password_confirmation', '')}}">
        </div>
        <div class="form-group">
            <label for="">Ghi chú: </label>
            <textarea name="desc" class="form-control" id="" rows="5">{{ old('desc', '') }}</textarea>
        </div>
        <button type="submit" class="btn btn-info">Thêm admin</button>
    </form>
@endsection