const hitAR = {
  id: "hit11",
  url: "https://www.youtube.com/embed/videoseries?list=PLeX6pl7_1oKwbNigcuvzRJsxp0pKFO0B2&amp;showinfo=0",
  tracks: ["Pure Essence - Wake Up",
    "P!OFF? - In Der Nacht"]
  };

//'<div class="image-zoom-container-max"><div class="zoom-container-max"><img src="img/hit11.jpg" /></div></div>',
//'<iframe width="300" height="47" src="https://www.youtube.com/embed/videoseries?list=PLeX6pl7_1oKwbNigcuvzRJsxp0pKFO0B2&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>',


document.getElementById("hits").innerHTML = hitAR.join("<br>") + "<hr>";

//hitAR.join("<br>") + "<hr>";

//for (let i = 0; i < hit11AR.length; i++) { hit11AR[i];
//for (const hits of hit11AR) {
//  document.getElementById("hit11").innerHTML = hits;
//  }
