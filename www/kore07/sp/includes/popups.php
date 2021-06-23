<!-- MAP POPUP -->
<section class="map-popup hidden">
  <h2 class="visually-hidden">Map</h2>
  <iframe class="map-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2249.1125488779985!2d37.527429315579646!3d55.6870309805358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54cf65f5c8955%3A0x694710ccd55501e!2z0YPQuy4g0KHRgtGA0L7QuNGC0LXQu9C10LksIDE1LCDQnNC-0YHQutCy0LAsIDExOTMxMQ!5e0!3m2!1sru!2sru!4v1548171893150"
      width="560" height="222" allowfullscreen></iframe>
  <button class="close-button" type="button" aria-label="Close map"></button>
</section>


<!-- CONTUCT POPUP -->
<section class="contact-popup popup hidden">
  <h2 class="visually-hidden">Contact us</h2>
  <form class="popup-form" method="post" action="">
    <button class="close-button" type="button" aria-label="Close form"></button>

    <div class="popup-container">
      <p class="contact-popup-input popup-input">
        <label for="contact_name">Full name:</label>
        <input type="text" name="name" id="contact_name" placeholder="Full name" />
      </p>

      <p class="contact-popup-input popup-input">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="contact-email" placeholder="email@example.com" />
      </p>
    </div>

    <label for="text">Comment</label>
    <textarea name="text" id="text" placeholder="Write your comment"></textarea>

    <button class="button popup-button" type="submit">Send</button>
  </form>
</section>

