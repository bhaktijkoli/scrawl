@extends('layouts.master')
@section('pre')
  @php
  $title = "Login - Scrawl";
@endphp
@endsection
@section('content')
  <div class="row">
    <div class="container">
      <div class="col-5 offset-3">
        <div class="login-card">
          <div class="form-group">
            <input type="text" class="input" placeholder="Enter your nickname"/>
          </div>
          <div class="center">
            <button class="btn">Play <small>as</small> Guest</button>
          </div>
          <div class="seprator">
            Or
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('post')
@endsection
