<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bbs;
use App\Models\Accounts;
use App\Models\Bbs_comment;
use App\Http\Requests\BbsRequest;
use Illuminate\Support\Facades\DB;

class BbsController extends Controller
{
//BBS TOP 画面
public function top()
{   
    
    //$trip_contents = TripContents::orderBy('recruitment_end_date', 'asc')->get();
    //$bbss =DB::table('bbs')->orderBy('id', 'desc')->paginate(10);
    $bbss =Bbs::orderBy('id', 'desc')->paginate(5);
    $bbs_comments =Bbs_comment::orderBy('id', 'desc')->paginate();

    //$bbss =Bbs::all();
    //dd($bbss);
    return view('bbs.bbs_top',['bbss' => $bbss],['bbs_comments' => $bbs_comments]);

}
//BBS一覧画面
public function index()
{
    //$trip_contents = TripContents::orderBy('recruitment_end_date', 'asc')->get();
    $bbss =Bbs::orderBy('id', 'desc')->paginate(10);
    
    // $bbss =Bbs::all();
     return view('bbs.bbs_index',['bbss' => $bbss]);

}

//BBS詳細画面
public function detail($id)
{

    $bbs = Bbs::find($id);

    $bbs_comments =Bbs_comment::orderBy('id', 'desc')->paginate(6);

    //$bbss =Bbs::all();

    if(is_null($bbs)){

        return redirect()->route('bbs_index')->with('nodata','データがありません。');
    }

    return view('bbs.bbs_detail',['bbs' => $bbs],['bbs_comments' => $bbs_comments]);

}

//アカウント登録画面
public function create()
{
    return view('bbs.bbs_form');
}

//BBS登録
public function store(BbsRequest $request)
{
    //dd($request->all());
    //入力アカウントデータを受け取る
    $date       = now();


    //$uploaded_image = $request->file('image');
    // if($request->hasFile('profile_image')&& $uploaded_image->isValid()){
         $file_name = $request->file('image')->getClientOriginalName();

         //dd($file_name);
         $img = $request->file('image')->storeAs('',$file_name,'public');
        // $path = $request->file('image')->storeAs('images',$file_name);
        // $path = $request->file('image')->store('images');
        // $file = storage_path('public/') . $path;
        
        

        
    // }
// dd($file);

    $inputs = [
        'title'       => $request['title'],
        'contents'      => $request['contents'],
        'image'   => $img,
        'created_by' => $request['id'],
        'created_at' => $date,
    ];

    \DB::beginTransaction();
    try{
        //アカウントを登録
        Bbs::create($inputs);
        \DB::commit();
    } catch(\Throwable $e){
        \DB::rollback();
        abort(500);
    }

    //User::create($inputs);

    return redirect()->route('bbs_index')->with('regist_success','スレッドを登録しました。');
}

//bbs編集画面
public function edit($id)
{
    $bbs = Bbs::find($id);

    if(is_null($bbs)){

        return redirect()->route('bbs_index')->with('nodata','データがありません。');
    }

    return view('bbs.bbs_edit',['bbs' => $bbs]);

}

//BBS更新
public function update(BbsRequest $request)
{

    $inputs = $request->all();
    
     //dd($request->all());
    //dd($request['bbs_id']);
    $file_name = $request->file('image')->getClientOriginalName();
    
    $img = $request->file('image')->storeAs('',$file_name,'public');
    //入力アカウントデータを受け取る
    //$date       = now();
    
    //dd($img);

    $inputs = [
        'title'       => $request['title'],
        'contents'    => $request['contents'],
        'id'    => $request['bbs_id'],
        'updated_by'    => $request['id'],
    ];

    \DB::beginTransaction();
    try{
        //アカウントを登録
        //$account = User::find($inputs['id']);
        //User::create($inputs);
        Bbs::where('id','=',$inputs['id'])
        ->update([
            'title'     => $inputs['title'],
            'contents'  => $inputs['contents'],
            'updated_by'=> $inputs['updated_by'],
            'image'     => $img,
        ]);
        \DB::commit();
    } catch(\Throwable $e){
        \DB::rollback();
        abort(500);
    }

    //User::create($inputs);

    return redirect()->route('bbs_index')->with('regist_success','スレッドを更新しました。');

}

public function delete($id)
{
    $bbs = Bbs::find($id);
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
        Bbs::where('id','=',$bbs['id'])
        ->update([
            'deleted_at'       => $delete_at,
        ]);
        \DB::commit();
    } catch(\Throwable $e){
        \DB::rollback();
        abort(500);
    }

    //User::create($inputs);

    return redirect()->route('bbs_index')->with('delete','スレッドを削除しました。');

}

    public function delete_comment(Request $request,$id)
    {
        $bbs_comments = Bbs_comment::find($id);
        //dd($request['id']);
        $bbs_id = $request['id'];
        //入力アカウントデータを受け取る
        $delete_at       = now();
        //$inputs = $request->all();
        
        //dd($inputs);

        \DB::beginTransaction();
        try{
            //アカウントを登録
            //$account = User::find($inputs['id']);
            //User::create($inputs);
            Bbs_comment::where('id','=',$bbs_comments['id'])
            ->update([
                'deleted_at'       => $delete_at,
            ]);
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }

        //User::create($inputs);

        return redirect()->back()->with('delete','コメントを削除しました。');

    }

    //コメント登録
    public function comment_store(BbsRequest $request)
    {
        //dd($request->all());
        //dd($request);
        $id = $request['id'];
        
        //入力アカウントデータを受け取る
        $date       = now();
        $inputs = [
            'bbs_id'       => $request['bbs_id'],
            'comment'       => $request['comment'],
            'created_by' => $id,
            'created_at' => $date,
        ];

        \DB::beginTransaction();
        try{
            //アカウントを登録
            Bbs_comment::create($inputs);
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }

        //User::create($inputs);

        return redirect()->back()->with('regist_success','コメントを登録しました。');
    }

}
