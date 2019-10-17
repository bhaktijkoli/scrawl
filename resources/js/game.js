let code = $("#game").data('code');
let lobby = null;
let channel = window.Echo.channel(`game.${code}`)
channel.listen('NewPlayer', (data) => {
  let player = data.player;
  lobby.players.push(player);
  $('.players-list').append(
    `
    <li>
    <img src="${player.avatar}" alt="">
    <p>${player.name}</p>
    </li>
    `
  );
  $('.player-count').text(`${lobby.players.length}/5`);
});

channel.listen('NewRound', (data) => {
  lobby.status = data.round;
  updateGameStatus();
});

axios.get('/api/game/'+code).then(res => {
  lobby = res.data.data;
  updateGameStatus();
});

window.updateGameStatus = () => {
  $('.player-count').text(`${lobby.players.length}/5`);
  if(lobby.status == 0) {
    $('.game-main').html(
      `
      <div class="invite center">
      <p>Invite your friends</p>
      <p class="code">${lobby.code}</p>
      <button class="btn" onclick="startGame()">Start Game</button>
      </div>
      `
    )
  } else {
    $('.game-main').html(`
      <div class="panel-title">
      <span class="game-time"><i class="fa fa-clock-o">&nbsp;${lobby.time}</i></span>
      <span class="game-round">Round ${lobby.status}/3</i></span>
      </div>
      <div class="panel-body game-main">
      <div id="sketch">
      <canvas id="paint"></canvas>
      </div>
      </div>
      `
    )
    startDrawing();
  }
}

window.startGame = () => {
  axios.post('/api/game/'+lobby.code+'/start')
}

window.startDrawing = () => {
  var canvas = document.querySelector('#paint');
  var ctx = canvas.getContext('2d');

  var sketch = document.querySelector('#sketch');
  var sketch_style = getComputedStyle(sketch);
  canvas.width = parseInt(sketch_style.getPropertyValue('width'));
  canvas.height = parseInt(sketch_style.getPropertyValue('height'));
  var mouse = {x: 0, y: 0};

  canvas.addEventListener('mousemove', function(e) {
    mouse.x = e.pageX - this.offsetLeft;
    mouse.y = e.pageY - this.offsetTop;
  }, false);

  ctx.lineWidth = 5;
  ctx.lineJoin = 'round';
  ctx.lineCap = 'round';
  ctx.strokeStyle = 'blue';

  canvas.addEventListener('mousedown', function(e) {
    ctx.beginPath();
    ctx.moveTo(mouse.x, mouse.y);

    canvas.addEventListener('mousemove', onPaint, false);
  }, false);

  canvas.addEventListener('mouseup', function() {
    canvas.removeEventListener('mousemove', onPaint, false);
  }, false);

  var onPaint = function() {
    ctx.lineTo(mouse.x, mouse.y);
    ctx.stroke();
  };
}
