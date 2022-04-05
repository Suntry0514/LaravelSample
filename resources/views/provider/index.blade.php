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
    <p>Controller value<br>'message' = {{ $message }}</p>
    <p>ViewComposer value<br>'view_message' = {{ $view_message }}</p>
@endsection

@section('footer')
    copyright 2017 tuyano.
@endsection
