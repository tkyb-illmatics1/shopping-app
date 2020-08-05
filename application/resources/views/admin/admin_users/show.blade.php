@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-2 mt-4">
            @can('index', $adminUser)
                <h1 class="h3 font-weight-normal">一覧</h1>
            @endcan
            </div>
            <div class="mt-3 mb-3">
                <button class="btn btn-success" onclick="location.href='{{ route('admin.admin_users.edit', $adminUser) }}'">編集</button>
            </div>
            @can('delete', $adminUser)
                <div class="mt-3 ml-4 mb-3">
                    <form class="form-signin" method="POST" action="{{ route('admin.product_categories.destroy', $adminUser) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">削除</button>
                    </form>
                </div>
            @endcan
        </div>
        <div class="row mt-2 border-top">
            <div class="col-2 mt-3">
                <strong>ID</strong>
            </div>
            <div class="col-10 mt-3">
                {{ $adminUser->id }}
            </div>
        </div>
        <div class="row mt-2 border-top">
            <div class="col-2 mt-3">
                <strong>名称</strong>
            </div>
            <div class="col-10 mt-3">
                {{ $adminUser->name }}
            </div>
        </div>
        <div class="row mt-2 border-top">
            <div class="col-2 mt-3">
                <strong>メールアドレス</strong>
            </div>
            <div class="col-10 mt-3">
                {{ $adminUser->email }}
            </div>
        </div>
        <div class="row mt-2 border-top">
            <div class="col-2 mt-3">
                <strong>権限</strong>
            </div>
            <div class="col-10 mt-3">
                @if ($adminUser->is_owner == 0) 一般 @else オーナー @endif
            </div>
        </div>
    </div>
</div>
@endsection
