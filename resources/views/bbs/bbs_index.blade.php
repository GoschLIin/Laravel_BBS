<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スレッド一覧</title>

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

    <h2>スレッド一覧</h2>
    <div style="text-align: right">{{ Auth::user()->name }}</div>

    <form action="{{ route('bbs_create') }}" method="GET">
            @csrf
                <button  type="botton" class="btn btn-success" > スレッド登録</button>
    </form>
  
        <!-- <ul>
            <li>名前：{{ Auth::user()->name }}</li>
            <li>ログインID：{{ Auth::user()->login_id }}</li>
        </ul> -->
        <li>ログインID：{{ Auth::user()->id }}</li>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="card-body">
            <table class="table table-sm">
                <tr>
                    <th>ID</th>
                    <th>タイトル</th>
                    <th>投稿者名</th>
                    <th>作成日</th>
                    <th></th> 
                </tr>
                @foreach($bbss as $bbs)
                @if(($bbs->accountboard->name)== Auth::user()->name)
                <tr>
                    <td>{{ $bbs->id }}</td>
                    <td><a href="/bbs/{{ $bbs->id }}">{{ $bbs->title }}</a></td>
                    <td>{{ $bbs->accountboard->name }}</td>
                    <td>{{ $bbs->created_at }}</td>
                    <td><button type="botton" class="btn btn-primary" onclick="location.href='/bbs/edit/{{ $bbs->id }}'">編集</button></td>
                </tr>
                @endif

                @if(($bbs->accountboard->name)!= Auth::user()->name)
                <tr>
                    <td>{{ $bbs->id }}</td>
                    <td><a href="/bbs/{{ $bbs->id }}">{{ $bbs->title }}</a></td>
                    <td>{{ $bbs->accountboard->name }}</td>
                    <td>{{ $bbs->created_at }}</td>
                </tr>
                @endif

                @endforeach
            </table>
            {{ $bbss->links() }}
        </div>
        <div class="mt-2">
        <a class="btn btn-secondary" style="display:inline" href="{{ route('bbs_top') }}">掲示板TOPに戻る</a>
        <form  style="display:inline" action="{{ route('logout') }}" method="POST">
            @csrf
                <button class="btn btn-danger_right" >ログアウト</button>
        </div>        
    </form>
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
