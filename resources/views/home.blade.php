@extends('layouts.master')
@section('pre')
  @php
  $title = "Scrawl";
@endphp
@endsection
@section('content')
  <div class="app-intro">
    <div class="container">
    <div class="row">
        <div class="col-sm-6">
          <img src="/img/artboard_drawing.svg" class="artboard"/>
        </div>
        <div class="col-sm-4 col-sm-offset-2">
          <div class="app-intro-text">
            <h1 class="app-title">SCRAWL</h1>
            <p class="app-subtitle">Free Online Multiplayer Word-guessing Game</p>
            <a class="btn-intro" href="{{route('login')}}">Play Now</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div style="height:300px"></div>
@endsection
@section('post')
@endsection
