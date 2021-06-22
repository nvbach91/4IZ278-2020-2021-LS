<?php
include '../include/_dbConnect.php';
const TD = '</td><td>';

$odvozenina = $pdo->prepare("SELECT * FROM Odvozenina ORDER BY souhlasky, souprava ASC");
$odvozenina->execute();

?>

<?php include '../include/_header.php'; ?>

<h1>Odvozeniny a speciální slova</h1>
<br>
<table><thead>
<td>Tvar</td> <td>Jazyk</td> <td>Význam</td> <td>Souhlásky</td> <td>Souprava</td>
</thead><tbody>
<?php
foreach($odvozenina->fetchAll() as $row){
    echo '<tr><td>';
    echo $row['tvar'].TD.$row['jazyk'].TD.$row['vyznam'].TD.$row['souhlasky'].TD.$row['souprava'];
    echo '</td></tr>';
}
?>
</tbody>
</table>

<?php include '../include/_footer.php'; ?>
