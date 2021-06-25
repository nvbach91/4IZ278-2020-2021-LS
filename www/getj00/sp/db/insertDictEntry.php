
<?php require '../include/_formData.php'; ?>

<?php

include '../include/_dbConnect.php';

// "Don't repat yourself" my ass with this OOP boilerplate

class DBInsertDictEntry extends DBConnection{

    private $insertRoot;
    private $insertOrigin;
    private $insertTransl;
    private $insertDictEntry;

    public function __construct(){
        parent::__construct();
        $this->insertRoot = $this->pdo->prepare("INSERT INTO Koren (souhlasky, souprava, delka) VALUES (:souhl, :soup, :del);");
        $this->insertOrigin = $this->pdo->prepare("INSERT INTO Puvod (jazyk, slovo, prepis) VALUES (:jazpuv, :sl, :prep);");
        $this->insertTransl = $this->pdo->prepare("INSERT INTO Preklad (jazyk, podstatne, pridavne, sloveso, prislovce) VALUES (:jazpr, :pod, :prid, :slso, :prisl);");
        $this->insertDictEntry = $this->pdo->prepare("INSERT INTO VstupSlovniku (souhlasky, souprava, jazyk, prepis, radek) VALUES (:souhl, :soup, :jazpuv, :prep, (SELECT MAX(radek) FROM Preklad));");
    
    }

    public function getInsertRoot(){
        return $this->insertRoot;
    }
    
    public function getInsertOrigin(){
        return $this->insertOrigin;
    }
    
    public function getInsertTransl(){
        return $this->insertTransl;
    }
    
    public function getInsertDictEntry(){
        return $this->insertDictEntry;
    }

}


    $inputErrors = [];
    $isSub = !empty($_POST);
    
    if($isSub){
    
        // Obtain individual fields 
        $souhlasky = htmlspecialchars($_POST['souhlasky']);
        $souprava = htmlspecialchars($_POST['souprava']);
        $delka = strlen($souhlasky);
        
        $jazykPuvod = htmlspecialchars($_POST['jazykPuvod']);
        $slovo = htmlspecialchars($_POST['slovo']);
        $prepis = htmlspecialchars($_POST['prepis']);
       
        $jazykPreklad = htmlspecialchars($_POST['jazykPreklad']);
        $podstatne = htmlspecialchars($_POST['podstatne']);
        $pridavne = htmlspecialchars($_POST['pridavne']);
        $sloveso = htmlspecialchars($_POST['sloveso']);
        $prislovce = htmlspecialchars($_POST['prislovce']);
        
	    $koren = isset($_POST['koren']);
        $puvod = isset($_POST['puvod']);
        $preklad = isset($_POST['preklad']);
        /*if(!($koren && $puvod && $preklad)){
            array_push($inputErrors, "Nic nebylo zaškrtnuto, že se má vložit.");
		}
        
        
        // Check required fields
        if($koren && !$souhlasky){
            array_push($inputErrors, "Souhlásky kořenu musí být vyplněny.");
        }
        if($puvod && !$prepis){
            array_push($inputErrors, "Přepis původního slova musí být vyplněn.");
        }
        if($preklad && !($podstatne && $pridavne && $slovso && $prislovce)){
            array_push($inputErrors, "Alespoň 1 kolonka překladu musí být vyplněna.");
        }
        
        // Validate
        if($souhlasky && !preg_match($consRegex, $souhlasky)){
            array_push($inputErrors, $consError);
        }
        if($prepis && !preg_match('/^[ \p{Latin}]+$/', $prepis)){
            array_push($inputErrors, "Přepis musí být latinkou.");
		}*/
        
        if(!count($inputErrors)){
            $succMsg = 'Validace uspesna.';
        
            // Prepare database and queries
            $dbInsertDictEntry = new DBInsertDictEntry();
            
            if($koren){
				$dbInsertDictEntry->executeQuery(
				    $dbInsertDictEntry->getInsertRoot(),
				    ['souhl'=> $souhlasky, 'soup'=> $souprava, 'del' => $delka]
				);	
            }
            
            if($puvod){
                $dbInsertDictEntry->executeQuery(
                    $dbInsertDictEntry->getInsertOrigin(), 
                    ['jazpuv'=> $jazykPuvod, 'sl'=> $slovo, 'prep' => $prepis]
                );
            }
            if($preklad){
                $dbInsertDictEntry->executeQuery(
                    $dbInsertDictEntry->getInsertTransl(), 
                    ['jazpr'=> $jazykPreklad, 'pod'=> $podstatne, 'prid' => $pridavne, 'slso' => $sloveso, 'prisl' => $prislovce]
                );
            }
            if($koren && $puvod && $preklad){
                $dbInsertDictEntry->executeQuery(
                    $dbInsertDictEntry->getInsertDictEntry(), 
                    ['souhl'=> $souhlasky, 'soup'=> $souprava, 'jazpuv' => $jazykPuvod, 'prep' => $prepis]
                );
            }
        }
    }

