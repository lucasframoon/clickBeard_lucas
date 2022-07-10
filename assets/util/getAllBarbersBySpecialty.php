<?php

include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/BarberDAO.php');

header("Content-Type: application/json");

$ids = filter_var(filter_input(INPUT_POST, 'ids'));

if ($ids == null) {
    echo json_encode(['STATUS' => 'EMPTY', 'RESULT' => null, JSON_PRETTY_PRINT]);
    exit;
}

try {
    $result = (new BarberDAO())->getBarbersBySpecialtys($ids);

    echo json_encode(['STATUS' => 'OK', 'RESULT' => $result, JSON_PRETTY_PRINT]);
} catch (\Exception $e) {
    echo json_encode(['STATUS' => 'ERROR', 'ERROR_MESSAGE' => $e->getMessage(), 'ERROR' => $e, JSON_PRETTY_PRINT]);
}
