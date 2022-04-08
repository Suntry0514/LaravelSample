<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloMultiActController;
use App\Http\Controllers\HelloReqResContrller;
use App\Http\Middleware\HelloMiddleware;
use App\Http\Controllers\HelloValidateController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\DBController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\RestappController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PaginationController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//view関数を使用することで、resources\viewsにある.blade.phpを呼び出す
Route::get('/', function () {
    return view('welcome');
});

//*****Controllerのみを使用しての画面の表示 */
//{msg}に入った値が、$msgに渡される。これにより、URLによって、表示する内容を動的に変更することができる
Route::get('hello/{msg?}',function($msg='no,message'){
    $html = <<<EOF
    <html><body><h1>Hello</h1><p>THis is sample {$msg} page.</p></body></html>
    EOF;
    return $html;
});

//Controllerフォルダの中にある、アクションメソッドを指定
Route::get('Hello/{msg?}', 'App\Http\Controllers\HelloController@index');

//マルチアクションコントローラー
Route::get('Multi', [HelloMultiActController::class,'index']);
Route::get('Multi/other', [HelloMultiActController::class,'other']);

//シングルアクションコントローラ アクションメソッドを指定しなくて良い　_invokeアクションメソッドだけが実行される
Route::get('Single', 'App\Http\Controllers\HelloSingleActContrller');

//Request Responseの確認
Route::get('ReqRes', [HelloReqResContrller::class,'index']);


//**テンプレート + Controller を使用しての画面の表示  引数＋ルートパラメータで値を渡す*/
Route::get('templete/{id?}', 'App\Http\Controllers\templeteController@index');

//queryで値を受け取る。
Route::get('templete/{id?}/query', 'App\Http\Controllers\templeteController@query');

//bladeファイルを使用しての画面の表示
Route::get('blade', 'App\Http\Controllers\bladeContrller@index');
//以下のbladeはformタグのaction属性と同じにする
Route::post('blade', 'App\Http\Controllers\bladeContrller@post');

//Layoutの継承
Route::get('inheritance', 'App\Http\Controllers\InheritanceController@index');

//ServiceProviderの使用
Route::get('provider', 'App\Http\Controllers\providerController@index');

//middlewareの使用 ->middlewareはメソッドチェーンとして複数記述できる.
//以下ではグローバルミドルウェア、ローカルミドルウェア(->middleware〜と記載している部分)を使用して画面を表示している
Route::get('middleware', 'App\Http\Controllers\middlewareController@index')->middleware(HelloMiddleware::class)->middleware('middleware_ato');


//validater
Route::get('validate', [HelloValidateController::class, 'index']);
Route::post('validate', [HelloValidateController::class, 'post']);

//Cookie
Route::get('cookie', [CookieController::class, 'index']);
Route::post('cookie', [CookieController::class, 'post']);

//DBクラス
Route::get('db',     [DBController::class, 'index']);
Route::get('db/add', [DBController::class, 'add']);
Route::post('db/add', [DBController::class, 'create']);
Route::get('db/edit', [DBController::class, 'edit']);
Route::post('db/edit', [DBController::class, 'update']);
//同じ画面で処理を行いたい場合でも、postだけではなく、getも必要になる。
//getでサーバーにリクエストして、postでクライアントにレスポンスするため、セットで使用する必要がる。
Route::get('db/remove', [DBController::class, 'remove']);
Route::post('db/remove', [DBController::class, 'remove']);
Route::get('db/show', [DBController::class, 'show']);
Route::post('db/show', [DBController::class, 'show']);

//Eloquent(ORM)
Route::get('person', [PersonController::class, 'index']);
Route::get('person/find', [PersonController::class, 'find']);
Route::post('person/find', [PersonController::class, 'search']);
Route::get('person/add', [PersonController::class, 'add']);
Route::post('person/add', [PersonController::class, 'create']);
Route::get('person/edit', [PersonController::class, 'edit']);
Route::post('person/edit', [PersonController::class, 'update']);
Route::get('person/del', [PersonController::class, 'remove']);
Route::post('person/del', [PersonController::class, 'remove']);

//リレーショナル関係
Route::get('board', [BoardController::class, 'index']);
Route::get('board/add', [BoardController::class, 'add']);
Route::post('board/add', [BoardController::class, 'create']);
//restのサブユーを埋め込んている
Route::get('board/rest', [BoardController::class, 'rest']);

//REST
//Route::resource：７つのアクション(index,create,store,show,edit,update,destroy)を一括して登録する働きをする
Route::resource('rest', 'App\Http\Controllers\RestappController');


//settion
Route::get('session', [SessionController::class, 'index']);
Route::get('session/comfirm', [SessionController::class, 'ses_get']);
Route::post('session/comfirm', [SessionController::class, 'ses_put']);


//pagenation & Authを使用
//middleware('auth')を記載することによってログイン必須となる。ログインしていない場合、ログインページへリダイレクトされる
Route::get('pagination', [PaginationController::class, 'index'])->middleware('auth');//元から用意されているauthを使用
Route::get('pagination/auth', [App\Http\Controllers\PaginationController::class,'getAuth']);//オリジナルで作成したauth
Route::post('pagination/auth', [PaginationController::class, 'postAuth']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

