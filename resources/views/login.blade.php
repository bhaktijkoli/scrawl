@extends('layouts.master')
@section('pre')
  @php
  $title = "Login - Scrawl";
@endphp
@endsection
@section('content')
  <div class="row center-sm">
    <div class="col-sm-4">
      <div class="login-card">
        <form method="POST">
          @csrf
          <div class="form-group">
            <input name="nickname" type="text" class="input" placeholder="Enter your nickname"/>
          </div>
          @error('nickname')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          <div class="center">
            <button class="btn">Play <small>as</small> Guest</button>
          </div>
        </form>
        <div class="seprator">
          Or
        </div>
        <a href="#" class="fb social-btn">
          <i class="fa fa-facebook fa-fw"></i> Login with Facebook
        </a>
        <a href="#" class="twitter social-btn">
          <i class="fa fa-twitter fa-fw"></i> Login with Twitter
        </a>
        <a href="#" class="google social-btn">
          <i class="fa fa-google fa-fw"></i> Login with Google+
        </a>
      </div>
    </div>
  </div>
@endsection
@section('post')
@endsection
