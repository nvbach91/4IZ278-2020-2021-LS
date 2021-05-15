<?php require __DIR__ . '/includes/header.php' ?>


  <main class="main main--main">
    <div class="main-container">
      <h1 class="visually-hidden">Main page</h1>
      <div class="slider-wrapper">
        <section class="slider">
          <h2 class="visually-hidden">Slaider</h2>
          <input class="visually-hidden" type="radio" id="product-1" name="toggle" checked>
          <input class="visually-hidden" type="radio" id="product-2" name="toggle">
          <input class="visually-hidden" type="radio" id="product-3" name="toggle">
          <div class="slider-controls">
            <label class="slider-controls-item slider-controls-item--1" for="product-1" tabindex="0">First</label>
            <label class="slider-controls-item slider-controls-item--2" for="product-2" tabindex="0">Second</label>
            <label class="slider-controls-item slider-controls-item--3" for="product-3" tabindex="0">Third</label>
          </div>
          <ul class="slider-list">
            <li class="slider-item slide1" id="slide1">
              <div class="slider-img-wrapper">
                <img class="slider-img" src="img/slider-1.png" width="384" height="486" alt="Monopod for selfie" />
              </div>
              <div class="slider-description">
                <h2>Take a selfie<br />like Ben Stiller!</h2>
                <p>
                  The longest selfie stick available in our store.<br />
                  Eight (Eight, Karl!) Meters long and weighing only 5 kilograms.
                </p>
                <a class="button slider-button" href="#">More</a>
                <dl class="terms-list">
                  <div class="term-item">
                    <dt class="term">8,5 m</dt>
                    <dd class="term-description">Length</dd>
                  </div>
                  <div class="term-item">
                    <dt class="term">5 kg</dt>
                    <dd class="term-description">Weight</dd>
                  </div>
                  <div class="term-item">
                    <dt class="term">Carbon</dt>
                    <dd class="term-description">Material</dd>
                  </div>
                </dl>
              </div>
            </li>
            <li class="slider-item slide2" id="slide2">
              <div class="slider-img-wrapper">
                <img class="slider-img" src="img/slider-2.png" width="345" height="485" alt="Fitness tracker" />
              </div>
              <div class="slider-description">
                <h2>Lose weight<br />correctly!</h2>
                <p>
                  Motivating fitness bracelets help you find your strength
                  do not miss classes and follow a diet.
                </p>
                <a class="button slider-button" href="#">More</a>
                <dl class="terms-list">
                  <div class="term-item">
                    <dt class="term">48 hours</dt>
                    <dd class="term-description">Without recharging</dd>
                  </div>
                </dl>
              </div>
            </li>
            <li class="slider-item slide3" id="slide3">
              <div class="slider-img-wrapper">
                <img class="slider-img" src="img/slider-3.png" width="526" height="334" alt="Drone" />
              </div>
              <div class="slider-description">
                <h2>Flutters like a butterfly<br />stings like a bee!</h2>
                <p>
                  This seemingly ordinary quadcopter is equipped with
                  a powerful laser disguised as a standard camera.
                </p>
                <a class="button slider-button" href="#">More</a>
                <dl class="terms-list">
                  <div class="term-item">
                    <dt class="term">800 m</dt>
                    <dd class="term-description">Range of flight</dd>
                  </div>
                  <div class="term-item">
                    <dt class="term">50 m</dt>
                    <dd class="term-description">Damage radius</dd>
                  </div>
                </dl>
              </div>
            </li>
          </ul>
        </section>
      </div>
      <section class="popular">
        <h2 class="visually-hidden">Popular goods</h2>
        <ul class="popular-list">
          <li class="popular-item">
            <a class="popular-link" href="#">
              <img class="popular-icon" src="img/popular-1.svg" width="97" height="55" alt="Virtual reality">
              <span>Virtual reality</span>
            </a>
          </li>
          <li class="popular-item">
            <a class="popular-link" href="#">
              <img class="popular-icon" src="img/popular-2.svg" width="86" height="117" alt="Monopods for selfie">
              <span>Monopods for selfie</span>
            </a>
          </li>
          <li class="popular-item">
            <a class="popular-link" href="#">
              <img class="popular-icon" src="img/popular-3.svg" width="71" height="87" alt="Action cameras">
              <span>Action cameras</span>
            </a>
          </li>
          <li class="popular-item">
            <a class="popular-link" href="#">
              <img class="popular-icon" src="img/popular-4.svg" width="107" height="65" alt="Fitness trackers">
              <span>Fitness trackers</span>
            </a>
          </li>
          <li class="popular-item">
            <a class="popular-link" href="#">
              <img class="popular-icon" src="img/popular-5.svg" width="56" height="98" alt="Smartwatch">
              <span>Smartwatch</span>
            </a>
          </li>
          <li class="popular-item">
            <a class="popular-link" href="#">
              <img class="popular-icon" src="img/popular-6.svg" width="132" height="69" alt="Drones">
              <span>Drones</span>
            </a>
          </li>
        </ul>
      </section>
    </div>
    <div class="services-wrapper">
      <div class="main-container">
          <h2 class="visually-hidden">Service</h2>
            <ul class="service-list">
              <li class="service-item current-service-item"><a href="#" class="button service-item-link" id="delivery">Shipping</a></li>
              <li class="service-item"><a href="#" class="button service-item-link" id="warranty">Payment</a></li>
              <li class="service-item"><a href="#" class="button service-item-link" id="credit">Guarantee</a></li>
            </ul>
            <ul class="service-description-list">
              <li class="service-description-item delivery service-description-show">
                <h2>Shipping</h2>
                <p>We will be happy to deliver your goods directly
                   to your entrance for free!
                   After all, we will make good money
                   lifting it to your floor.</p>
              </li>
              <li class="service-description-item warranty">
                <h2>Payment</h2>
                <p>You can pay for the order in any way convenient for you. 
                   In addition to gold bars, our scales broke.</p>
              </li>
              <li class="service-description-item credit">
                <h2>Guarantee</h2>
                <p>If due to the fire of the goods purchased from us
                   your house will burn down - don't worry, we will give you a new one.
                   A product, not a house, of course.</p>
              </li>
            </ul>
      </div>
    </div>

    <div class="main-container">

      <section class="logotypes">
        <h2 class="visually-hidden">Logos</h2>
        <ul class="logotype-list">
          <li class="logotype-item">
            <a href="#" class="logotype-item-link">
              <img src="img/logo-1-grey.png" width="260" height="100" alt="Logo DJI">
              <img src="img/logo-1.png" width="260" height="100" alt="Logo DJI">
            </a>
          </li>
          <li class="logotype-item">
            <a href="#" class="logotype-item-link">
              <img src="img/logo-2-grey.png" width="260" height="100" alt="Logo SPGadgets">
              <img src="img/logo-2.png" width="260" height="100" alt="Logo SPGadgets">
            </a>
          </li>
          <li class="logotype-item">
            <a href="#" class="logotype-item-link">
              <img src="img/logo-3-grey.png" width="260" height="100" alt="Logo GoPro">
              <img src="img/logo-3.png" width="260" height="100" alt="Logo GoPro">
            </a>
          </li>
          <li class="logotype-item">
            <a href="#" class="logotype-item-link">
              <img src="img/logo-4-grey.png" width="260" height="100" alt="Logo VIVE">
              <img src="img/logo-4.png" width="260" height="100" alt="Logo VIVE">
            </a>
          </li>
        </ul>
      </section>
      <div class="container">
        <section class="info">
          <h2>About us</h2>
          <p>A huge selection of gadgets will not leave a geek indifferent,
             which is in each of us.</p>
          <p>We can deliver your goods to the most remote points in the world!
             iDEVICE works with many transport companies:</p>
          <ul class="info-list">
            <li class="info-item">DHL</li>
            <li class="info-item">FedEx</li>
            <li class="info-item">UPS</li>
          </ul>
          <a class="button info-button" href="#">More about us</a>
        </section>
        <section class="contacts">
          <h2>Contact us</h2>
          <p>
            You can pick up the goods yourself by visiting our office.
            At the same time, you can check the functionality of the purchase.
            Anything can happen.
          </p>
          <a href="map.html" class="map"><img src="img/map.jpg" width="560" height="222" alt="Map" /></a>
          <a class="button contacts-button" href="form.html">Contact us</a>
        </section>
      </div>

    </div>
  </main>

  <?php require __DIR__ . '/includes/popups.php' ?>
  <?php require __DIR__ . '/includes/footer.php' ?>

