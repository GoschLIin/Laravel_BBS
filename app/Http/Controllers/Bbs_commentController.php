<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bbs;
use App\Models\Accounts;
use App\Models\Bbs_comments;
use App\Http\Requests\Bbs_commentRequest;
use App\Models\Bbs_comment;
use Illuminate\Support\Facades\DB;

class Bbs_commentController extends Controller
{
    //BBS TOP comment 画面
    // public function top()
    // {   
        
    //     //$trip_contents = TripContents::orderBy('recruitment_end_date', 'asc')->get();
    //     //$bbss =DB::table('bbs')->orderBy('id', 'desc')->paginate(10);
    //     $bbs_comments =Bbs_comment::orderBy('id', 'desc')->paginate(5);
    //     // $bbs_comments =Bbs_comment::all();
    //     // dd($bbs_comments);
    //     return view('bbs.bbs_top',['bbs_comments' => $bbs_comments]);

    // }
}
