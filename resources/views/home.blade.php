@extends('layouts.master')
@section('pre')
  @php
  $title = "Scrawl";
@endphp
@endsection
@section('content')
  <img src="/img/art.svg" class="art"/>
  <div class="app-intro">
    <div class="container">
      <div class="row">
        <div class="col-6">
          <img src="/img/artboard_drawing.svg" class="artboard"/>
        </div>
        <div class="col-4 offset-2">
          <div class="app-intro-text">
            <h1 class="app-title">SCRAWL</h1>
            <p class="app-subtitle">Free Online Multiplayer Pictionary Game</p>
            <p class="app-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
    </div>
  </div>
  <div style="height:300px"></div>
@endsection
@section('post')
@endsection
