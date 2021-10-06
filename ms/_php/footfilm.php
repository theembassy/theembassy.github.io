<!--/ MENU -->

<ul class="represent">
  <!--/<li><h1>CONTACT</h1></li>-->
  <li><a href="tel:+46739380209">+46739380209</a></li>
  <li>info@marcussoderlund.se</li>
  <br>
  <li>UK <a href="https://www.academyfilms.com/marcus-soderlund" target="_blank" class="textlink">Academy Films</a></li>
  <li>US <a href="http://www.resetcontent.com/marcus-soderlund" target="_blank" class="textlink">Reset Content</a></li>
  <li>SWEDEN <a href="https://brf.co/director/marcus-soderlund/region/scandinavia/" target="_blank" class="textlink">BR•F</a></li>
  <br>
  <li>GERMANY <a href="https://www.iconoclast.tv/de/marcus-soederlund" target="_blank" class="textlink">Iconoclast</a></li>
  <li>FRANCE <a href="https://www.wanda.net/fr/director/marcus-soderlund/" target="_blank" class="textlink">Wanda</a></li>
  <br>
  <li>WORLD <a href="https://agentzoo.tv/directors/marcus-soderlund/" target="_blank" class="textlink">Agent Zoo</a></li>
</ul>

<!--/.container-->
</div>
<!--/.wrapper-->
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
var i;
var slides = document.getElementsByClassName("msSlide");
var dots = 12;
for (i = 0; i < slides.length; i++) {
  slides[i].style.display = "none";
}
slideIndex++;
if (slideIndex > slides.length) {
  slideIndex = 1
}
for (i = 0; i < dots.length; i++) {
  dots[i].className = dots[i].className.replace(" active", "");
}
slides[slideIndex - 1].style.display = "block";

setTimeout(showSlides, 1700); // Change image
}
</script>


</body>

</html>
