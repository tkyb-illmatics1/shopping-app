@extends('layouts.admin')

@section('content')
    <div class="col-12 mt-4">
        <form class="form-signin" method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <h1 class="h3 font-weight-normal">商品カテゴリ</h1>
            <select class="form-control" name="product_category_id">
                @foreach ($productCategories as $productCategory)
                    <option value="{{$productCategory->id}}"  @if ($product['product_category_id'] == $productCategory['product_category_id']) selected @endif>{{$productCategory->name}}</option>
                @endforeach
            </select>
            @error('product_category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">名称</h1>
            <input type="text" id="name" class="mb-3 form-control @error('name') is-invalid @enderror" name="name" value="{{ $product['name'] }}" placeholder="名称" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">価格</h1>
            <input type="text" id="price" class="mb-3 form-control @error('price') is-invalid @enderror" name="price" value="{{ $product['price'] }}" placeholder="価格" autofocus>
            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">説明</h1>
            <input type="text" id="description" class="mb-3 form-control @error('description') is-invalid @enderror" name="description" value="{{ $product['description'] }}" placeholder="説明" autofocus>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">イメージ</h1>
            <input type="file" class="form-control-file" id="image_path" name="image_path">
            <div>
                <input type="checkbox" class="mt-4" name="deleteFlg" value="1"> 削除
            </div>
            <img class="mt-4" src="/storage/{{ $product->image_path }}">
            @error('image_path')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


            <div class="row">
                <div class="col-2 mt-4">
                    <a class="btn btn-lg btn-dark" href="{{ route('admin.products.show', $product) }}">キャンセル</a>
                </div>
                <div class="col-2 mt-4">
                    <button class="btn btn-lg btn-primary" type="submit" name="action" value="update">更新</button>
                </div>
            </div>
        </form>
    </div>
@endsection
