<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント一覧</title>

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

    <h2>アカウント一覧</h2>
    <div style="text-align: right">{{ Auth::user()->name }}</div>
    <form action="{{ route('account_create') }}" method="GET">
            @csrf
                <button  type="botton" class="btn btn-success" > アカウント登録</button>
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
                    <th>名前</th>
                    <th>ログインID</th> 
                    <th></th>
                    <th></th>
                    <th></th>       
                </tr>
                @foreach($accounts as $account)
                @if($account->deleted_at== NULL)
                <tr>
                    <td>{{ $account->id }}</td>
                    <td>{{ $account->name }}</td>
                    <td>{{ $account->login_id }}</td>
                    <td><button  type="botton" class="btn btn-primary" onclick="location.href='/account/{{ $account->id }}'">詳細</button></td>
                    <td><button type="botton" class="btn btn-primary" onclick="location.href='/account/edit/{{ $account->id }}'">編集</button></td>
                    <form method="POST" action="{{ route('account_delete', $account->id) }}" onSubmit="return checkDelete()">
                    @csrf
                    <td><button type="submit" class="btn btn-danger_right" onclick=>削除</button></td>
                    </form>
                </tr>
                @endif

                @if($account->deleted_at != NULL)
                <tr>
                    <td>{{ $account->id }}</td>
                    <td>{{ $account->name }}</td>
                    <td>{{ $account->login_id }}</td>
                    <td><button  type="botton" class="btn btn-primary" onclick="location.href='/account/{{ $account->id }}'">詳細</button></td>
                    <td></td>
                    <td></td>
                </tr>
                @endif
                @endforeach
            </table>
            {{ $accounts->links() }}
        </div>
        <div class="mt-2">
        <form action="{{ route('logout') }}" method="POST">
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
