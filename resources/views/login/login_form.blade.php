<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインフォーム</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
</head>
<body>

<form class="form-signin" method="POST" action="{{ route('login') }}">
    @csrf
    <h1 class="h3 mb-3 font-weight-normal">ログインフォーム</h1>
    
    @foreach ($errors->all() as $error)
    <ul class="alert alert-danger">    
        <li>{{ $error }}</li>
    </ul>
    @endforeach

    <x-alert type="danger" :session="session('login_error')"/>

    <x-alert type="danger" :session="session('logout')"/>

    <label for="login_id" class="sr-only">ログインID</label>
    <input type="text" id="login_id" name="login_id" class="form-control" placeholder="Login ID" >
    <label for="login_password" class="sr-only">Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Password" >
    <button class="btn btn-lg btn-primary btn-block" type="submit"> ログイン</button>
</form>

</body>
</html>