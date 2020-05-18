@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-2 mt-4">
                <h1 class="h3 font-weight-normal">一覧</h1>
            </div>
            <div class="mt-3 mb-3">
                <button class="btn btn-success" onclick="location.href='{{ route('admin.product_categories.edit', $data->id) }}'">編集</button>
            </div>
            <div class="mt-3 ml-4 mb-3" @if($disp_flg != 0) hidden @endif>
                <form class="form-signin" method="POST" action="{{ route('admin.product_categories.destroy', $data->id) }}">
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
                {{ $data->id }}
            </div>
        </div>
        <div class="row mt-2 border-top">
            <div class="col-2 mt-3">
                <strong>名称</strong>
            </div>
            <div class="col-10 mt-3">
                {{ $data->name }}
            </div>
        </div>
        <div class="row mt-2 border-top">
            <div class="col-2 mt-3">
                <strong>並び順番号</strong>
            </div>
            <div class="col-10 mt-3">
                {{ $data->order_no }}
            </div>
        </div>
    </div>
</div>
@endsection
