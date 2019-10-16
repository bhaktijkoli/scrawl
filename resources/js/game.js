let code = $("#game").data('code');
let lobby = null;
window.Echo.channel(`${code}.new-player`).listen('NewPlayer', (data) => {
  let player = data.player;
  $('.players-list').append(`
    <li>
      <img src="${player.avatar}" alt="">
      <p>${player.name}</p>
    </li>
    `)
});

axios.get('/api/game/'+code).then(res => {
  lobby = res.data.data;
  console.log(lobby);
})
