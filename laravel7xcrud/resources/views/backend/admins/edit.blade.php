@extends('backend.layouts.main')

@section('title', 'Sửa Thông Tin Admin')

@section('content')
    <h1>Cập nhật admin</h1>
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url("/backend/admins/update/$admin->id") }}" name="admin" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Tên: </label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $admin->name }}">
        </div>

        <div class="form-group">
            <label for="name">Email: </label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $admin->email }}">
        </div>
        <div class="form-group">
            <label for="image">Image: </label>
            <input type="file" name="avatar" class="form-control" id="image">

            @if($admin->avatar)
                <?php
                    $admin->avatar = str_replace("public/", "", $admin->avatar)
                ?>
                <div>
                    <img src="{{ asset("storage/$admin->avatar") }}" style="width: 200px; height: auto" alt="">
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu mới: </label>
            <input type="text" name="password" class="form-control" id="password" value="">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Nhập lại password: </label>
            <input type="text" name="password_confirmation" class="form-control" id="password_confirmation" value="">
        </div>

        <div class="form-group">
            <label for="desc">Ghi Chú:</label>
            <textarea name="desc" id="desc" cols="30" rows="10" class="form-control">{{ $admin->desc }}</textarea>
        </div>
        <button type="submit" class="btn btn-info">Cập nhật thông tin admin</button>
    </form>
@endsection