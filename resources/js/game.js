let code = $("#game").data('code');
let lobby = null;
let channel = window.Echo.private(`game.${code}`)
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
  console.log(data);
  lobby = data.lobby;
  updateGameStatus();
});

axios.get('/api/game/'+code).then(res => {
  lobby = res.data.data;
  console.log(lobby);
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
    console.log(lobby.current_round.timeleft);
    $('.game-main').html(`
      <div class="panel-title">
      <span class="game-time"><i class="fa fa-clock-o">&nbsp;${lobby.current_round.timeleft}</i></span>
      <span class="game-round">Round ${lobby.status}/${lobby.max_rounds}</i></span>
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
  let canvas = document.querySelector('#paint');
  let ctx = canvas.getContext('2d');
  let sketch = document.querySelector('#sketch');
  let sketch_style = getComputedStyle(sketch);
  canvas.width = parseInt(sketch_style.getPropertyValue('width'));
  canvas.height = parseInt(sketch_style.getPropertyValue('height'));
  ctx.lineWidth = 5;
  ctx.lineJoin = 'round';
  ctx.lineCap = 'round';
  ctx.strokeStyle = 'blue';
  var drawing = false;

  canvas.addEventListener('mousemove', function(e) {
    let x = e.pageX - this.offsetLeft;
    let y = e.pageY - this.offsetTop;
    if(drawing) {
      channel.whisper('drawing.move', {x, y});
      paint(x, y)
    }
  }, false);

  canvas.addEventListener('mousedown', function(e) {
    let x = e.pageX - this.offsetLeft;
    let y = e.pageY - this.offsetTop;
    channel.whisper('drawing.start', {x, y});
    ctx.beginPath();
    ctx.moveTo(x, y);
    paint(x, y)
    drawing = true;
  }, false);

  canvas.addEventListener('mouseup', function() {
    drawing = false;
  }, false);

  let paint = (x, y) => {
    ctx.lineTo(x, y);
    ctx.stroke();
  }

  channel.listenForWhisper('drawing.start', (data) => {
    console.log(data);
    ctx.beginPath();
    ctx.moveTo(data.x, data.y);
    paint(data.x, data.y)
  })
  channel.listenForWhisper('drawing.move', (data) => {
    console.log(data);
    paint(data.x, data.y)
  })
}
