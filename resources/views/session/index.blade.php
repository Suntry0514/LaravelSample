{{-- レイアウトの継承設定 --}}
@extends('layouts.helloapp')
{{-- sectionの表示内容を設定 --}}
@section('title', 'Index')

{{-- セクションの上書きをしている --}}
@section('menubar')
    {{-- @parent：継承元のレイアウトのセクションを使用する --}}
    @parent
    {{$message_title }}
@endsection

@section('content')
    <input type="button" onclick="location.href='/session/comfirm'" value="セッション確認ページへ">
@endsection

@section('footer')
    copyright 2017 tuyano.
@endsection
