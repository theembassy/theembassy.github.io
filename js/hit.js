//8 3_ What is JSON_ Part II - p5 js Tutorial

var data;

function preload() {
  data = loadJSON("data.json");
}

function setup() {
  noCanvas();

  var hitDB = data.hitDB;

  for (var i = 0; i < hitDB.length; i++) {
    createElement('h1', hitDB[i].id);
    var tracks = hitDB[i].tracks;
    for (var j = 0; j < tracks.length; j++) {
      createDiv(tracks[j]);
    }
  }
}

//document.getElementById("hits").innerHTML = hitAR.join("<br>") + "<hr>";
