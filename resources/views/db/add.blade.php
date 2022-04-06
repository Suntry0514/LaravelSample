@extends('layouts.helloapp')

@section('title', 'Add')

@section('menubar')
    @parent
    新規作成ページ
@endsection

@section('content')
    @if (count($errors) > 0)
        <p>
            入力に問題があります。再入力してください。</p>
    @endif
    <table>
        <form action="/db/add" method="post">
            @csrf
            <tr>
                <th>name: </th>
                <td>
                    <input type="text" name="name" value="{{ old('name') }}">
                    @error('name')
                        <font color="red">Error : {{ $errors->first('name') }}</font>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>mail: </th>
                <td>
                    <input type="text" name="mail" value="{{ old('mail') }}">
                    @error('mail')
                        <font color="red">Error : {{ $errors->first('mail') }}</font>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>age: </th>
                <td>
                    <input type="text" name="age" value="{{ old('age') }}">
                    @error('age')
                        <font color="red">Error : {{ $errors->first('age') }}</font>
                    @enderror
                </td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="send"></td>
            </tr>
        </form>
    </table>
    <input type="button" onclick="history.back()" value="戻る">
@endsection

@section('footer')
    copyright 2017 tuyano.
@endsection
