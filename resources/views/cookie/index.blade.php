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
    <p>{{ $msg }}</p>
    @if (count($errors) > 0)
        <p>入力に問題があります。再入力して下さい。</p>
    @endif
    <table>
        <form action="/cookie" method="post">
            @csrf
            @if ($errors->has('msg'))
                <tr>
                    <th>ERROR</th>
                    <td>{{ $errors->first('msg') }}</td>
                </tr>
            @endif
            <tr>
                <th>Message: </th>
                <td><input type="text" name="msg" value="{{ old('msg') }}"></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="send"></td>
            </tr>
        </form>
    </table>
@endsection


@section('footer')
    copyright 2017 tuyano.
@endsection
