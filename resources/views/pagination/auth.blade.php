@extends('layouts.helloapp')

@section('title', 'ユーザー認証')

@section('menubar')
    @parent
    ユーザー認証ページ
@endsection

@section('content')
    <p>{{ $message }}</p>
    <table>
        <form action="/pagination/auth" method="post">
            {{ csrf_field() }}
            <tr>
                <th>mail: </th>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <th>pass: </th>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="send"></td>
            </tr>
        </form>
    </table>

    <input type="button" onclick="location.href='/pagination'" value="戻る">
@endsection

@section('footer')
    copyright 2017 tuyano.
@endsection
