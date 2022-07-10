<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/BarberDAO.php');

header("Content-Type: application/json");

try {
    $result = (new BarberDAO())->getBarbers();

    echo json_encode(['STATUS' => 'OK', 'RESULT' => $result, JSON_PRETTY_PRINT]);
} catch (\Exception $e) {
    echo json_encode(['STATUS' => 'ERROR', 'ERROR_MESSAGE' => $e->getMessage(), 'ERROR' => $e, JSON_PRETTY_PRINT]);
}
