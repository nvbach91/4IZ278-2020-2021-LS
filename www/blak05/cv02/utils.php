<?php
    function ageCount($bDate){
        $bday = new DateTime($bDate);
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        return ($diff->y);
    }
?>