/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/game.js":
/*!******************************!*\
  !*** ./resources/js/game.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

var code = $("#game").data('code');
var user = null;
var lobby = null;
var channel = window.Echo["private"]("game.".concat(code));
channel.listen('NewPlayer', function (data) {
  var player = data.player;
  lobby.players.push(player);
  $('.players-list').append("\n    <li>\n    <img src=\"".concat(player.avatar, "\" alt=\"\">\n    <p>").concat(player.name, "</p>\n    </li>\n    "));
  $('.player-count').text("".concat(lobby.players.length, "/5"));
});
channel.listen('NewRound', function (data) {
  lobby = data.lobby;
  updateGameStatus();
});
channel.listen('UpdateRound', function (data) {
  lobby = data.lobby;
  console.log(lobby);
  updateGameStatus();
});
axios.get('/api/user').then(function (res) {
  user = res.data;
  axios.get('/api/game/' + code).then(function (res) {
    lobby = res.data.data;
    console.log(lobby);
    updateGameStatus();
  });
});

window.updateGameStatus = function () {
  $('.player-count').text("".concat(lobby.players.length, "/5"));

  if (lobby.status == 0) {
    // GAME STATUS 0
    $('.game-main').html("\n      <div class=\"invite center\">\n      <p>Invite your friends</p>\n      <p class=\"code\">".concat(lobby.code, "</p>\n      <button class=\"btn\" onclick=\"startGame()\">Start Game</button>\n      </div>\n      "));
  } else {
    // GAME STATUS 1
    $('.game-main').html("\n      <div class=\"panel-title\">\n      <span class=\"game-time\"><i class=\"fa fa-clock-o\">&nbsp;".concat(lobby.current_round.timeleft, "</i></span>\n      <span class=\"game-round\">Round ").concat(lobby.status, "/").concat(lobby.max_rounds, "</i></span>\n      </div>\n      <div class=\"panel-body\">\n      <div id=\"sketch\">\n      <canvas id=\"paint\"></canvas>\n      </div>\n      </div>\n      ")); // ROUND STATUS 0

    if (lobby.current_round.status == 0) {
      if (lobby.current_round.drawer.id == user.id) {
        $('.game-main .panel-body').html("\n          <div class=\"center\" style=\"margin-top:50px\">\n            <p>Select a word</p>\n            <ul class=\"word-list\"></ul>\n          </div>\n          ");
        axios.get('/api/word/get').then(function (res) {
          var words = res.data;
          words.forEach(function (word) {
            var li = "<li onclick=\"selectWord(".concat(word.id, ")\">").concat(word.word, "</li>");
            $('.word-list').append(li);
          });
        });
      } else {
        $('.game-main .panel-body').html("\n          <div class=\"center\" style=\"margin-top:50px\">\n            <p class=\"code\"><span>".concat(lobby.current_round.drawer.name, "</span> is selecting a word...</p>\n          </div>\n          "));
      }
    } // startDrawing();

  }
};

window.startGame = function () {
  axios.post('/api/game/' + lobby.code + '/start');
};

window.selectWord = function (id) {
  axios.post('/api/round/word', {
    round: lobby.current_round.id,
    word: id
  });
};

window.startDrawing = function () {
  var canvas = document.querySelector('#paint');
  var ctx = canvas.getContext('2d');
  var sketch = document.querySelector('#sketch');
  var sketch_style = getComputedStyle(sketch);
  canvas.width = parseInt(sketch_style.getPropertyValue('width'));
  canvas.height = parseInt(sketch_style.getPropertyValue('height'));
  ctx.lineWidth = 5;
  ctx.lineJoin = 'round';
  ctx.lineCap = 'round';
  ctx.strokeStyle = 'blue';
  var drawing = false;
  canvas.addEventListener('mousemove', function (e) {
    var x = e.pageX - this.offsetLeft;
    var y = e.pageY - this.offsetTop;

    if (drawing) {
      channel.whisper('drawing.move', {
        x: x,
        y: y
      });
      paint(x, y);
    }
  }, false);
  canvas.addEventListener('mousedown', function (e) {
    var x = e.pageX - this.offsetLeft;
    var y = e.pageY - this.offsetTop;
    channel.whisper('drawing.start', {
      x: x,
      y: y
    });
    ctx.beginPath();
    ctx.moveTo(x, y);
    paint(x, y);
    drawing = true;
  }, false);
  canvas.addEventListener('mouseup', function () {
    drawing = false;
  }, false);

  var paint = function paint(x, y) {
    ctx.lineTo(x, y);
    ctx.stroke();
  };

  channel.listenForWhisper('drawing.start', function (data) {
    console.log(data);
    ctx.beginPath();
    ctx.moveTo(data.x, data.y);
    paint(data.x, data.y);
  });
  channel.listenForWhisper('drawing.move', function (data) {
    console.log(data);
    paint(data.x, data.y);
  });
};

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/game.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/bhaktijkoli/Documents/Web/scrawl/resources/js/game.js */"./resources/js/game.js");


/***/ })

/******/ });