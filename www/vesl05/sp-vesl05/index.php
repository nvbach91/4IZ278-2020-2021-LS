<?php require __DIR__ . '/includes/header.php'; ?>
<?php require __DIR__ . '/includes/navigation.php'; ?>

<div class="container-fluid">
    <div class="row">
        <h2>
        Available events:    
        </h2>
    </div>
    <div class="row">
        <h4>
        filters: 
        </h4>
    </div>
    <div class="row">
        <div class="col-md-3">
            <select class="form-select" name="genres" id="genres">
                <option selected>Genres</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select" name="price-range" id="price-range">
                <option selected>Price range</option>
            </select>
        </div>
    </div>
    <div class="row events-row">
        <div class="card" style="width: 18rem;">
            <img src="./resources/img-placeholder.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Event name</h5>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Temporibus autem quibusdam et aut officiis debitis aut</p>
              <a href="cart.php" class="btn btn-primary">Add to cart</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="./resources/img-placeholder.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Event name</h5>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Temporibus autem quibusdam et aut officiis debitis aut</p>
              <a href="cart.php" class="btn btn-primary">Add to cart</a>
            </div>
        </div>    
        <div class="card" style="width: 18rem;">
            <img src="./resources/img-placeholder.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Event name</h5>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Temporibus autem quibusdam et aut officiis debitis aut</p>
              <a href="cart.php" class="btn btn-primary">Add to cart</a>
            </div>
        </div>    
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php' ?> 