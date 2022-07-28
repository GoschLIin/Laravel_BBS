<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント詳細</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/singin.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <h3>アカウント詳細</h3>
            <div style="text-align: right">{{ Auth::user()->name }}</div>
            <div class="row">
                <div class="mt-6">
                    <h5>名前：{{ $account->name }}</h5>
                    <h5>ログインID：{{ $account->login_id }}</h5>
                    <h5>メールアドレス：{{ $account->email }}</h5>
                </div>

                @if($account->deleted_at== NULL)
                <div class="mt-7">
                    <td><button style="display:inline" type="botton" class="btn btn-primary" onclick="location.href='/account/edit/{{ $account->id }}'">編集</button></td>
                    <form style="display:inline" method="POST" action="{{ route('account_delete', $account->id) }}" onSubmit="return checkDelete()">
                    @csrf
                    <td><button type="submit" class="btn btn-danger_right" onclick=>削除</button></td>
                    </form>
                </div>
                @endif
                <div class="mt-3">
                        <a class="btn btn-secondary" href="{{ route('account_index') }}">アカウント一覧に戻る</a>
                </div>   
                <div class="mt-3">
                    <form action="{{ route('logout') }}" method="POST" >
                        @csrf
                        <button class="btn btn-danger_right" >ログアウト</button>
                    </form>    
                </div>  
            </div>
        </div>    
    </div>
</body>
</html>
