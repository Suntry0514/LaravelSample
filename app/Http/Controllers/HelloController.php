<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{    public function index($msg='no, message'){
    return <<<EOF
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hello/Index</title>
</head>
<body>
<h1>Index</h1>
<p>これは、Helloコントローラーのindexアクションです。</p>
<p>{$msg}</p>
</body>
</html>
EOF;
    }
}
