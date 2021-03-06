
<!-- Fax version for people still using that, ALL CAPS = required.

      +-----------------------------------------------------------------+
   -*-+   P O K É M A G I C   T O U R N E Y   R E G I S T R A T I O N   +-*-
      +-----------------------------------------------------------------+
               MTG rules applied to Pokemon and other card decks.


1ST NAME: ____________  Middle Names: ____________  LAST NAME: ________________

Nickname: ____________  Avatar Link: __________________________________________

Sex:
[ ] Male            [ ] Female              [ ] Labourer    [ ] Labourerine
[ ] Hermaphrodite   [ ] Self-reproducing    [ ] None        [ ] Undetermined
        
Chromosomes: _________  DATE OF BIRTH: _____-__-__  Language: _________________ 

E-MAIL: __________________________________________  Phone: ____________________     

DECK TYPE:
[ ] Magic: The Gathering    [ ] Pokemon     [ ] Digimon     [ ] Game of Thrones
[ ] Call of Ktulhu          [ ] Warhammer   [ ] Ashes: Rise of the Phoenixborn
[ ] Android: Netrunner      [ ] Yu-Gi-Oh!   [ ] Final Fantasy
            
DECK SIZE (32-128): _____   Comments: _________________________________________

CRYPTO WALLET TYPE: 
[ ] Bitcoin     [ ] Bitcoin Cash    [ ] Ethrereum       [ ] Ethererum Classic
[ ] Cardano     [ ] Litecoin        [ ] StellarCoin     [ ] Ravencoin
[ ] Monero      [ ] ZCash           [ ] LBRY            [ ] BasicAttentionToken
[ ] Dogecoin    [ ] Dogethereum     [ ] Wownero
[ ] Tether      [ ] USDCoin         [ ] Binance Coin
                    
CRYPTO WALLET ADDRESS: ________________________________________________________
_______________________________________________________________________________

[ ] I AGREE TO RECEIVE SPAM EVER AFTER.

-->

<h1>PokéMagic Tourney Registration</h1>
<p>MTG rules applied to Pokemon and other card decks.</p>
    
