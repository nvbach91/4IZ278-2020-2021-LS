<?php
include '../include/_dbConnect.php';
const TD = '</td><td>';

class DBStats extends DBConnection{
    private $poctyKorenu;
    private $poctyPuvodu;
    private $poctyOdvozenin;
    
    public function __construct(){
        parent::__construct();
        $this->poctyKorenu = $this->pdo->prepare("SELECT souprava, count(souprava) pocet, min(delka) nejkratsi, avg(delka) prumernaDelka, max(delka) nejdelsi FROM Koren GROUP BY souprava ORDER BY souprava ASC");
        $this->poctyPuvodu = $this->pdo->prepare("SELECT jazyk, count(jazyk) pocet FROM Puvod GROUP BY jazyk");
        $this->poctyOdvozenin = $this->pdo->prepare("SELECT souhlasky, souprava, count(tvar) pocet FROM Odvozenina GROUP BY souhlasky, souprava ORDER BY pocet DESC");
    }

    public function getPoctyKorenu(){
        return $this->poctyKorenu;
    }
    public function getPoctyPuvodu(){
        return $this->poctyKorenu;
    }
    public function getPoctyOdvozenin(){
        return $this->poctyKorenu;
    }
    

}

$dbStats = new DBStats();
$dbStats->executeQuery($dbStats->getPoctyKorenu(), []);
$dbStats->executeQuery($dbStats->getPoctyPuvodu(), []);
$dbStats->executeQuery($dbStats->getPoctyOdvozenin(), []);

?>

<?php include '../include/_header.php'; ?>

<h1>Statistiky</h1>
<br>
<h2>Počty kořenů a jejich délka v každé soupravě</h2>
<br>
<table><thead>
<td>Souprava</td> <td>Počet kořenů</td> <td>Nejkratší</td> <td>Průměrná délka</td> <td>Nejdelší</td>
</thead><tbody>
<?php
foreach($dbStats->fetchResults($dbStats->getPoctyKorenu()) as $row){
    echo '<tr><td>';
    echo $row['souprava'].TD.$row['pocet'].TD.$row['nejkratsi'].TD.$row['prumernaDelka'].TD.$row['nejdelsi'];
    echo '</td></tr>';
}
?>
</tbody>
</table>

<br><br><br>

<h2>Počty původů dle zdrojových jazyků</h2>
<br>
<table><thead>
<td>Kód jazyka</td> <td>Počet původů</td>
</thead><tbody>
<?php
foreach($dbStats->fetchResults($dbStats->getPoctyPuvodu()) as $row){
    echo '<tr><td>';
    echo $row['jazyk'].TD.$row['pocet'];
    echo '</td></tr>';
}
?>
</tbody>
</table>

<br><br><br>

<h2>Počty odvozenin dle kořenů</h2>
<br>
<table><thead>
<td>Souhlásky</td> <td>Souprava</td> <td>Počet odvozenin</td>
</thead><tbody>
<?php
foreach($dbStats->fetchResults($dbStats->getPoctyOdvozenin()) as $row){
    echo '<tr><td>';
    echo $row['souhlasky'].TD.$row['souprava'].TD.$row['pocet'];
    echo '</td></tr>';
}
?>
</tbody>
</table>

<?php include "../include/_mainMenu.php"; ?>

<?php include '../include/_footer.php'; ?>
