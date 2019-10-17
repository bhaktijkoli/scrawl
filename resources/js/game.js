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

      </div>
      `)
    }
  }

  window.startGame = () => {
    axios.post('/api/game/'+lobby.code+'/start')
  }
