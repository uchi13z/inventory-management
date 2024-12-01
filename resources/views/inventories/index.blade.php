@extends('layouts.app')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--link rel="stylesheet" href="{{ asset('css/app.css') }}"-->
@endpush

@section('content')
<div class="header">
    <div class="mokuteki-container">
        <p class="mokuteki" style="font-size: 20px;">Laravelの学習目的で、簡素なものではありますが作成いたしました</p>
    </div>
</div>
<div id="container">
    <h1>在庫アイテム一覧</h1>
    <a href="{{ route('inventories.create') }}" class="btn btn-primary">新規登録</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品名</th>
                <th>アクション</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventories as $inventory)
                <tr>
                    <td>{{ $inventory->id }}</td>
                    <td>{{ $inventory->product_name }}</td>
                    <td>
                        <a href="{{ route('inventories.show', $inventory->id) }}" class="btn btn-info">詳細</a>
                        <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-warning">更新</a>
                        <!-- 削除ボタン -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $inventory->id }}">
                            削除
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- 削除確認モーダル -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">削除確認</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    本当に削除してもよろしいですか？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-danger">削除</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <!-- BootstrapのJSを読み込む -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var deleteUrlTemplate = "{{ route('inventories.destroy', ['inventory' => '__ID__']) }}";
        document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = document.getElementById('deleteModal');
        var deleteForm = document.getElementById('deleteForm');

        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var inventoryId = button.getAttribute('data-id');
            // '__ID__' を実際のIDに置き換える
            var deleteUrl = deleteUrlTemplate.replace('__ID__', inventoryId);
            // フォームのアクションを設定
            deleteForm.action = deleteUrl;
        });
    });
    </script>
@endpush
