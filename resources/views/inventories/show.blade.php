@extends('layouts.app')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--link rel="stylesheet" href="{{ asset('css/app.css') }}"-->
@endpush

@section('content')
<div id="container">
    <h1>商品詳細</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品名</th>
                <th>数量</th>
                <th>価格</th>
                <th>商品画像</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $inventory->id }}</td>
                <td>{{ $inventory->product_name }}</td>
                <td>{{ $inventory->quantity }}</td>
                <td>{{ $inventory->price }}</td>
                <td>
                    @if ($inventory->product_image)
                        <p>Image URL: {{ asset('storage/' . $inventory->product_image) }}</p>
                        <img src="{{ asset('storage/' . $inventory->product_image) }}" style="width: 300px; height: auto;">
                    @else
                        画像なし
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('inventories.index') }}" class="btn btn-primary">一覧に戻る</a>
</div>
@endsection

