@extends('layouts.admin')

@section('content')
    <div class="col-12 mt-4">
        <form class="form-signin" method="GET" action="{{ route('admin.product_categories.index') }}">
            @csrf
            <div class="border row center-block text-center">
                <div class="col-12 mt-4">
                    <input type="name" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $old['name'] }}" placeholder="名称" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-4 mt-4">
                    <select class="form-control" name="sortType">
                        <option value="id" @if ($old['sortType'] == "id") selected="selected" @endif>並び替え: ID</option>
                        <option value="name"  @if ($old['sortType'] == "name") selected="selected" @endif>並び替え: 名称</option>
                        <option value="order_no"  @if ($old['sortType'] == "order_no") selected="selected" @endif>並び替え: 並び順番号</option>
                    </select>
                </div>
                <div class="col-4 mt-4">
                    <select class="form-control" name="sortOrder">
                        <option value="asc" @if ($old['sortOrder'] == "asc") selected="selected" @endif>並び替え方向: 昇順</option>
                        <option value="desc" @if ($old['sortOrder'] == "desc") selected="selected" @endif>並び替え方向: 降順</option>
                    </select>
                </div>
                <div class="col-2 mt-4">
                    <select class="form-control" name="display">
                        <option value="10" @if ($old['display'] == 10) selected="selected" @endif>表示: 10件</option>
                        <option value="20" @if ($old['display'] == 20) selected="selected" @endif>表示: 20件</option>
                        <option value="50" @if ($old['display'] == 50) selected="selected" @endif>表示: 50件</option>
                        <option value="100" @if ($old['display'] == 100) selected="selected" @endif>表示: 100件</option>
                    </select>
                </div>
                <div class="col-2 mt-4 mb-4">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">検索</button>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-3 mb-3">
        <button class="btn btn-success" onclick="location.href='{{ route('admin.product_categories.create') }}'">新規</button>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">名称</th>
                <th scope="col">並び順番号</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($lists as $list)
            <tr>
                <th scope="row">{{ $list->id }}</th>
                <td><a href="{{ route('admin.product_categories.show', $list->id) }}">{{ $list->name }}</a></td>
                <td>{{ $list->order_no }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $paginate->appends(['name'=>$old['name'], 'sortType'=>$old['sortType'], 'sortOrder'=>$old['sortOrder'], 'display'=>$old['display']])->render() !!}

@endsection
