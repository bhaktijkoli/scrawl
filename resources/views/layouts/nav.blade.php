@if (Auth::user())
  <div class="appbar" id="myTopnav">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <a>
            <img src="/img/artboard_drawing.svg" width="64" style="margin: -10px 0px;"/>
          </a>
          <a class="menu-item" href="{{route('lobby')}}" class="active">Lobby</a>
          <div class="dropdown pull-right">
            <button class="dropbtn">{{Auth::user()->name}}
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
              <a href="{{route('logout')}}">Logout</a>
            </div>
          </div>
          <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
      </div>
    </div>
  </div>
@endif
