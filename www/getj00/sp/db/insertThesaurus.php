<?php require '../include/_formData.php'; ?>

<?php

include '../include/_dbConnect.php';

class DBInsertThesaurus extends DBConnection{

    private $insertThesaurus;

    public function __construct(){
        parent::__construct();
        $this->insertThesaurus = $this->pdo->prepare("INSERT INTO Antosynonymum (souhlasky1, souprava1, typ, souhlasky2, souprava2) VALUES (:souhl1, :soup1, :typ, :souhl2, :soup2);");
    }

    public function getInsertThesaurus(){
        return $this->insertThesaurus;
    }

}


    $inputErrors = [];
    $isSub = !empty($_POST);
    
    if($isSub){
        // Obtain individual fields 
        $souhlasky1 = htmlspecialchars($_POST['souhlasky1']);
        $souprava1 = htmlspecialchars($_POST['souprava1']);
        $typ=$_POST['typ'];
        $souhlasky2 = htmlspecialchars($_POST['souhlasky2']);
        $souprava2 = htmlspecialchars($_POST['souprava2']);
        
        // Check required fields
        if(!$souhlasky1 || !$souhlasky2){
            array_push($inputErrors, "Souhlásky obou kořenů musí být vyplněny.");
        }
        
        // Validate
        if($souhlasky1 && $souhlasky2 && !preg_match($consRegex, $souhlasky1) && !preg_match($consRegex, $souhlasky2)){
            array_push($inputErrors, $consError);
        }
        
        if(!count($inputErrors)){
            $succMsg = 'Validace uspesna.';
        
            // Put it in the database
            $dbInsertThesaurus = new DBInsertThesaurus();
            $dbInsertThesaurus->executeQuery(
                $dbInsertThesaurus->getInsertThesaurus(), 
                ['souhl1'=> $souhlasky1, 'soup1'=> $souprava1, 'typ' => $typ, 'souhl2'=> $souhlasky2, 'soup2'=> $souprava2]
            );
        }
        //header("refresh:5;url=https://eso.vse.cz/~getj00/sp/db/viewThesaurus.php");
    }
?>


<?php include '../include/_header.php'; ?>

<h1>Vložit vazbu thesauru</h1>
<br>
<form align="center" method="POST">
    <h3>Kořen 1:</h3>
    <div>
        <label for="Souhlasky1" class="form-label">Souhlásky:</label>
        <input name="souhlasky1" type="text" value="<?php isset($souhlasky1) ? $souhlasky1 : ''; ?>" size="16" class="form-control" id="Souhlasky1">

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
    <h3>Vazba:</h3>
    <div>
    
    <label for="Typ" class="form-label">Typ vazby:</label>
        <?php
        for($i=0; $i<sizeof($linkCodes); $i++){
            echo "<input class=\"form-check-input\" type=\"radio\" name=\"typ\" id=\"$linkNames[$i]\" value=\"$linkCodes[$i]\" />";
            echo "<label class=\"form-check-label\" for=\"$linkNames[$i]\">$linkCodes[$i] - $linkNames[$i]</label>";
        }
        ?>
    <!--
        <input class="form-check-input" type="radio" name="typ" id="Antonymum" value="A" />
        <label class="form-check-label" for="Male">Antonymum</label>

        <input class="form-check-input" type="radio" name="typ" id="Synonymum" value="S" />
        <label class="form-check-label" for="Female">Synonymum</label>

        <input class="form-check-input" type="radio" name="typ" id="Varianta" value="V"/>
        <label class="form-check-label" for="Lab">Varianta</label>
    -->
    <!--
        <label for="Typ" class="form-label select-label">Typ vazby:</label>
        <select name="typ" id="Typ" class="select select-initialized form-control">
            <?php
            for($i=0; $i<sizeof($linkCodes); $i++){
                echo "<option value=\"$linkCodes[$i]\">$linkCodes[$i] - $linkNames[$i]</option>";
            }
            ?>   
        </select>
    -->
    </div>
    <br>
    <h3>Kořen 2:</h3>
    <div>
        <label for="Souhlasky2" class="form-label">Souhlásky:</label>
        <input name="souhlasky2" type="text" value="<?php isset($souhlasky2) ? $souhlasky2 : ''; ?>" size="16" class="form-control" id="Souhlasky2">

        <label for="Souprava2" class="form-label select-label">Souprava:</label>
        <select name="souprava2" id="Souprava2" class="select select-initialized form-control">
            <?php
            for($i=0; $i<sizeof($ctxCodes); $i++){
                echo "<option value=\"$ctxCodes[$i]\">$ctxCodes[$i] - $ctxNames[$i]</option>";
            }
            ?>   
        </select>
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
