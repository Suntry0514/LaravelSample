@extends('layouts.helloapp')

@section('title', 'Person.index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <table>
        <tr>
            <th>Data</th>
            <th>Board</th>
            <th>Boards</th>
            <th></th>
        </tr>
        {{-- $itemにはpersonモデルが１つ１つ代入されていく --}}
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->getData() }}</td>
                <td>
                    {{-- boardテーブルとhasOneの関係のため、bordをプロパティとして扱うことができる --}}
                    @if ($item->board != null)
                        {{ $item->board->getData() }}
                    @endif
                </td>
                <td>
                    {{-- boardテーブルとhasManyの関係のため、bordをプロパティとして扱うことができる --}}
                    @if ($item->boards != null)
                        <table width="100%">
                            @foreach ($item->boards as $obj)
                                <tr>
                                    <td>{{ $obj->getData() }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                </td>
                <td>
                    <input type="button" onclick="location.href='/person/edit?id={{ $item->getID() }}'" value="更新ページ">
                    <input type="button" onclick="location.href='/person/del?id={{ $item->getID() }}'" value="削除">
                </td>
            </tr>
        @endforeach

        {{-- カラムの関連付けがあるものとないものを別々に表示 --}}
        <table>
            <tr>
                <th>Person</th>
                <th>Board</th>
            </tr>
            @foreach ($hasItems as $item)
                <tr>
                    <td>{{ $item->getData() }}</td>
                    <td>
                        <table width="100%">
                            @foreach ($item->boards as $obj)
                                <tr>
                                    <td>{{ $obj->getData() }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            @endforeach
        </table>
        <div style="margin:10px;"></div>
        <table>
            <tr>
                <th>Person</th>
            </tr>
            @foreach ($noItems as $item)
                <tr>
                    <td>{{ $item->getData() }}</td>
                </tr>
            @endforeach
        </table>

    </table>

    <input type="button" onclick="location.href='/person/find'" value="検索ページ">
    <input type="button" onclick="location.href='/person/add'" value="追加ページ">

@endsection

@section('footer')
    copyright 2017 tuyano.
@endsection