?>

<?php include '../include/_header.php'; ?>

<h1>Vložit vstup kořenovníku</h1>
<br>
<form align="center" method="POST">
    <h3>Kořen:</h3>
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
    <br>
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
    
        <label for="Slovo" class="form-label">Slovo:</label>
        <input name="slovo" type="text" value="<?php isset($slovo) ? $slovo : ''; ?>" class="form-control" id="Slovo">
        
        <label for="Prepis" class="form-label">Přepis:</label>
        <input name="prepis" type="text" value="<?php isset($prepis) ? $prepis : ''; ?>" class="form-control" id="Prepis">
    </div>
    <br>
    <h3>Překlad:</h3>  
    <div>    
        <label for="JazykPreklad" class="form-label select-label">Jazyk:</label>
        <select name="jazykPreklad" id="JayzkPreklad" class="select select-initialized form-control">
            <?php
            for($i=0; $i<sizeof($langCodes); $i++){
                echo "<option value=\"$langCodes[$i]\">$langCodes[$i] - $langNames[$i]</option>";
            }
            ?>   
        </select>
        
        <label for="Podstatne" class="form-label">Podstatné&nbsp;jméno:</label>
        <input name="podstatne" type="text" value="<?php isset($podstatne) ? $podstatne : ''; ?>" class="form-control" id="Podstatne">
        
        <label for="Pridavne" class="form-label">Přídavné&nbsp;jméno:</label>
        <input name="pridavne" type="text" value="<?php isset($pridavne) ? $pridavne : ''; ?>" class="form-control" id="Pridavne">
        
        <label for="Sloveso" class="form-label">Sloveso:</label>
        <input name="sloveso" type="text" value="<?php isset($sloveso) ? $sloveso : ''; ?>" class="form-control" id="Sloveso">
        
        <label for="Prislovce" class="form-label">Příslovce:</label>
        <input name="prislovce" type="text" value="<?php isset($prislovce) ? $prislovce : ''; ?>" class="form-control" id="Prislovce">
    </div>
    <br><br>
    <div>
        <input name="koren" class="form-check-input" type="checkbox" value="" id="Koren" />
        <label class="form-check-label" for="Koren">Kořen</label>
        <input name="puvod" class="form-check-input" type="checkbox" value="" id="Puvod" />
        <label class="form-check-label" for="Puvod">Původ</label>
        <input name="preklad" class="form-check-input" type="checkbox" value="" id="Preklad" />
        <label class="form-check-label" for="Preklad">Překlad</label>
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
KOREN                            PUVOD                           PREKLAD
Souhlasky Souprava (Delka) *** Jazyk Slovo Prepis *** (Radek) Jazyk Podstatne Pridavne Sloveso Prislovce
bbb          B                 jpn \/  eee  eee               ces \/  sddf    sdfd

-> Koren, Puvod, Preklad -> DictEntry

*/

?>

<?php include "../include/_mainMenu.php"; ?>

<?php include '../include/_footer.php'; ?>

