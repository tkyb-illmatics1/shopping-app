@extends('layouts.admin')

@section('content')
    <div class="col-12 mt-4">
        <form class="form-signin" method="GET" action="{{ route('admin.admin_users.index') }}">
            @csrf
            <div class="border row center-block text-center">
                <div class="col-6 mt-4">
                    <input type="name" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ request('name') }}" placeholder="名称" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-6 mt-4">
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ request('email') }}" placeholder="メールアドレス" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-5 mt-4">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="authorityRadio1" name="iauthorityRadioOptions" value="999" @if (request('iauthorityRadioOptions') == 999) checked @endif>
                        <label class="form-check-label" for="authorityRadio1">すべての権限</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="authorityRadio2" name="iauthorityRadioOptions"  value="1" @if (request('iauthorityRadioOptions') == 1) checked @endif>
                        <label class="form-check-label" for="authorityRadio2">オーナー</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="authorityRadio3" name="iauthorityRadioOptions"  value="0" @if (request('iauthorityRadioOptions') == 0) checked @endif>
                        <label class="form-check-label" for="authorityRadio3">一般</label>
                    </div>
                </div>
                <div class="col-7 mt-4">
                </div>
                <div class="col-4 mt-4">
                    <select class="form-control" name="sortType">
                        <option value="id" @if (request('sortType') == "id") selected="selected" @endif>並び替え: ID</option>
                        <option value="name"  @if (request('sortType') == "name") selected="selected" @endif>並び替え: 名称</option>
                        <option value="email"  @if (request('sortType') == "email") selected="selected" @endif>並び替え: メールアドレス</option>
                    </select>
                </div>
                <div class="col-4 mt-4">
                    <select class="form-control" name="sortOrder">
                        <option value="asc" @if (request('sortOrder') == "asc") selected="selected" @endif>並び替え方向: 昇順</option>
                        <option value="desc" @if (request('sortOrder') == "desc") selected="selected" @endif>並び替え方向: 降順</option>
                    </select>
                </div>
                <div class="col-2 mt-4">
                    <select class="form-control" name="display">
                        <option value="10" @if (request('display') == 10) selected="selected" @endif>表示: 10件</option>
                        <option value="20" @if (request('display') == 20) selected="selected" @endif>表示: 20件</option>
                        <option value="50" @if (request('display') == 50) selected="selected" @endif>表示: 50件</option>
                        <option value="100" @if (request('display') == 100) selected="selected" @endif>表示: 100件</option>
                    </select>
                </div>
                <div class="col-2 mt-4 mb-4">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">検索</button>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-3 mb-3">
        <button class="btn btn-success" onclick="location.href='{{ route('admin.admin_users.create') }}'">新規</button>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">名称</th>
                <th scope="col">メールアドレス</th>
                <th scope="col">権限</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($lists as $list)
            <tr>
                <th scope="row">{{ $list->id }}</th>
                <td>{{ $list->name }}</td>
                <td>{{ $list->email }}</td>
                @if ($list->is_owner == 0)
                <td>一般</td>
                @else
                <td>オーナー</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $lists->appends(request()->query())->links() }}

@endsection
