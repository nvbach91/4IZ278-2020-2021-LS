<?php
include '../include/_dbConnect.php';
const TD = '</td><td>';

// Not done
$dictEntry = $pdo->prepare("
    SELECT *
    FROM VstupSlovniku
;
");
$thesaurus->execute();

?>

<?php include '../include/_header.php'; ?>

<h1>Kořenovník</h1>
<br>
<table><thead>
<td>Souhlásky</td> <td>Souprava</td> <td>Jazyk</td> <td>Přepis</td> <td>Řadek</td>
</thead><tbody>
<?php
foreach($dictEntry->fetchAll() as $row){
    echo '<tr><td>';
    echo $row['souhlasky'].TD.$row['souprava'].TD.$row['jazyk'].TD.$row['prepis'].TD.$row['radek'];
    echo '</td></tr>';
}
?>
</tbody>
</table>

<?php include '../include/_footer.php'; ?>
