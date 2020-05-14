@extends('layouts.admin')

@section('content')
<div class="col-12 mt-4">
        <form class="form-signin" method="POST" action="{{ route('admin.admin_users') }}">
            @csrf

            <h1 class="h3 font-weight-normal">名称</h1>
            <input type="text" id="name" class="mb-3 form-control @error('name') is-invalid @enderror" name="name" value="{{ $old['name'] }}" placeholder="名称" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <h1 class="h3 font-weight-normal">メールアドレス</h1>
            <input type="email" id="email" class="mb-3 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="メールアドレス" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <h1 class="h3 font-weight-normal">パスワード</h1>
            <input type="password" id="password" class="mb-3 form-control @error('password') is-invalid @enderror" name="password" placeholder="パスワード">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <h1 class="h3 font-weight-normal">パスワード(確認)</h1>
            <input type="password" id="password" class="mb-3 form-control @error('password') is-invalid @enderror" name="password" placeholder="パスワード(確認)">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="col-5 mt-4">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="authorityRadio1" name="iauthorityRadioOptions"  value="0" @if ($old['iauthority'] == 0) checked @endif>
                    <label class="form-check-label" for="authorityRadio3">一般</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="authorityRadio2" name="iauthorityRadioOptions"  value="1" @if ($old['iauthority'] == 1) checked @endif>
                    <label class="form-check-label" for="authorityRadio2">オーナー</label>
                </div>
            </div>
            <div class="col-2 mt-4">
                <!-- <button class="btn btn-lg btn-dark btn-block" name="action" value="back">キャンセル</button> -->
            </div>
            <div class="col-2 mt-4">
                <!-- <button class="btn btn-lg btn-primary btn-block" type="submit">作成</button> -->
            </div>
        </form>
    </div>
@endsection
