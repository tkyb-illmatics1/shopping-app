@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-2 mt-4">
                <h1 class="h3 font-weight-normal">一覧</h1>
            </div>
            <div class="mt-3 mb-3">
                <button class="btn btn-success" onclick="location.href='{{ route('admin.products.edit', $product) }}'">編集</button>
            </div>
            <div class="mt-3 ml-4 mb-3">
                <form class="form-signin" method="POST" action="{{ route('admin.products.destroy', $product) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">削除</button>
                </form>
            </div>
        </div>
        <div class="row mt-2 border-top">
            <div class="col-2 mt-3">
                <strong>ID</strong>
            </div>
            <div class="col-10 mt-3">
                {{ $product->id }}
            </div>
        </div>
        <div class="row mt-2 border-top">
            <div class="col-2 mt-3">
                <strong>商品カテゴリ</strong>
            </div>
            <div class="col-10 mt-3">
                {{ $product['productCategory']['name'] }}
            </div>
        </div>
        <div class="row mt-2 border-top">
            <div class="col-2 mt-3">
                <strong>名称</strong>
            </div>
            <div class="col-10 mt-3">
                {{ $product->name }}
            </div>
        </div>
        <div class="row mt-2 border-top">
            <div class="col-2 mt-3">
                <strong>価格</strong>
            </div>
            <div class="col-10 mt-3">
                ¥{{ number_format($product->price) }}
            </div>
        </div>
        <div class="row mt-2 border-top">
            <div class="col-2 mt-3">
                <strong>説明</strong>
            </div>
            <div class="col-10 mt-3">
                {{ $product->description }}
            </div>
        </div>
        <div class="row mt-2 border-top">
            <div class="col-2 mt-3">
                <strong>イメージ</strong>
            </div>
            <div class="col-10 mt-3">
                <img src="/storage/{{ $product->image_path }}">
            </div>
        </div>


    </div>
</div>
@endsection
