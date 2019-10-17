@extends('layouts.master')
@section('pre')
  @php
  $title = "Scrawl";
@endphp
@endsection
@section('content')
  <div id="game" class="container-fluid" data-code="{{$lobby->code}}">
    <div class="row" style="margin-top:50px;">
      <div class="col-sm-3">
        <div class="panel game-panel">
          <div class="panel-title">
            Players
            <span class="player-count">1/5</span>
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
        <div class="panel game-panel game-main">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="panel game-panel">
          <div class="panel-title">
            Chat
          </div>
          <div class="panel-body">
            <div class="chats">

            </div>
            <div class="chat-input">
              <input class="input"/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('post')
  <script type="text/javascript" src="/js/game.js"></script>
@endsection
