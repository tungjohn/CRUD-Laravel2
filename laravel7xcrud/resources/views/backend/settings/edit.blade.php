@extends('backend.layouts.main')

@section('title', 'settings')

@section('content')
    <h1>Cấu hình trang web</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    <form action="{{ url('/backend/settings/update')}}" method="post" name="settings" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="">Tên trang web</label>
            <input type="text" class="form-control" name="site_name" id="site_name" value="{{ isset($settingConvert['site_name']) ? $settingConvert['site_name'] : ''}}">
        </div>
        <div class="form-group">
            <label for="">Ảnh logo</label>
            <input type="file" class="form-control" name="logo" id='logo' >
            @if (isset($settingConvert["logo"]) && ($settingConvert["logo"]))
                <?php
                    $settingConvert["logo"] = str_replace('public/', '', $settingConvert["logo"]);
                ?>

                <img src="{{ asset('storage' . '/' . $settingConvert['logo']) }}" alt="" style="width: 200px; height: auto;">
            @endif
        </div>
        <div class="form-group">
            <label for="">Meta title</label>
            <input type="text" class="form-control" name="meta_title" id='meta_title' value="{{ isset($settingConvert['meta_title']) ? $settingConvert['meta_title'] : '' }}">
        </div>
        <div class="form-group">
            <label for="">Meta description</label>
            <textarea name="meta_desc" class="form-control" rows="4" id="meta_desc">{{ isset($settingConvert["meta_desc"]) ? $settingConvert["meta_desc"] : "" }}</textarea>
            
        </div>
        <div class="form-group">
            <label for="">Meta keyword</label>
            <textarea name="meta_keyword" class="form-control" rows="4" id="meta_keyword">{{ isset($settingConvert["meta_keyword"]) ? $settingConvert["meta_keyword"] : "" }}</textarea>
            
        </div>

        <button type="submit" class="btn btn-info">Lưu cấu hình</button>
    </form>
@endsection