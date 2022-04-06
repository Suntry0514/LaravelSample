@extends('layouts.helloapp')

@section('title', 'Board.index')

@section('menubar')
    @parent
    ボード・ページ
@endsection

@section('content')
    <table>
        <tr>
            <th>Message</th>
            <th>Name</th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->message }}</td>
                <td>{{ $item->person->name }}</td>
            </tr>
        @endforeach
    </table>
    <input type="button" onclick="location.href='/board/add'" value="追加">
@endsection

@section('footer')
    copyright 2017 tuyano.
@endsection
