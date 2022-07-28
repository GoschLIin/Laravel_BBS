<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント編集</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/singin.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <h3>アカウント編集</h3>
            <div style="text-align: right">{{ Auth::user()->name }}</div>
            <div class="row">
                @foreach ($errors->all() as $error)
                <ul class="alert alert-danger">    
                    <li>{{ $error }}</li>
                </ul>
                @endforeach
                <form method="POST" action="{{ route('account_upadte') }}" onSubmit="return checkSubmit()">
                    @csrf
                    <input type="hidden" name="id" value="{{ $account->id }}">
                    <div class="form-group">
                        <label for="name">アカウント名</label>
                        <input id="name" name="name" class="form-control" value="{{ $account->name }}" type="text">
                    </div>

                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input id="email" name="email" class="form-control" value="{{ $account->email }}" type="email">
                    </div>  

                    <div class="form-group">
                        <label for="login_id">アカウントID</label>
                        <input id="login_id" name="login_id" class="form-control" value="{{ $account->login_id }}" type="text">
                    </div>

                    <div class="form-group">
                        <label for="password">アカウントパスワード</label>
                        <input id="password" name="password" class="form-control" value="{{ $account->password }}" type="text">
                    </div>

                    <div class="mt-3">
                        <a class="btn btn-secondary" href="{{ route('account_index') }}">キャンセル</a>
                        <button type="submit" class="btn btn-primary">更新する</button>
                    </div>   
                </form>  
            </div>
        </div>
        <div class="mt-5">
        <form action="{{ route('logout') }}" method="POST" >
                @csrf
                    <button class="btn btn-danger_right" >ログアウト</button>
        </form>    
        </div>  
    </div>
    <script>
        function checkSubmit(){
            if(window.confirm('更新してよろしですか？')){
                return true;
            }else
                return false;
        }
    </script>
</body>
</html>
