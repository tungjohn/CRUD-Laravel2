@extends('backend.layouts.main')

@section('title', 'Xóa admin')

@section('content')
    <h1>Xóa admin</h1>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url("/backend/admins/destroy/$admin->id") }} name="admin" method="post"">
        @csrf
        <div class="form-group">
            <label for="">ID admin:</label>
            <p>{{ $admin->id }}</p>
        </div>
        <div class="form-group">
            <label for="">Email admin:</label>
            <p>{{ $admin->email }}</p>
        </div>
        <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
    </form>
@endsection