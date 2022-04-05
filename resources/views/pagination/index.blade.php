@extends('layouts.helloapp')
<style>
    .pagination {
        font-size: 10pt;
    }

    .pagination li {
        display: inline-block
    }

    tr th a:link {
        color: white;
    }

    tr th a:visited {
        color: white;
    }

    tr th a:hover {
        color: white;
    }

    tr th a:active {
        color: white;
    }

</style>
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <input type="button" onclick="location.href='/pagination/auth'" value="自作認証ページ">
    {{-- Auth関連部分 --}}
    {{-- Auth::check()で現在アクセスしているユーザーがログインしているかどうかを確認している --}}
    @if (Auth::check())
        <p>USER: {{ $user->name . ' (' . $user->email . ')' }}</p>
    @else
        <p>※ログインしていません。（<a href="/login">ログイン</a>｜
            <a href="/register">登録</a>）
        </p>
    @endif

    <table>
        <tr>
            <th><a href="/pagenation?sort=name">name</a></th>
            <th><a href="/pagenation?sort=mail">mail</a></th>
            <th><a href="/pagenation?sort=age">age</a></th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->mail }}</td>
                <td>{{ $item->age }}</td>
            </tr>
        @endforeach
    </table>
    {{-- appendsで生成するリンクにパラメータを追加している --}}
    {{-- 追加することによって、次のページに移動した時でもソート順が維持されるようになる --}}
    {{-- linksの()の中に定義しなければ表示がおかしくなる https://turningp.jp/programing/php/laravel/paginate-layout
        定義する前にphp artisan vendor:publish --tag=laravel-pagination コマンドを実行する必要がある --}}
    {{ $items->appends(['sort' => $sort])->links('pagination::bootstrap-4') }}
@endsection

@section('footer')
    copyright 2017 tuyano.
@endsection
