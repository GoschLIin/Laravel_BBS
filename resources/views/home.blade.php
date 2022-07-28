@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mt-5">
            <x-alert type="success" :session="session('login_success')"/>
            <h3>プロフィール</h3>

            <div class="col-md-8 col-md-offset-1">
                <div class="card-body">
                    <ul>
                        <li>名前：{{ Auth::user()->name }}</li>
                        <li>ログインID：{{ Auth::user()->login_id }}</li>
                    </ul>

                    <div class="row">
    <div class="col align-self-start">
      新着スレッド<br>
      <table class="table table-striped">

        <tr>
        <th>ID</th>
        <th>作成日</th>
        <th>タイトル</th>
        <th>投稿者</th>
        </tr>
        </thead>

        <tbody>
        <?php if(!empty($result2)){
                foreach ($result2 as $row2) {?>
            <tr>
                <td>id</td>
                <td>created_at/td>
                <td>title</td>
                <td>name</td>
            </tr>
            <?php }}?>
        </tbody>
        <tfoot>
        </table>

      新着コメント<br>
        <table class="table table-striped">

        <tr>
        <th>投稿者</th>
        <th>コメント</th>
        <th>スレッドタイトル</th>
        <th>投稿日</th>
        </tr>
        </thead>
        

        <tbody>
        <?php if(!empty($result3)){
                foreach ($result3 as $row3) {?>
            <tr>
                <td>name</td>
                <td>comment</td>
                <td>title</td>
                <td>created_at/td>
            </tr>
            <?php }}?>

        </tbody>
        <tfoot>
        </table>
    </div>

        <div class="col align-self-center">
            <form action=threads.php method="get">
            <button type="submit" name="loginSend">もっと見る</button></form>
        </div>

  </div>
</div> 




                    <div class="mt-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                                <button class="btn btn-danger_right" >ログアウト</button>   
                        </form>
                    </div>
                </div>
            </div>         
        </div>
    </div>
@endsection


<div class="container">
<div class="row" style="text-align:right;">
    <form action=newthread.php method="post">
    <button type="submit" name="loginSend">スレッド登録</button></form>

    <form action=accounts_index_1.php method="post">
    <button type="submit" name="loginSend">アカウント一覧</button></form>

    <form action=logout.php method="post">
    <button type="submit" name="logout">Logout</button></form>
  </div>

  <div class="row">
    <div class="col align-self-start">
      新着スレッド<br>
      <table class="table table-striped">

        <tr>
        <th>ID</th>
        <th>作成日</th>
        <th>タイトル</th>
        <th>投稿者</th>
        </tr>
        </thead>

        <tbody>
        <?php if(!empty($result2)){
                foreach ($result2 as $row2) {?>
            <tr>
                <td>id</td>
                <td>created_at/td>
                <td>title</td>
                <td>name</td>
            </tr>
            <?php }}?>
        </tbody>
        <tfoot>
        </table>

      新着コメント<br>
        <table class="table table-striped">

        <tr>
        <th>投稿者</th>
        <th>コメント</th>
        <th>スレッドタイトル</th>
        <th>投稿日</th>
        </tr>
        </thead>
        

        <tbody>
        <?php if(!empty($result3)){
                foreach ($result3 as $row3) {?>
            <tr>
                <td>name</td>
                <td>comment</td>
                <td>title</td>
                <td>created_at/td>
            </tr>
            <?php }}?>

        </tbody>
        <tfoot>
        </table>
    </div>

        <div class="col align-self-center">
            <form action=threads.php method="get">
            <button type="submit" name="loginSend">もっと見る</button></form>
        </div>

  </div>
</div> 	
</body>