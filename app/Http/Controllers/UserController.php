<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //アカウント一覧画面
    public function index()
    {
        //$trip_contents = TripContents::orderBy('recruitment_end_date', 'asc')->get();
        $accounts =DB::table('users')->orderBy('id', 'desc')->paginate(10);
        
        return view('account.account_index',['accounts' => $accounts]);

    }

    //アカウント詳細画面
    public function detail($id)
    {

        $account = User::find($id);

        if(is_null($account)){

            return redirect()->route('account_index')->with('nodata','データがありません。');
        }

        return view('account.account_detail',['account' => $account]);

    }

    //アカウント登録画面
    public function create()
    {
        return view('account.account_form');
    }

    //アカウント登録
    public function store(AccountRequest $request)
    {
        //入力アカウントデータを受け取る
        $date       = now();
        $inputs = [
            'name'       => $request['name'],
            'email'      => $request['email'],
            'login_id'   => $request['login_id'],
            'password'   => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'created_by' => '1',
            'created_at' => $date,
        ];

        \DB::beginTransaction();
        try{
            //アカウントを登録
            User::create($inputs);
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }

        //User::create($inputs);

        return redirect()->route('account_index')->with('regist_success','アカウントを登録しました。');
    }

    //アカウント編集画面
    public function edit($id)
    {
        $account = User::find($id);

        if(is_null($account)){

            return redirect()->route('account_index')->with('nodata','データがありません。');
        }

        return view('account.account_edit',['account' => $account]);

    }

    //アカウント更新
    public function update(AccountRequest $request)
    {
        //入力アカウントデータを受け取る
        $date       = now();
        $inputs = $request->all();
        
        //$pas = Hash::make($inputs['password']);

        //dd($pas);
        \DB::beginTransaction();
        try{
            //アカウントを登録
            //$account = User::find($inputs['id']);
            //User::create($inputs);
            User::where('id','=',$inputs['id'])
            ->update([
                'name'       => $inputs['name'],
                'email'      => $inputs['email'],
                'login_id'   => $inputs['login_id'],
                'password'   => Hash::make($inputs['password']),
            ]);
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }

        //User::create($inputs);

        return redirect()->route('account_index')->with('regist_success','アカウントを更新しました');

    }

    public function delete($id)
    {
        $account = User::find($id);
        //dd($account);
        //入力アカウントデータを受け取る
        $delete_at       = now();
        //$inputs = $request->all();
        
        //dd($inputs);

        \DB::beginTransaction();
        try{
            //アカウントを登録
            //$account = User::find($inputs['id']);
            //User::create($inputs);
            User::where('id','=',$account['id'])
            ->update([
                'deleted_by'       => '1',
                'deleted_at'       => $delete_at,
            ]);
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }

        //User::create($inputs);

        return redirect()->route('account_index')->with('delete','アカウントを削除しました。');

    }
}
