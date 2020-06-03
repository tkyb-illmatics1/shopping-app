@extends('layouts.admin')

@section('content')
    <div class="col-12 mt-4">
        <form class="form-signin" method="POST" action="{{ route('admin.product_categories.update', $productCategory) }}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $productCategory['id'] }}">

            <h1 class="h3 font-weight-normal">名称</h1>
            <input type="text" id="name" class="mb-3 form-control @error('name') is-invalid @enderror" name="name" value="{{ $productCategory['name'] }}" placeholder="名称" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <h1 class="h3 font-weight-normal">並び順番号</h1>
            <input type="text" id="order_no" class="mb-3 form-control @error('order_no') is-invalid @enderror" name="order_no" value="{{ $productCategory['order_no'] }}" placeholder="並び順番号" autofocus>
            @error('order_no')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="row">
                <div class="col-2 mt-4">
                    <a class="btn btn-lg btn-dark" href="{{ route('admin.product_categories.show', $productCategory) }}">キャンセル</a>
                </div>
                <div class="col-2 mt-4">
                    <button class="btn btn-lg btn-primary" type="submit" name="action" value="update">更新</button>
                </div>
            </div>
        </form>
    </div>
@endsection
