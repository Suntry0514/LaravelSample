{{-- レイアウトの継承設定 --}}
@extends('layouts.helloapp')
{{-- sectionの表示内容を設定 --}}
@section('title', 'Index')

{{-- セクションの上書きをしている --}}
@section('menubar')
    {{-- @parent：継承元のレイアウトのセクションを使用する --}}
    @parent
    インデックスページ
@endsection

@section('content')
    <style>
        .buttons {
            text-align: left;
        }

        .button {
            display: inline-block;
            background: #ffc33c;
            margin: 5px 5px;
            padding: 10px 5px;
            border-radius: 4px;
            color: #FFF;
            text-decoration: none;
        }

    </style>
    <table>
        <tr>
            <th>Name</th>
            <th>Mail</th>
            <th>Age</th>
            <th></th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->mail }}</td>
                <td>{{ $item->age }}</td>
                <td>
                    <button type="button" onclick="location.href='/db/edit?id={{ $item->id }}'">編集</button>
                    <button type="button" onclick="location.href='/db/remove?id={{ $item->id }}'">削除</button>
                    <button type="button" onclick="location.href='/db/show?id={{ $item->id }}'">詳細</button>
                </td>
            </tr>
        @endforeach
    </table>

    {{-- ページの遷移をする際は、<a></a>タグを用いて、アドレスへ遷移すれば良い。※この時、ルートの設定は必ず行なっていること --}}
    <div class="buttons">
        <a href="/db/add" class="button">データの追加</a>
    </div>

@endsection

@section('footer')
    copyright 2017 tuyano.
@endsection
