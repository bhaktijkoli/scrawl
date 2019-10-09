@extends('layouts.master')
@section('pre')
  @php
  $title = "Scrawl | New Private Lobby";
@endphp
@endsection
@section('content')
  <div class="container">
    <div class="row" style="margin-top:130px;">
      <div class="col-sm-8">
        <div class="panel">
          <div class="panel-title">
            Create New Private Lobby
          </div>
          <div class="panel-body">
            <form action="{{route('lobby.new.post')}}" method="post">
              @csrf
              <div class="form-control">
                <label>Rounds</label>
                <select class="input" name="rounds">
                  @for ($i=1; $i <= 10; $i++)
                    <option value="{{$i}}" {{$i==3?'selected':''}}>{{$i}}</option>
                  @endfor
                </select>
              </div>
              <div class="form-control">
                <label>Draw time in seconds</label>
                <select class="input" name="time">
                  @for ($i=3; $i <= 18; $i++)
                    <option value="{{$i*10}}" {{$i==8?'selected':''}}>{{$i*10}}</option>
                  @endfor
                </select>
              </div>
              <button type="submit" class="btn"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Create Lobby</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('post')
@endsection
