@extends('layouts.master')
@section('pre')
  @php
  $title = "Scrawl | Find Lobby";
@endphp
@endsection
@section('content')
  <div class="container">
    <div class="row" style="margin-top:130px;">
      <div class="col-sm-8">
        {{-- <div class="panel">
          <div class="panel-title">
            Public Lobbies
          </div>
        </div> --}}
        <div class="panel">
          <div class="panel-title">
            Private Lobby
          </div>
          <div class="panel-body">
            <form action="{{route('lobby')}}" method="post">
              @csrf
              <input type="text" name="code" class="input" placeholder="Enter private lobby key here">
              <button type="submit" name="private_lobby" class="btn">Join Lobby</button>
              <a href="{{route('lobby.new')}}" class="btn btn-green"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Create Lobby</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('post')
@endsection
