<?php
include '../include/_dbConnect.php';
const TD = '</td><td>';

// SQL view code not done

class DBViewIdiom extends DBConnection{
    private $viewIdiom;
    
    public function __construct(){
        parent::__construct();
        $this->viewIdiom = $this->pdo->prepare("
            SELECT *
            FROM Slozenina
            ;
        ");
    }

    public function getViewIdiom(){
        return $this->viewIdiom;
    }

}

$dbViewIdiom = new DBViewIdiom();
$dbViewIdiom->executeQuery($dbViewIdiom->getViewIdiom(), []);


?>

<?php include '../include/_header.php'; ?>

<h1>Kořenovník</h1>
<br>
<table><thead>
<td>Výraz</td> <td>Vyznam</td>
</thead><tbody>
<?php
foreach($dbViewIdiom->fetchResults($dbViewIdiom->getViewIdiom()) as $row){
    echo '<tr><td>';
    echo htmlspecialchars($row['vyraz']).TD.htmlspecialchars($row['vyznam']);
    echo '</td></tr>';
}
?>
</tbody>
</table>

<?php include "../include/_mainMenu.php"; ?>

<?php include '../include/_footer.php'; ?>
