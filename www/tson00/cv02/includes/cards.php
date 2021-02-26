<?php 
$cards = [
    new Person('logo-social.png','Tsoy','Nadya','16/04/1996','IT junior','Nadya s.r.o','far away','9','11','My city','911 911 911','tson00@vse.cz','mypage.com','yes'),
    new Person('logo-name.png','Novotny','Jan','30/03/2005','Student','University','Karlovo namesti','92','12','Praha','911 911 333','nov@seznam.cz','nov.cz','yes'),
    new Person('company-name.png','White','Bill','16/04/1993','Manager','Google','Vodickova','12','44','Brno','911 911 555','bill@gmail.com','bill.com','yes'),
    new Person('logo-company.png','Pitt','Adam','16/04/1992','Sales','Bon bony','Spalena','87','35','Opava','911 911 555','adam@email.cz','pitt.ru','yes'),
];
?>
<?php foreach($cards as $card): ?>
    <div class="styl">
        <div class="container-fluid">
            <div class="styldiv">
                <p><img alt="card-avatar" src="<?php echo  $card->avatar;?>"></p>
                <div class="container-fluid">        
                    <div class="card-jmeno">
                        <?php echo $card->getFullName();?>
                    </div>        
                    <div class="card-age">
                        <?php echo $card->getAge();?>
                    </div>
                    <div class="card-position">
                        Povolání: <?php echo $card->position;?>
                    </div>
                    <div class="card-companyname">
                        Název firmy: <?php echo $card->companyname;?><br>
                    </div>
                    <div class="card-adress">
                        <?php echo $card->getAddress();?>
                    </div>
                    <div class="card-phone">
                        Telefon: <?php echo $card->phone;?>
                    </div>
                    <div class="card-email">
                        Email:<?php echo $card->email;?>
                        </div>
                    <div class="card-webpage">
                        <a href="https://eso.vse.cz/~tson00/cv01/">Webová stránka: <?php echo $card->webpage;?></a><br>
                    </div>
                    <div class="card-avaib">
                        Dostupný: <?php echo $card->avaib;?>
                    </div>             
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>
     