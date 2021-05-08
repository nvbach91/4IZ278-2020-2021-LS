<?php
include '_dbConnect.php';
const TD = '</td><td>';

$poctyKorenu = $pdo->prepare("SELECT souprava, count(souprava) pocet, min(delka) nejkratsi, avg(delka) prumernaDelka, max(delka) nejdelsi FROM Koren GROUP BY souprava ORDER BY souprava ASC");
$poctyKorenu->execute();

$poctyPuvodu = $pdo->prepare("SELECT jazyk, count(jazyk) pocet FROM Puvod GROUP BY jazyk");
$poctyPuvodu->execute();

$poctyOdvozenin = $pdo->prepare("SELECT souhlasky, souprava, count(tvar) pocet FROM Odvozenina GROUP BY souhlasky, souprava ORDER BY pocet DESC");
$poctyOdvozenin->execute();

?>

<?php include '_header.php'; ?>

<h1>Statistiky</h1>
<br>
<h2>Počty kořenů a jejich délka v každé soupravě</h2>
<br>
<table><thead>
<td>Souprava</td> <td>Počet kořenů</td> <td>Nejkratší</td> <td>Průměrná délka</td> <td>Nejdelší</td>
</thead><tbody>
<?php
foreach($poctyKorenu->fetchAll() as $row){
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
foreach($poctyPuvodu->fetchAll() as $row){
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
foreach($poctyKorenu->fetchAll() as $row){
    echo '<tr><td>';
    echo $row['souhlasky'].TD.$row['souprava'].TD.$row['pocet'];
    echo '</td></tr>';
}
?>
</tbody>
</table>

<?php include '_footer.php'; ?>
