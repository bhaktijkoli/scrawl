let code = $("#game").data('code');
window.Echo.channel(`${code}.new-player`).listen('NewPlayer', (data) => {
  let player = data.player;
  $('.players-list').append(`
    <li>
      <img src="${player.avatar}" alt="">
      <p>${player.name}</p>
    </li>
    `)
});
