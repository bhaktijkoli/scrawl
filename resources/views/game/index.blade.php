@extends('layouts.master')
@section('pre')
  @php
  $title = "Scrawl";
@endphp
@endsection
@section('content')
  <div class="container-fluid">
    <div class="row" style="margin-top:130px;">
      <div class="col-sm-3">
        <div class="panel">
          <div class="panel-title">
            Players
          </div>
          <div class="panel-body">
            <ul class="players-list">
            @foreach (App\LobbyPlayer::where('lobby_id', $lobby->id)->get() as $player)
              <li>
                <img src="{{$player->user->avatar}}" alt="">
                <p>{{$player->user->name}}</p>
              </li>
            @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="panel">
          <div class="panel-title">
            Chat
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('post')
@endsection
