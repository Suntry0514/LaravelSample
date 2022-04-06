<html>

<head>
    <title>Hello/Index</title>
    <style>
        body {
            font-size: 16pt;
            color: #999;
        }

        h1 {
            font-size: 50pt;
            text-align: right;
            color: #f6f6f6;
            margin: -20px 0px -30px 0px;
            letter-spacing: -4pt;
        }

    </style>
</head>

<body>
    <h1>Blade/Index</h1>
    {{-- phpを使用する際は以下のように{{}}で囲む --}}
    @if ($msg != '')
    <p>こんにちは、{{$msg}}さん。</p>
    @else
    <p>何か書いて下さい。</p>
    @endif

    {{-- falseの場合にtrueになる --}}
    @unless ($msg == '')
    <p>msg変数には値が入っています。</p>
    @endunless

    @empty($test)
    <p>test変数には値が入っていません。</p>
    @endempty

    @isset($msg)
    <p>msg変数は定義されています。</p>
    @endisset

    {{-- @foreachと$loopの使い方 --}}
    @foreach ( $array as $item )
    @if ($loop->first)
    <p>※データ一覧</p><ul>
    @endif
    <li>No,{{$loop->iteration}}. {{$item}}</li>
    @if ($loop->last)
    </ul><p>ーーーーここまで</p>
    @endif
    @endforeach

    {{-- @whileと@phpの使い方 @phpは最小限に使用する --}}
    <ol>
        @php
        $counter = 0;
        @endphp
        @while ($counter < count($data))
        <li>{{$data[$counter]}}</li>
        @php
        $counter++;
        @endphp
        @endwhile
        </ol>

    <form method="POST" action="/blade">
        {{-- Laravel5.5までは⇨ものを使用する。 {{ csrf_field() }} --}}
        {{-- Laravel5.6以降は⇨のものを使用する　@csrf --}}
        @csrf{{-- CSRF対策をするためのBladeディレクティブと呼ばれるもの。用意されたフォーム以外からの送信をつけつけないようにする。  --}}
        <input type="text" name="msg">
        <input type="submit">
    </form>
</body>

</html>
