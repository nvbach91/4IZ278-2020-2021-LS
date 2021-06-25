<?php require '../include/_formData.php'; ?>

<?php

include '../include/_dbConnect.php';

// Used when someone takes the time to add the words in original script.

class DBModifyOrigin extends DBConnection{

    private $modifyOrigin;

    public function __construct(){
        parent::__construct();
        // get origin state (optimistic locking? however the slovo state is not exposed, gets overwritten anyway)
        $this->modifyOrigin = $this->pdo->prepare("UPDATE Puvod SET slovo = :sl WHERE Puvod.jazyk = :jaz AND Puvod.prepis = :prep;");
    }

    public function getModifyOrigin(){
        return $this->modifyOrigin;
    }

}

    $inputErrors = [];
    $isSub = !empty($_POST);
    
    if($isSub){
        // Obtain individual fields 
        $jazykPuvod = htmlspecialchars($_POST['jazykPuvod']);
        $prepis = htmlspecialchars($_POST['prepis']);
        $slovo = htmlspecialchars($_POST['prepis']);
        
        // Check required fields
        if(!$prepis){
            array_push($inputErrors, "Přepis musí být vyplněn.");
        }
        
        if(!count($inputErrors)){
            $succMsg = 'Validace uspesna.';
        
            // Put it in the database
            $dbModifyOrigin = new DBModifyOrigin();
            $dbModifyOrigin->executeQuery(
                $dbModifyOrigin->getModifyOrigin(), 
                ['sl'=> $slovo, 'jaz' => $jazykPuvod, 'prep'=> $prepis]
            );
        }
    }
?>


<?php include '../include/_header.php'; ?>

<h1>Přidat původní slovo v původním písmu</h1>
<br>
<form align="center" method="POST">
    <h3>Původ:</h3>
    <div>
        <label for="JazykPuvod" class="form-label select-label">Jazyk:</label>
        <select name="jazykPuvod" id="JayzkPuvod" class="select select-initialized form-control">
            <?php
            for($i=0; $i<sizeof($langCodes); $i++){
                echo "<option value=\"$langCodes[$i]\">$langCodes[$i] - $langNames[$i]</option>";
            }
            ?>   
        </select>
        
        <label for="Prepis" class="form-label">Přepis:</label>
        <input name="prepis" type="text" value="<?php isset($prepis) ? $prepis : ''; ?>" class="form-control" id="Prepis">    
    
        <label for="Slovo" class="form-label">Nové původí slovo:</label>
        <input name="slovo" type="text" value="<?php isset($slovo) ? $slovo : ''; ?>" class="form-control" id="Slovo">
        
    </div>
    <br>
    <br>
    <div>
    <button type="submit" class="btn btn-primary"><big><b>Změnit</b></big></button>
    </div>
</form>

<br><br>

<?php

if(!empty($_POST)){
    echo "<h2>Odesláno:</h2>";
    print_r($_POST);
	print_r($inputErrors);
}

/*
KOREN                 VAZBA    KOREN 2
Souhlasky Souprava *** Typ *** Souhlasky Souprava
bbb          B        A/S/V

*/

?>

<?php include "../include/_mainMenu.php"; ?>

<?php include '../include/_footer.php'; ?>
