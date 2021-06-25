<?php require '../include/_formData.php'; ?>

<?php

include '../include/_dbConnect.php';

class DBRemoveRoot extends DBConnection{

    private $removeRoot;

    public function __construct(){
        parent::__construct();
        $this->removeRoot = $this->pdo->prepare("delete from Koren where souhlasky = :souhl and souprava = :soup;");
    }

    public function getRemoveRoot(){
        return $this->removeRoot;
    }

}

    $inputErrors = [];
    $isSub = !empty($_POST);
    
    if($isSub){
        // Obtain individual fields 
        $souhlasky = htmlspecialchars($_POST['souhlasky']);
        $souprava = htmlspecialchars($_POST['souprava']);
        
        // Check required fields
        if(!$souhlasky){
            array_push($inputErrors, "Souhlásky musí být vyplněny.");
        }
        
        // Validate
        if($souhlasky && !preg_match($consRegex, $souhlasky)){
            array_push($inputErrors, $consError);
        }
        
        if(!count($inputErrors)){
            $succMsg = 'Validace uspesna.';
        
            // Put it in the database
            $dbRemoveRoot = new DBRemoveRoot();
            $dbRemoveRoot->executeQuery(
                $dbRemoveRoot->getRemoveRoot(), 
                ['souhl'=> $souhlasky, 'soup'=> $souprava]
            );
        }
    }
?>


<?php include '../include/_header.php'; ?>

<h1>Vymazat kořen (kaskáduje!)</h1>
<br>
<form align="center" method="POST">
    <h3>Kořen:</h3>
    <div>
        <label for="Souhlasky" class="form-label">Souhlásky:</label>
        <input name="souhlasky" type="text" value="<?php isset($souhlasky1) ? $souhlasky1 : ''; ?>" size="16" class="form-control" id="Souhlasky1">

        <label for="Souprava1" class="form-label select-label">Souprava:</label>
        <select name="souprava1" id="Souprava1" class="select select-initialized form-control">
            <?php
            for($i=0; $i<sizeof($ctxCodes); $i++){
                echo "<option value=\"$ctxCodes[$i]\">$ctxCodes[$i] - $ctxNames[$i]</option>";
            }
            ?>   
        </select>
    </div>
    <br>
    <br>
    <div>
    <button type="submit" class="btn btn-primary"><big><b>Vymazat</b></big></button>
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
