<?php require './classes/Person.php' ?>
<?php
    $people = [
        new Person('https://dailysuperheroes.com/wp-content/uploads/2020/02/tony-stark.jpg', 'Tony Stark', 'Americka 1000/5, Praha', 'tony@stark.indistries.com', 'www.stark.com'),
        new Person('https://images-na.ssl-images-amazon.com/images/I/61jjzervMjL._UY550_.jpg', 'Tony Stark2', 'Americka 1000/5, Praha2', 'tony@stark.indistries.com2', 'www.stark.com2'),
    ];
?>
<h2>People</h2>
<ul>
    <?php foreach ($people as $person): ?>
        <section class="section">
            <img class="img" src="<?php echo $person->image ?>" alt="profile picture"/>
            <div>
                <h2><?php echo $person->name; ?></h2>
                <hr/>
                <ul>
                    <li><?php echo $person->address; ?></li>
                    <li><?php echo $person->mail ?></li>
                    <li><?php echo $person->web ?></li>
                </ul>
            </div>
        </section>
    <?php endforeach;?>
</ul>
