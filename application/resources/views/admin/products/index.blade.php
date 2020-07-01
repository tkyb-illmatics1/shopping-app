@extends('layouts.admin')

@section('content')
    <div class="col-12 mt-4">
        <form class="form-signin" method="GET" action="{{ route('admin.products.index') }}">
            @csrf
            <div class="border row center-block text-center">
                <div class="col-4 mt-4">
                    <select class="form-control" name="prductCategory">
                        <option value="" @if (request('prductCategory') == "") selected @endif>全てのカテゴリー</option>
                        @foreach ($productCategories as $productCategory)
                            <option value="{{$productCategory->id}}"  @if (request('prductCategory') == $productCategory['id']) selected @endif>{{$productCategory->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-8 mt-4">
                    <input type="name" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ request('name') }}" placeholder="名称" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-12 mt-4 input-group">
                    <input type="name" id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ request('price') }}" placeholder="価格" autofocus>
                    <div class="border form-check form-check-inline rounded-right">
                        <div class="mx-2">
                            <input class="form-check-input" type="radio" name="priceOperator" id="priceOperator1" value=">=" checked>
                            <label class="form-check-label" for="priceOperator1">
                                以上
                            </label>
                        </div>
                        <div class="mx-2">
                            <input class="form-check-input" type="radio" name="priceOperator" id="priceOperator2" value="<=" @if (request('priceOperator') == "<=" ) checked @endif>
                            <label class="form-check-label" for="priceOperator2">
                                以下
                            </label>
                        </div>
                    </div>
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    @error('operator')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="col-4 mt-4">
                    <select class="form-control" name="sortType">
                        <option value="id" @if (request('sortType') == "id") selected @endif>並び替え: ID</option>
                        <option value="product_category_id"  @if (request('sortType') == "product_category_id") selected @endif>並び替え: 商品カテゴリー</option>
                        <option value="name"  @if (request('sortType') == "name") selected @endif>並び替え: 名称</option>
                        <option value="price"  @if (request('sortType') == "price") selected @endif>並び替え: 価格</option>
                    </select>
                </div>
                <div class="col-4 mt-4">
                    <select class="form-control" name="sortDirection">
                        <option value="asc" @if (request('sortDirection') == "asc") selected @endif>並び替え方向: 昇順</option>
                        <option value="desc" @if (request('sortDirection') == "desc") selected @endif>並び替え方向: 降順</option>
                    </select>
                </div>
                <div class="col-2 mt-4">
                    <select class="form-control" name="pageUnit">
                        <option value="10" @if (request('pageUnit') == 10) selected @endif>表示: 10件</option>
                        <option value="20" @if (request('pageUnit') == 20) selected @endif>表示: 20件</option>
                        <option value="50" @if (request('pageUnit') == 50) selected @endif>表示: 50件</option>
                        <option value="100" @if (request('pageUnit') == 100) selected @endif>表示: 100件</option>
                    </select>
                </div>
                <div class="col-2 mt-4 mb-4">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">検索</button>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-3 mb-3">
        <button class="btn btn-success" onclick="location.href='{{ route('admin.products.create') }}'">新規</button>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">商品カテゴリ</th>
                <th scope="col">名称</th>
                <th scope="col">価格</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product['productCategory']['name'] }}</td>
                <td><a href="{{ route('admin.products.show', $product) }}">{{ $product->name }}</a></td>
                <td>¥{{ number_format($product->price) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->appends(request()->query())->links() }}

@endsection
