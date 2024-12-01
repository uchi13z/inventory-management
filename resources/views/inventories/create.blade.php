@extends('layouts.app')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--link rel="stylesheet" href="{{ asset('css/app.css') }}"-->
@endpush

@section('content')
<div id="container">
    <h1>新規登録</h1>

    <!-- エラーメッセージの表示 -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table table-striped">
        <form action="{{ route('inventories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>数量</th>
                    <th>価格</th>
                    <th>商品画像</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name') }}">
                        @if ($errors->has('product_name'))
                            <span class="text-danger">{{ $errors->first('product_name') }}</span>
                        @endif
                    </td>
                    <td>
                        <input type="text" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}">
                        @if ($errors->has('quantity'))
                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                        @endif
                    </td>
                    <td>
                        <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </td>
                    <td>
                        <input type="file" name="product_image" id="product_image" class="form-control">
                        @if ($errors->has('product_image'))
                            <span class="text-danger">{{ $errors->first('product_image') }}</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        <button type="submit" class="btn btn-primary">登録</button>
        </form>
    </table>
</div>
@endsection
