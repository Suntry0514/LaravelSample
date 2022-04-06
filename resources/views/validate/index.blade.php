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
    {{-- $errorsには３つのメソッドがある
        all()：全てのエラーメッセージを配列で取得
        first('値')：指定した項目の最初のエラーメッセージを配列で取得
        get('値')：指定した項目のエラーメッセージ全てを配列で取得
    --}}
    @if (count($errors) > 0)
        <p>入力に問題があります。再入力して下さい。</p>
    @endif
    <table>
        <form action="/validate" method="post">
            @csrf
            {{-- エラーがあるか確認 --}}
            {{-- 記載パターン① Laravel〜5.7まで--}}
            @if ($errors->has('name'))
                <tr>
                    <th>ERROR</th>
                    <td>{{ $errors->first('name') }}</td>
                </tr>
            @endif
            <tr>
                <th>name: </th>
                {{-- old()と記載することで、validateでエラーがあった際、submitボタン押下前の値を設定できる --}}
                <td><input type="text" name="name" value="{{ old('name') }}"></td>
            </tr>
            {{-- エラーがあった際に表示される --}}
            {{-- 記載パターン① Laravel5.8より〜--}}
            @error('mail')
                <tr>
                    <th>ERROR</th>
                    <td>{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <th>mail: </th>
                <td><input type="text" name="mail" value="{{ old('mail') }}"></td>
            </tr>
            @error('age')
                <tr>
                    <th>ERROR</th>
                    <td>{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <th>age: </th>
                <td><input type="text" name="age" value="{{ old('age') }}"></td>
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
