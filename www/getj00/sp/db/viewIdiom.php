<?php
include '../include/_dbConnect.php';
const TD = '</td><td>';

// Not done
$dictEntry = $pdo->prepare("
    SELECT *
    FROM Idiom
;
");
$thesaurus->execute();

?>

<?php include '../include/_header.php'; ?>

<h1>Kořenovník</h1>
<br>
<table><thead>
<td>Tvar</td> <td>Vyznam</td>
</thead><tbody>
<?php
foreach($dictEntry->fetchAll() as $row){
    echo '<tr><td>';
    echo $row['tvar'].TD.$row['vyznam'];
    echo '</td></tr>';
}
?>
</tbody>
</table>

<?php include '../include/_footer.php'; ?>
