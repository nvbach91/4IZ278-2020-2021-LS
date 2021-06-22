<?php
include '../include/_dbConnect.php';
const TD = '</td><td>';

// very exquisite
$thesaurus = $pdo->prepare("
    SELECT Antosynonymum.souhlasky1, Antosynonymum.souprava1,
            Koren1.delka delka1, Puvod1.jazyk jazyk1, Puvod1.prepis prepis1,
            Puvod1.slovo slovo1, Antosynonymum.typ, Antosynonymum.souhlasky2,
            Antosynonymum.souprava2, Koren2.delka delka2, Puvod2.jazyk jazyk2,
            Puvod2.prepis prepis2, Puvod2.slovo slovo2
    FROM Antosynonymum JOIN Koren Koren1 ON (
                Antosynonymum.souhlasky1 = Koren1.souhlasky 
                AND Antosynonymum.souprava1 = Koren1.souprava
            )           
            JOIN VstupSlovniku VstupSlovniku1 ON (
                Antosynonymum.souhlasky1 = VstupSlovniku1.souhlasky
                AND Antosynonymum.souprava1 = VstupSlovniku1.souprava
            ) JOIN Puvod Puvod1 ON (
                VstupSlovniku1.jazyk = Puvod1.jazyk 
                AND VstupSlovniku1.prepis = Puvod1.prepis
            )

            JOIN Koren Koren2 ON (
                Antosynonymum.souhlasky2 = Koren2.souhlasky 
                AND Antosynonymum.souprava2 = Koren2.souprava
            )
            JOIN VstupSlovniku VstupSlovniku2 ON (
            Antosynonymum.souhlasky2 = VstupSlovniku2.souhlasky
            AND Antosynonymum.souprava2 = VstupSlovniku2.souprava
            ) JOIN Puvod Puvod2 ON (
                VstupSlovniku2.jazyk = Puvod2.jazyk 
                AND VstupSlovniku2.prepis = Puvod2.prepis
            )
;
");
$thesaurus->execute();

?>

<?php include '../include/_header.php'; ?>

<h1>Thesaurus</h1>
<br>
<table><thead>
<td>Souhlásky 1</td> <td>Souprava 1</td> <td>Jazyk 1</td> <td>Slovo 1</td> <td>Přepis 1</td>
<td>Typ</td>
<td>Souhlásky 2</td> <td>Souprava 2</td> <td>Jazyk 2</td> <td>Slovo 2</td> <td>Přepis 2</td>
</thead><tbody>
<?php
foreach($thesaurus->fetchAll() as $row){
    echo '<tr><td>';
    echo $row['souhlasky1'].TD.$row['souprava1'].TD.$row['jazyk1'].TD.$row['prepis1'].TD.$row['slovo1'].TD
        .$row['typ'].TD
        .$row['souhlasky2'].TD.$row['souprava2'].TD.$row['jazyk2'].TD.$row['prepis2'].TD.$row['slovo2'];
    echo '</td></tr>';
}
?>
</tbody>
</table>

<?php include '../include/_footer.php'; ?>

