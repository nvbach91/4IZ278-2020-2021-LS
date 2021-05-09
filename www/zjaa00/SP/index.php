<?php
  include "partials/header.php";
  require "partials/navbar.php";
?>
<main id="drinks_page">
  <?php if(@($_COOKIE['privilege']) > 1): ?>
    <div id="create_buttons">
      <div class="btn-group">
        <a href="create_item.php" class="btn btn-light">Nový drink</a>
        <a href="ingredients.php" class="btn btn-outline-light">Ingrediencie</a>
        <a href="create_ingredient.php" class="btn btn-outline-light"><i class="fas fa-plus"></i></a>
      </div>
    </div>
  <?php endif; ?>

  <div id="drinks_box" style="display: none;">


  </div>

</main>
<!-- <footer>
    <div class="trademark">
      <p>
        Naše originálne drinky aj s našou značkou sú zapísané pod číslom patentu ochrannej známky “NEBRA-slovná” pod číslom OZ 239511, ďalšia ochranná známka POZ 00082-2009. Všetky kombinácie drinkov sú len naše vlastné, nikdy sme sa nesnažili kopírovať, alebo napodobňovať iné prevádzky. Našou snahou bolo ponúknuť Vám nevšedné a zaujímavé drinky. Dúfame, že sme Vám pri tom spríjemnili Vaše chvíle u nás. Ďakujeme za prejavenú dôveru a Vašu náklonnosť k nám. Miešané drinky sme rozdelili do niekoľkých častí, ktoré sú pre nich charakteristické. Niektoré vyzerajú realisticky, napríklad Spermia, Mozog, Bahno, ďalšie sa chuťou pripodobňujú na cukríky, čokolády alebo dezertíky. Iné sú zas vymyslené na počest niekoho, alebo niekomu ako darček. Karamelová cesta (alebo tiež Rozkopaná) sa viaže na naše rozkopané Košice teraz, ako aj vtedy (prestavba Bočnej ulice). 60 drinkov je namiešaných pre Vás, každý bol vytvorený s láskou a chuťou ponúknuť Vám niečo originálne. Keďže sa v meste veľmi rozmohlo napodbňovanie a kopírovanie našich nápojov, plagiáty alebo “fejky” sú pre nás výzvou zlepšiť naše ochranné charakteristické znaky drinkov.
      </p>
    </div>
</footer> -->

<?php include "partials/footer.php"; ?>