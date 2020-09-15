@extends('backend.layouts.main')

@section('title', 'Xóa sản phẩm')

@section('content')
    <h1>Xóa sản phẩm</h1>
    <h2>Bạn có chắc chắn muốn xóa sản phẩm</h2>
    <div>
        <label for="" name="id">ID sản phẩm: {{$product->id}}</label>
    </div>
    <div>
        <label for="" name="product_name">Tên sản phẩm: {{ $product->product_name}}</label>
    </div>
    <a href="{{asset('/backend/product/remove')}}/{{$product->id}}" class="btn btn-danger">Có</a>
    <a href="{{asset('/backend/product/index')}}" class="btn btn-info">Không</a>
@endsection