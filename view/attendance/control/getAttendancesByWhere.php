<?php

include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/AttendanceDAO.php');

header("Content-Type: application/json");

$rawDtInitial = filter_var(filter_input(INPUT_POST, 'dtInitial'));
$rawDtFinal = filter_var(filter_input(INPUT_POST, 'dtFinal'));
$nmBarber = filter_var(filter_input(INPUT_POST, 'nmBarber'));
$nmSpecialty = filter_var(filter_input(INPUT_POST, 'nmSpecialty'));
$where = " AND ck_active = 1 ";

if ($rawDtInitial != null) {
    $rawDtInitial = date_create($rawDtInitial);
    $dtInitial = date_format($rawDtInitial, "Y-m-d");
    $where .= " AND a.dt_attendance >= '$dtInitial 08:00:00' ";
}

if ($rawDtFinal != null) {
    $rawDtFinal = date_create($rawDtFinal);
    $dtFinal = date_format($rawDtFinal, "Y-m-d");
    $where .= " AND a.dt_attendance <= '$dtFinal 18:00:00' ";
}

if ($nmBarber != null) {
    $where .= " AND id_barber IN (SELECT id_barber FROM barber WHERE upper(nm_barber) LIKE upper('%$nmBarber%')) ";
}

if ($nmSpecialty != null) {
    $where .= " AND id_specialty IN (SELECT id_specialty FROM specialty WHERE upper(nm_specialty) LIKE upper('%$nmSpecialty%')) ";
}

try {

    $result = (new AttendanceDAO())->getAttendancesByWhere($where);

    echo json_encode(['STATUS' => 'OK', 'RESULT' => $result, "where" => $where, JSON_PRETTY_PRINT]);
} catch (\Exception $e) {

    echo json_encode(['STATUS' => 'ERROR', 'ERROR_MESSAGE' => $e->getMessage(), 'ERROR' => $e, "where" => $where, JSON_PRETTY_PRINT]);
}
