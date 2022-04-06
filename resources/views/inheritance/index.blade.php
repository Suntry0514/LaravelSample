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
    <p>ここが本文のコンテンツです。</p>
    <p>必要なだけ記述できます。</p>

    @component('components.message')
        {{-- @slotで変数の宣言をしている --}}
        @slot('msg_title')
            CAUTION!
        @endslot

        @slot('msg_content')
            これはコンポーネントのメッセージの表示です。
        @endslot
    @endcomponent

    {{-- サブビューの書き方 --}}
    @include('components.message', ['msg_title' => 'OK', 'msg_content' => 'これは、サブビューです。'])
    {{-- コレクションビュー　繰り返しの表示 --}}
    <ul>
        @each('components.item', $array, 'item')
    </ul>



@endsection

@section('footer')
    copyright 2017 tuyano.
@endsection
