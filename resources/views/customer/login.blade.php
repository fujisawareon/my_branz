@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>顧客ログイン</h1>
        <form method="POST" action="{{ route('customer.login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">ログイン状態を保持する</label>
            </div>
            <button type="submit" class="btn btn-primary">ログイン</button>
        </form>
    </div>
@endsection
