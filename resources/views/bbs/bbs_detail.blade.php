<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スレッド詳細</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/singin.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <x-alert type="danger" :session="session('delete')"/>

            @foreach ($errors->all() as $error)
                <ul class="alert alert-danger">    
                    <li>{{ $error }}</li>
                </ul>
                @endforeach

            <h3>スレッド詳細</h3>
            <div style="text-align: right">{{ Auth::user()->name }}</div>
            <div class="row">
                <h3>スレッド基本情報</h3>
                    <div class="mt-6">
                        <h5>タイトル：{{ $bbs->title }}</h5>
                        <h5>本文：{{ $bbs->contents }}</h5>
                        <h5>作成日：{{ $bbs->created_at }}</h5>
                        <h5>投稿者：{{ $bbs->accountboard->name }}</h5>
                        <img src="{{ asset('storage/'.$bbs->image) }}" width="500" height="400">
                    </div>

                    @if(($bbs->accountboard->name)== Auth::user()->name)
                    <div class="mt-7">
                        <td><button style="display:inline" type="botton" class="btn btn-primary" onclick="location.href='/bbs/edit/{{ $bbs->id }}'">編集</button></td>
                    
                    @if($bbs->deleted_at== NULL)
                    
                    <form style="display:inline" method="POST" action="{{ route('bbs_delete', $bbs->id) }}" onSubmit="return checkDelete()">
                    @csrf
                        <td><button type="submit" class="btn btn-danger_right" onclick=>削除</button></td>
                        </form>
                    </div>
                    @endif
                    @endif
                    <br>
                    <br>
                    <h3>コメント</h3> 
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1">
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <th>投稿者</th>
                                            <th>コメント</th>
                                            <th>作投稿日</th>   
                                        </tr>
                                        @foreach($bbs_comments as $bbs_comment)
                                            @if(($bbs->id) == ($bbs_comment->bbs_id))
                                                @if((($bbs_comment->accountboard->name)== Auth::user()->name)&&($bbs_comment->deleted_at == NULL))
                                                <tr>
                                                    <td>{{ $bbs_comment->accountboard->name }}</td>
                                                    <td>{{ $bbs_comment->comment }}</td>
                                                    <td>{{ $bbs_comment->created_at }}</td>
                                                    <form method="POST" action="{{ route('bbs_delete_comment', $bbs_comment->id )}}" onSubmit="return checkDelete()">
                                                        @csrf
                                                        
                                                        <td><button type="submit" class="btn btn-danger_right" onclick=>削除</button></td>
                                                    </form>
                                                </tr>
                                                @endif
                                                @if(($bbs_comment->accountboard->name)!= (Auth::user()->name))
                                                <tr>
                                                    <td>{{ $bbs_comment->accountboard->name }}</td>
                                                    <td>{{ $bbs_comment->comment }}</td>
                                                    <td>{{ $bbs_comment->created_at }}</td>
                                                </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    </table>
                                    {{ $bbs_comments->links() }}
                                </div>
                            </div>
                        </div>

                        <h3>コメント投稿</h3>
                        <form method="POST" action="{{ route('bbs_comment_store') }}" >
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="bbs_id" value="{{ $bbs->id }}">

                            <div class="form-group">
                                <label for="comment">本文</label>
                                <input id="comment" name="comment" row="4" class="form-control" value="{{ old('comment') }}" type="text">
                            </div>

                            <br>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">登録する</button>
                            </div>   
                        </form>  




                    <div class="mt-3">
                            <a class="btn btn-secondary" style="display:inline" href="{{ route('bbs_index') }}">スレッド一覧に戻る</a>
                    
                    <form style="display:inline" action="{{ route('logout') }}" method="POST" >
                        @csrf
                        <button class="btn btn-danger_right" >ログアウト</button>
                    </form>    
                </div>  
            </div>
        </div>    
    </div>
    <script>
    function checkDelete(){
        if(window.confirm('削除してよろしですか？')){
            return true;
        }else
            return false;
    }
</script>
</body>
</html>
