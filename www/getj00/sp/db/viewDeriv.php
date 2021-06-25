<?php
include '../include/_dbConnect.php';
const TD = '</td><td>';


class DBViewDeriv extends DBConnection{
    private $viewDeriv;
    
    public function __construct(){
        parent::__construct();
        $this->viewDeriv = $this->pdo->prepare("SELECT * FROM Odvozenina ORDER BY souhlasky, souprava ASC");
    }

    public function getViewDeriv(){
        return $this->viewDeriv;
    }

}

$dbViewDeriv = new DBViewDeriv();
$dbViewDeriv->executeQuery($dbViewDeriv->getViewDeriv(), []);

?>

<?php include '../include/_header.php'; ?>

<h1>Odvozeniny a speciální slova</h1>
<br>
<table><thead>
<td>Tvar</td> <td>Jazyk</td> <td>Význam</td> <td>Souhlásky</td> <td>Souprava</td>
</thead><tbody>
<?php
foreach($dbViewDeriv->fetchResults($dbViewDeriv->getViewDeriv()) as $row){
    echo '<tr><td>';
    echo $row['tvar'].TD.$row['jazyk'].TD.$row['vyznam'].TD.$row['souhlasky'].TD.$row['souprava'];
    echo '</td></tr>';
}
?>
</tbody>
</table>

<?php include "../include/_mainMenu.php"; ?>

<?php include '../include/_footer.php'; ?>
