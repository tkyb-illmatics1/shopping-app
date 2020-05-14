@extends('layouts.admin')

@section('content')
    <div class="mt-3 mb-3">
        <button class="btn btn-success" action="{{ route('admin.home') }}">新規</button>
    </div>
    <div class="mt-3 mb-3">
        <button class="btn btn-danger" action="{{ route('admin.home') }}">削除</button>
    </div>
@endsection
