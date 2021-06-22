<?php require '../include/_formData.php'; ?>

<?php
    $inputErrors = [];
    $isSub = !empty($_POST);
    
    if($isSub){
        // Obtain individual fields 
        $tvar = htmlspecialchars($_POST['tvar']);
        $jazyk = htmlspecialchars($_POST['jazyk']);
        $vyznam=$_POST['typ'];
        $souhlasky = htmlspecialchars($_POST['souhlasky']);
        $souprava = htmlspecialchars($_POST['souprava']);
        $delka = strlen($souhlasky);
        
        if(isset($_POST['koren'])) $koren = $_POST['koren'] ? true : false;
        if(isset($_POST['idiom'])) $koren = $_POST['idiom'] ? true : false;
        
        // Check required fields
        if(!$souhlasky || !$souhlasky){
            array_push($inputErrors, "Souhlásky obou kořenů musí být vyplněny.");
        }
        
        // Validate
        if($souhlasky && $souhlasky && !preg_match($consRegex, $souhlasky1) && !preg_match($consRegex, $souhlasky1)){
            array_push($inputErrors, $consError);
        }
        
        if(!count($inputErrors)){
            $succMsg = 'Validace uspesna.';
        
            // Put it in the database
            include '../include/_dbConnect.php';
            
            $insertRoot = $pdo->prepare("INSERT INTO Koren (souhlasky, souprava, delka) VALUES (:souhl, :soup, :del);");
            $insertIdiom = $pdo->prepare("INSERT INTO Idiom (tvar, jazyk, vyznam) VALUES (:tvar, :jazid, :vyz);");
            $insertUsage = $pdo->prepare("INSERT INTO Pouziti (souhlasky, souprava, tvar, jazyk) VALUES (:souhl, :soup, :tvar, :jazid);");
            
            if($koren){
                $insertRoot->execute(['souhl' => $souhlasky1, 'soup' => $souprava1, 'del' => $delka]);
            }
            if($idiom){
                $insertIdiom->execute(['tvar' => $tvar, 'jazid' => $jazyk, 'vyz' => $vyznam]);
            }
            if($koren && $idiom){
                $insertUsage->execute(['souhl' => $souhlasky, 'soup' => $souprava, 'tvar' => $tvar, 'jazid' => $jazyk]);
            }
        }
    }
?>

<?php include '../include/_header.php'; ?>

<h1>Vložit použití kořenu v idiomu nebo složenině</h1>
<br>
<form align="center" method="POST">
    <div>
        <label for="Tvar" class="form-label">Tvar:</label>
        <input name="tvar" type="text" value="<?php isset($tvar) ? $tvar : ''; ?>" class="form-control" id="Tvar">

        <label for="Jazyk" class="form-label select-label">Jazyk:</label>
        <select name="jazyk" id="JayzkPreklad" class="select select-initialized form-control">
            <?php
            for($i=0; $i<sizeof($langCodes); $i++){
                echo "<option value=\"$langCodes[$i]\">$langCodes[$i] - $langNames[$i]</option>";
            }
            ?>   
        </select>
        
        <label for="Vyznam" class="form-label">Význam:</label>
        <input name="vyznam" type="text" value="<?php isset($vyznam) ? $vyznam : ''; ?>" size="64" class="form-control" id="vyznam">
    </div>
    <br>
    <div>   
        <label for="Souhlasky" class="form-label">Souhlásky:</label>
        <input name="souhlasky" type="text" value="<?php isset($souhlasky) ? $souhlasky : ''; ?>" size="16" class="form-control" id="Souhlasky">

        <label for="Souprava" class="form-label select-label">Souprava:</label>
        <select name="souprava" id="Souprava" class="select select-initialized form-control">
            <?php
            for($i=0; $i<sizeof($ctxCodes); $i++){
                echo "<option value=\"$ctxCodes[$i]\">$ctxCodes[$i] - $ctxNames[$i]</option>";
            }
            ?>   
        </select>
    </div>
    <br><br>
    <div>
        <input name="koren" class="form-check-input" type="checkbox" value="" id="Koren" />
        <label class="form-check-label" for="Koren">Kořen</label>
        <input name="idiom" class="form-check-input" type="checkbox" value="" id="Idiom" />
        <label class="form-check-label" for="Puvod">Idiom</label>
    </div>
    <br>
    <div>
    <button type="submit" class="btn btn-primary"><big><b>Odeslat</b></big></button>
    </div>
</form>

<br><br>

<?php

if(!empty($_POST)){
    echo "<h2>Odesláno:</h2>";
    print_r($_POST);
}

/*
IDIOM/SLOZENINA              KOREN   
Tvar   Jazyk  Význam    ***  Souhlasky   Souprava

Pouziti: Koren <-> Idiom
*/

?>

<?php include '../include/_footer.php'; ?>
