@extends('layouts.admin')

@section('content')
    <div class="col-12 mt-4">
        <form class="form-signin" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf

            <h1 class="h3 font-weight-normal">商品カテゴリ</h1>
            <select class="form-control" name="product_category_id">
                @foreach ($productCategories as $productCategory)
                    <option value="{{$productCategory->id}}"  @if (old('product_category_id') == $productCategory['id']) selected @endif>{{$productCategory->name}}</option>
                @endforeach
            </select>
            @error('product_category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">名称</h1>
            <input type="text" id="name" class="mb-3 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="名称" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">価格</h1>
            <input type="text" id="price" class="mb-3 form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="価格" autofocus>
            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">説明</h1>
            <input type="text" id="description" class="mb-3 form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" placeholder="説明" autofocus>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">イメージ</h1>
            <input type="file" class="form-control-file" id="image_path" name="image_path">
            @error('image_path')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="row">
                <div class="col-2 mt-4">
                    <a class="btn btn-lg btn-dark" href="{{ route('admin.products.index') }}">キャンセル</a>
                </div>
                <div class="col-2 mt-4">
                    <button class="btn btn-lg btn-primary" type="submit" name="action" value="create">作成</button>
                </div>
            </div>
        </form>
    </div>
@endsection
