<div class="container">
    <x-alert type="success" :session="session('login_success')"/>
        <ul>
            <li>名前：{{ Auth::user()->name }}</li>
            <li>ログインID：{{ Auth::user()->login_id }}</li>
        </ul>
    <div class="row">
    <div class="card-header">プロフィール</div>
        <div class="col-md-8 col-md-offset-2">
            
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>名前：</th>
                    <th>ログインID：</th>
                    <th>created_by</th>
                </tr>
                @foreach($items as $key => $item)
                <tr>
                <br>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->login_id }}</td>
                    <td>{{ $item->created_by }}</td>
                
                </tr>
            
                @endforeach
            </table>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
                <button class="btn btn-danger">ログアウト</button>
        </form>
    </div>
</div>