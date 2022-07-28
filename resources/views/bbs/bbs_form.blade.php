<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スレッド登録</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/singin.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <h3>スレッド登録</h3>
            <div style="text-align: right">{{ Auth::user()->name }}</div>
            <div class="row">
                @foreach ($errors->all() as $error)
                <ul class="alert alert-danger">    
                    <li>{{ $error }}</li>
                </ul>
                @endforeach
                <form method="POST" action="{{ route('bbs_store') }}" onSubmit="return checkSubmit()" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label for="title">タイトル</label>
                        <input id="title" name="title" class="form-control" value="{{ old('title') }}" type="text">

                    </div>

                    <div class="form-group">
                        <label for="content">本文</label>
                        <input id="contents" name="contents" row="4" class="form-control" value="{{ old('contents') }}" type="text">
                    </div>

                    <br>
                    <div class="form-group">
                        <label for="image">画像</label>
                        <input id="image" name="image" class="form-control-file" value="" type="file" placeholder="画像ファイル添付">

                    </div>

                    <div class="mt-3">
                        <a class="btn btn-secondary" href="{{ route('bbs_index') }}">キャンセル</a>
                        <button type="submit" class="btn btn-primary">登録する</button>
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
            if(window.confirm('登録してよろしですか？')){
                return true;
            }else
                return false;
        }
    </script>
</body>
</html>
