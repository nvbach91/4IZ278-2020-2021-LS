<?php
session_start();

require_once __DIR__ . '/lib/WorkplaceDB.php';
require __DIR__ . '/adminRequired.php';

$workplaceDB = new WorkplaceDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $workplace = $workplaceDB->fetchById($_GET['ws_id']);
    
    if ($workplace['active'] == 0) {
        $change_active = $workplaceDB->updateActive($workplace['ws_id'], 1);
    } else {
        $change_active = $workplaceDB->updateActive($workplace['ws_id'], 0);

    }

    header('Location: workplaces.php');
}
