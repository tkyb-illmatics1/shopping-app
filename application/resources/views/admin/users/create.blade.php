@extends('layouts.admin')

@section('content')
    <div class="col-12 mt-4">
        <form class="form-signin" method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
            @csrf

            <h1 class="h3 font-weight-normal">名称</h1>
            <input type="text" id="name" class="mb-3 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="名称" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">メールアドレス</h1>
            <input type="text" id="email" class="mb-3 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="メールアドレス" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">パスワード</h1>
            <input type="password" id="password" class="mb-3 form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="パスワード" autofocus>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <h1 class="h3 font-weight-normal">パスワード(確認)</h1>
            <input id="password-confirm" type="password" class="mb-3 form-control" name="password_confirmation" autocomplete="new-password" placeholder="パスワード(確認)" autofocus>

            <h1 class="h3 font-weight-normal">イメージ</h1>
            <input type="file" class="form-control-file" id="image_path" name="image_path">
            @error('image_path')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="row">
                <div class="col-2 mt-4">
                    <a class="btn btn-lg btn-dark" href="{{ route('admin.users.index') }}">キャンセル</a>
                </div>
                <div class="col-2 mt-4">
                    <button class="btn btn-lg btn-primary" type="submit" name="action" value="create">作成</button>
                </div>
            </div>
        </form>
    </div>
@endsection
