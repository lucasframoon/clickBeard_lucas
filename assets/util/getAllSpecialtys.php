<?php

include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/SpecialtyDAO.php');

header("Content-Type: application/json");

try {
    $result = (new SpecialtyDAO())->getSpecialtys();

    echo json_encode(['STATUS' => 'OK', 'RESULT' => $result, JSON_PRETTY_PRINT]);
} catch (\Exception $e) {
    echo json_encode(['STATUS' => 'ERROR', 'ERROR_MESSAGE' => $e->getMessage(), 'ERROR' => $e, JSON_PRETTY_PRINT]);
}
