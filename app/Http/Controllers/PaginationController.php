<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class PaginationController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        //siplePagenate(表示数)
        $sort = isset($request->sort) ? $request->sort : 'name';
        //$items=DB::table('people')->orderBy($sort,'asc')->simplePaginate(2);
        //$items = Person::orderBy($sort, 'asc')->simplePaginate(2);
        $items = Person::orderBy($sort, 'asc')->paginate(1);
        $param = ['items' => $items, 'sort' => $sort, 'user' => $user];
        return view('pagination.index', $param);
    }

    public function getAuth(Request $request)
    {
        $param = ['message' => 'ログインして下さい。'];
        return view('pagination.auth', $param);
    }

    public function postAuth(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        //引数をもとにログイン処理を行う
        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            $msg = 'ログインしました。（' . Auth::user()->name . '）';
        } else {
            $msg = 'ログインに失敗しました。';
        }
        return view('pagination.auth', ['message' => $msg]);
    }
}
