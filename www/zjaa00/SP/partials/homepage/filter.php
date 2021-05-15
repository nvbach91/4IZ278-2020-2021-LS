<div id="filter_slider" style="display: none;">
  <div>
    <a class="alco" data-alco="1" href="#"><i class="fas fa-glass-martini"></i> alko</a>
    <a class="alco" data-alco="0" href="#"><i class="fas fa-coffee"></i> nealko</a>
  </div>
  <div id="checkbox">
    <a id="deadly" href="#"><i class="fas fa-skull-crossbones"></i> smrtiaci</a>
    <a id="inflammatory" href="#"><i class="fas fa-fire"></i> zapaľovací</a>
  </div>
  <div>
    <a class="price" data-price="asc" href="#"><i class="fas fa-arrow-up"></i>cena<i class="fas fa-arrow-up"></i></a>
    <a class="price" data-price="desc" href="#"><i class="fas fa-arrow-down"></i>cena<i class="fas fa-arrow-down"></i></a>
  </div>
  <div id="submit">
    <a id="ok" href="#"><i class="fas fa-check"></i></a>
    <a id="shuffle" href="#"><i class="fas fa-random"></i></a>
  </div>
</div>

<form action="#" style="display: none;">

  <fieldset id="alco">
    <input type="radio" name="alco" value="1">
    <input type="radio" name="alco" value="0">
  </fieldset>

  <input type="checkbox" name="deadly" value="1">
  <input type="checkbox" name="inflammatory" value="1">

  <fieldset id="price">
    <input type="radio" name="price" value="asc">
    <input type="radio" name="price" value="desc">
  </fieldset>

  <input type="text" id="random" name="shuffle" value="">

</form>