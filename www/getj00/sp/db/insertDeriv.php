<?php require '../include/_formData.php'; ?>

<?php
    $inputErrors = [];
    $isSub = !empty($_POST);
    
    if($isSub){
        // Obtain individual fields
        $tvar=htmlspecialchars($_POST['tvar']);
        $jazyk = htmlspecialchars($_POST['jazyk']);
        $vyznam = htmlspecialchars($_POST['vyznam']);        
        $souhlasky = htmlspecialchars($_POST['souhlasky']);
        $souprava = htmlspecialchars($_POST['souprava']);
        
        // Check required fields
        if(!$tvar){
            array_push($inputErrors, "Tvar musí být vyplněn.");
        }
        if(!$vyznam){
            array_push($inputErrors, "Význam musí být vyplněn.");
        }
        
        // Validate
        if($souhlasky1 && $souhlasky2 && !preg_match($consRegex, $souhlasky1) && !preg_match($consRegex, $souhlasky1)){
            array_push($inputErrors, $consError);
        }
        
        if(!count($inputErrors)){
            $succMsg = 'Validace uspesna.';
        
            // Put it in the database
            include '../include/_dbConnect.php';
        
            $insertDeriv = $pdo->prepare("INSERT INTO Odvozenina (tvar, jazyk, vyznam, souhlasky, souprava) VALUES (:tvar, :jazodv, :vyz, :souhl, :soup);");
            $insertDeriv->execute(['tvar'=> $tvar, 'jazodv'=> $jazyk, 'vyz' => $vyznam, 'souhl'=> $souhlasky, 'soup'=> $souprava]);
        }
    }
?>

<?php include '../include/_header.php'; ?>

<h1>Vložit odvozeninu nebo speciální slovo</h1>
<br>
<form align="center" method="POST">
    <div>
        <label for="Tvar" class="form-label">Tvar:</label>
        <input name="tvar" type="text" value="<?php isset($tvar) ? $tvar : ''; ?>" class="form-control" id="Tvar">

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
    <br>
    <div>   
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
    <br><br>
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
Tvar      Koren Souprava Jazyk   Vyznam
sdfsdfsdf ddd    A       mis \/  efgergreegegege
*/

?>

<?php include '../include/_footer.php'; ?>
