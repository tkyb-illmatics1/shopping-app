@extends('layouts.admin')

@section('content')
    <div class="col-12 mt-4">
        <form class="form-signin" method="POST" action="{{ route('admin.admin_users.store') }}">
            @csrf

            <h1 class="h3 font-weight-normal">名称</h1>
            <input type="text" id="name" class="mb-3 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="名称" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">並び順番号</h1>
            <input type="text" id="order_no" class="mb-3 form-control @error('order_no') is-invalid @enderror" name="order_no" value="{{ old('order_no') }}" placeholder="並び順番号" autofocus>
            @error('order_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">パスワード</h1>
            <input type="text" id="password" class="mb-3 form-control @error('password') is-invalid @enderror" name="password" value="" placeholder="パスワード" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">パスワード(確認)</h1>
            <input type="text" id="password2" class="mb-3 form-control @error('password2') is-invalid @enderror" name="password2" value="" placeholder="パスワード(確認)" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="col-5 mt-4">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="authorityRadio2" name="iauthorityRadioOptions"  value="1" @if (old('iauthorityRadioOptions') == 1) checked @endif>
                    <label class="form-check-label" for="authorityRadio2">オーナー</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="authorityRadio3" name="iauthorityRadioOptions"  value="0" @if (old('iauthorityRadioOptions') == 0) checked @endif>
                    <label class="form-check-label" for="authorityRadio3">一般</label>
                </div>
            </div>

            <div class="row">
                <div class="col-2 mt-4">
                    <a class="btn btn-lg btn-dark" href="{{ route('admin.admin_users.index') }}">キャンセル</a>
                </div>
                <div class="col-2 mt-4">
                    <button class="btn btn-lg btn-primary" type="submit" name="action" value="create">作成</button>
                </div>
            </div>
        </form>
    </div>
@endsection
