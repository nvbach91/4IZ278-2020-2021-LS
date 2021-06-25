<?php
include '../include/_dbConnect.php';
const TD = '</td><td>';

// SQL view code not done

class DBViewDictEntry extends DBConnection{
    private $viewDictEntry;
    
    public function __construct(){
        parent::__construct();
        $this->viewDictEntry = $this->pdo->prepare("
            SELECT *
            FROM VstupSlovniku
        ;
        ");
    }

    public function getViewDictEntry(){
        return $this->viewDictEntry;
    }

}

$dbViewDictEntry = new DBViewDictEntry();
$dbViewDictEntry->executeQuery($dbViewDictEntry->getViewDictEntry(), []);

?>

<?php include '../include/_header.php'; ?>

<h1>Kořenovník</h1>
<br>
<table><thead>
<td>Souhlásky</td> <td>Souprava</td> <td>Jazyk</td> <td>Přepis</td> <td>Řadek</td>
</thead><tbody>
<?php
foreach($dbViewDictEntry->fetchResults($dbViewDictEntry->getViewDictEntry()) as $row){ // such encapsulation, very verbose, much OOP, wow
    echo '<tr><td>';
    echo    htmlspecialchars($row['souhlasky']).TD.
            htmlspecialchars($row['souprava']).TD.
            htmlspecialchars($row['jazyk']).TD.
            htmlspecialchars($row['prepis']).TD.
            htmlspecialchars($row['radek']);
    echo '</td></tr>';
}
?>
</tbody>
</table>

<?php include "../include/_mainMenu.php"; ?>

<?php include '../include/_footer.php'; ?>
