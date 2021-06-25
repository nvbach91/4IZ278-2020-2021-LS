
<?php

// AJAX SERVER SIDE
require '../include/_scriptData.php';

// mb_str_split is in PHP 7.4
function utf8_str_split(string $input, int $splitLength = 1){
    $re = sprintf('/\\G.{1,%d}+/us', $splitLength);
    preg_match_all($re, $input, $m);
    return $m[0];
}


$sourceScriptName = $_GET['script'];
$sourceText = htmlspecialchars($_GET['text']);

echo '<table><thead><td>Písmo</td><td>Text</td></thead>';

if($sourceText){
    foreach($scriptNames as $curScriptName){
        if($curScriptName == $sourceScriptName) continue;
        echo "<tr><td>$curScriptName</td><td>";
        foreach(utf8_str_split($sourceText) as $curChar) {
            $curCharIndex = array_search($curChar, $scripts[$sourceScriptName]);
            echo $scripts[$curScriptName][$curCharIndex];        
        }
        echo "</td></tr>";
        
    }
}
echo '</table>';

echo '<br>';

// JSON at specific request (not that it would be exactly readable but anyway)
// {\n"latin":"abcd",\n "cyrillic": "абцд"}
echo "{\n\"Písmo\":\"Text\""; // need to deal with trailing comma
if($sourceText){
    foreach($scriptNames as $curScriptName){
        if($curScriptName == $sourceScriptName) continue;
        echo ",\n\"$curScriptName\": \"";
        foreach(utf8_str_split($sourceText) as $curChar) {
            $curCharIndex = array_search($curChar, $scripts[$sourceScriptName]);
            echo $scripts[$curScriptName][$curCharIndex];        
        }
        echo "\"";
        
    }
}
echo "\n}\n";


?>


