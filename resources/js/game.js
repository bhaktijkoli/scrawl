let code = $("#game").data('code');
let user = null;
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
  lobby = data.lobby;
  updateGameStatus();
});
channel.listen('UpdateRound', (data) => {
  lobby = data.lobby;
  console.log(lobby);
  updateGameStatus();
});
channel.listen('EndRound', (data) => {
  alert("ROUND END");
});

axios.get('/api/user').then(res => {
  user = res.data;
  axios.get('/api/game/'+code).then(res => {
    lobby = res.data.data;
    updateGameStatus();
  });
})



window.updateGameStatus = () => {
  $('.player-count').text(`${lobby.players.length}/5`);
  if(lobby.status == 0) {
    // GAME STATUS 0
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
    // GAME STATUS 1
    $('.game-main').html(`
      <div class="panel-title">
      <span class="game-time"><i class="fa fa-clock-o">&nbsp;${lobby.current_round.timeleft}</i></span>
      <span class="game-round">Round ${lobby.status}/${lobby.max_rounds}</i></span>
      </div>
      <div class="panel-body">
      <div id="sketch">
      <canvas id="paint"></canvas>
      </div>
      </div>
      `
    )

    // ROUND STATUS 0
    if(lobby.current_round.status == 0)
    {
      if(lobby.current_round.drawer.id == user.id)
      {
        $('.game-main .panel-body').html(
          `
          <div class="center" style="margin-top:50px">
          <p>Select a word</p>
          <ul class="word-list"></ul>
          </div>
          `
        )
        axios.get('/api/word/get').then(res => {
          let words = res.data;
          words.forEach(word => {
            let li = `<li onclick="selectWord(${word.id})">${word.word}</li>`
            $('.word-list').append(li);
          })
        })
      } else {
        $('.game-main .panel-body').html(
          `
          <div class="center" style="margin-top:50px">
          <p class="code"><span>${lobby.current_round.drawer.name}</span> is selecting a word...</p>
          </div>
          `
        )
      }
    }
    // ROUND STATUS 1
    else if(lobby.current_round.status == 1) {
      startTimer();
      startDrawing();
    }
  }
}

window.startGame = () => {
  axios.post('/api/game/'+lobby.code+'/start')
}

window.selectWord = (id) => {
  axios.post('/api/round/word', {round: lobby.current_round.id, word: id});
  $('.game-main .panel-body').html(`<div class="center" style="margin-top:50px"><p>Get ready to draw!</p></div>`)
}

window.startTimer = () => {
  if(lobby.current_round.timeleft <= 0) return;
  setTimeout(function () {
    lobby.current_round.timeleft -= 1;
    $('.game-time').html(`<i class="fa fa-clock-o">&nbsp;${lobby.current_round.timeleft}</i>`);
    startTimer();
  }, 1000);
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

  // ONLY DRAWER CAN DRAW
  if(lobby.current_round.drawer.id == user.id) {
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
  } else {
    // OTHER PLAYERS LISTEN
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

  let paint = (x, y) => {
    ctx.lineTo(x, y);
    ctx.stroke();
  }
}