<form>
    <div class="row mb-3">
        <label for="1st Name" class="form-label">1st Name:</label>
        <input name="name1" value="<?php isset($name1) ? $name1 : ''; ?>" class="form-control" id="1st Name">

        <label for="Middle Names" class="form-label">Middle Names:</label>
        <input name="name2" value="<?php isset($name2) ? $name2 : ''; ?>" class="form-control" id="Middle Names">

        <label for="Last Name" class="form-label">Last Name:</label>
        <input name="name3" value="<?php isset($name3) ? $name3 : ''; ?>" class="form-control" id="Last Name">
    </div>

    <div class="row mb-3">
        <label for="Nickname" class="form-label">Nickname:</label>
        <input name="nick" value="<?php isset($nick) ? $nick : ''; ?>" class="form-control" id="Nickname">

        <label for="Avatar" class="form-label">Avatar URL:</label>
        <input name="avatar" value="<?php isset($avatar) ? $avatar : ''; ?>" class="form-control" id="Avatar">
        <!-- Possible variation 
        <label class="form-label" for="AvatarFile">Avatar:</label>
        <input name="avatarFile" type="file" class="form-control" id="AvatarFile" />
        -->
    </div>


    <div class="row form-check form-check-inline"> <!-- TODO fix only (*) for Male shown -->
        <label for="sex" class="form-label">Sex:</label>
        
        <input class="form-check-input" type="radio" name="sex" id="Male" value="male" />
        <label class="form-check-label" for="Male">Male</label>

        <input class="form-check-input" type="radio" name="sex" id="Female" value="female" />
        <label class="form-check-label" for="Female">Female</label>

        <input class="form-check-input" type="radio" name="sex" id="Lab" value="lab"/>
        <label class="form-check-label" for="Lab">Labourer</label>
  
        <input class="form-check-input" type="radio" name="sex" id="Labine" value="labine"/>
        <label class="form-check-label" for="Labine">Labourerine</label>
        
        <input class="form-check-input" type="radio" name="sex" id="Herma" value="herma"/>
        <label class="form-check-label" for="Herma">Hermaphrodite</label>
  
        <input class="form-check-input" type="radio" name="sex" id="SelfRepro" value="selfRepro"/>
        <label class="form-check-label" for="SelfRepro">Self-reproducing</label>
        <!-- Words like none, nil, null, or void tend to be reserved. -->
        <input class="form-check-input" type="radio" name="sex" id="NoSex" value="noSex"/>
        <label class="form-check-label" for="NoSex">None</label>

        <input class="form-check-input" type="radio" name="sex" id="Undet" value="undet"/>
        <label class="form-check-label" for="Undet">Undetermined</label>
    </div>



    <div class="row mb-3">
        <label for="Chromosomes" class="form-label">Chromosomes:</label>
        <input name="chrom" value="<?php isset($chrom) ? $chrom : 'e.g. XX, XY, XXY, XYY, XXX, X, X0, Z0, ZW, ZZ'; ?>" class="form-control" id="Chromosomes">

        <label for="DoB" class="form-label">Date of Birth:</label>
        <input name="dob" value="<?php isset($dob) ? $dob : 'Use ISO format, e.g. 1999-12-31'; ?>" class="form-control" id="DoB">
        
        <label for="Lang" class="form-label">Language:</label>
        <input name="lang" value="<?php isset($lang) ? $lang : 'English'; ?>" class="form-control" id="Lang">
        
        <label for="E-mail" class="form-label">E-mail:</label>
        <input name="email" value="<?php isset($email) ? $email : 'e.g. someone@somewhere.com'; ?>" class="form-control" id="E-mail">
        
        <label for="Phone" class="form-label">Phone:</label>
        <input name="phone" value="<?php isset($phone) ? $phone : 'e.g. +420123456789'; ?>" class="form-control" id="Phone">
    </div>
    
    <div class="row mb-3">    
        <div class="select-wrapper form-outline">
            <label for="DeckType" class="form-label select-label">Deck Type:</label>
            <select name="deckType" id="DeckType" class="select select-initialized form-control">
                <option value="mtg">Magic: The Gathering</option>
                <option value="poke">Pokemon</option>
                <option value="digi">Digimon</option>
                <option value="got">Game of Thrones</option>            
                <option value="ktulhu">Call of Ktulhu</option>
                <option value="wh">Warhammer</option>
                <option value="ashes">Ashes: Rise of the Phoenixborn</option>
                <option value="netrun">Android: Netrunner</option>
                <option value="yugioh">Yu-Gi-Oh!</option>
                <option value="ff">Final Fantasy</option>
            </select>
        </div>

    <!-- Couldn't get range to work. Took some inspiration from akod00. -->

        <label for="DeckSize" class="form-label">Deck Size:</label>
        <!-- <input name="deckSize" value="<?php isset($deckSize) ? $deckSize : '' ?>" class="form-control" id="DeckSize"> -->
        <input name="deckSize" type="number" class="form-control" min="32" max="128" id="DeckSize" value="<?php isset($deckSize) ? $deckSize : 60; ?>" defaultValue="60" oninput="refreshDeckSize"/>
    </div>
    
    <div class="row mb-3">
        <div class="select-wrapper form-outline">
            <label for="CryptoType" class="form-label select-label">Crypto Wallet Type:</label>
            <select name="cryptoType" id="CryptoType" class="select select-initialized form-control">
                <option value="btc">Bitcoin</option>
                <option value="bch">Bitcoin Cash</option>
                <option value="eth">Ethereum</option>
                <option value="etc">Ethereum Classic</option>            
                <option value="ada">Cardano</option>
                <option value="ltc">Litecoin</option>
                <option value="xlm">StellarCoin</option>
                <option value="rvn">Ravencoin</option>
                <option value="xmr">Monero</option>
                <option value="zec">ZCash</option>
                <option value="lbry">LBRY</option>
                <option value="bat">Basic Attention Token</option>
                <option value="doge">Dogecoin</option>
                <option value="dgth">Dogethereum</option>
                <option value="wow">Wownero</option>
                <option value="usdt">Tether</option>
                <option value="usdc">USDCoin</option>
                <option value="bnb">Binance Coin</option>
            </select>
        </div>
    
        <label for="CryptoAddr" class="form-label">Crypto Address:</label>
        <input name="cryptoAddr" value="<?php isset($cryptoAddr) ? $cryptoAddr : ''; ?>" class="form-control" id="CryptoAddr">
    </div>
    
    <div class="form-check">
        <input name="agree" class="form-check-input" type="checkbox" value="" id="Agree" />
        <label class="form-check-label" for="Agree">I agree to receive spam ever after.</label>
    </div>

    <button type="register" class="btn btn-primary">Register</button>
</form>

