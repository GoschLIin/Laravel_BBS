<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板TOP</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/singin.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="mt-5">
    <x-alert type="success" :session="session('login_success')"/>

    <x-alert type="success" :session="session('regist_success')"/>

    <x-alert type="danger" :session="session('nodata')"/>

    <x-alert type="danger" :session="session('delete')"/>

    <h2>掲示板TOP</h2>
    <div style="text-align: right">{{ Auth::user()->name }}</div>

    <h3>新着スレッド</h3> 
    
    <form action="{{ route('bbs_create') }}" method="GET">
            @csrf
                <button  type="botton" class="btn btn-success" > スレッド登録</button>
    </form>
  
        <!-- <ul>
            <li>名前：{{ Auth::user()->name }}</li>
            <li>ログインID：{{ Auth::user()->login_id }}</li>
        </ul> -->
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>ID</th>
                        <th>タイトル</th>
                        <th>投稿者名</th>
                        <th>作成日</th>   
                    </tr>
                    @foreach($bbss as $bbs)
                    <tr>
                        <td>{{ $bbs->id }}</td>
                        <td><a href="/bbs/{{ $bbs->id }}">{{ $bbs->title }}</a></td>
                        <td>{{ $bbs->accountboard->name }}</td>
                        <td>{{ $bbs->created_at }}</td>
                    </tr>
                    @endforeach
                </table>
                {{ $bbss->links() }}
            </div>
        </div>
    </div>
    <!-- もっと見る -->
    <div>
    <form action="{{ route('bbs_index') }}" method="GET">
            @csrf
                <button  type="botton" class="btn btn-success" > もっと見る</button>
    </form>
    </div>
    <br>
    <h3>新着コメント</h3> 
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>投稿者</th>
                        <th>タイトル</th>
                        <th>コメント</th>
                        <th>作投稿日</th>   
                    </tr>
                    @foreach($bbs_comments as $bbs_comment)
                    <tr>
                        <td>{{ $bbs_comment->accountboard->name }}</td>
                        <td><a href="/bbs/{{ $bbs_comment->id }}">{{ $bbs_comment->bbsboard->title }}</a></td>
                        <td>{{ $bbs_comment->comment }}</td>
                        <td>{{ $bbs_comment->created_at }}</td>
                    </tr>
                    @endforeach
                </table>
                {{ $bbs_comments->links() }}
            </div>
        </div>
    </div>
    
    <div class="mt-2">
    <form action="{{ route('logout') }}" method="POST">
            @csrf
                <button class="btn btn-danger_right" >ログアウト</button>
        </div>        
    </form>
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
