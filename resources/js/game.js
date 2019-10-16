let code = $("#game").data('code');
let lobby = null;
window.Echo.channel(`${code}.new-player`).listen('NewPlayer', (data) => {
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

axios.get('/api/game/'+code).then(res => {
  lobby = res.data.data;
  $('.player-count').text(`${lobby.players.length}/5`);
});
