<?php

include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/AttendanceDAO.php');

header("Content-Type: application/json");

$rawDtAttendance = filter_var(filter_input(INPUT_POST, 'dtAttendance')); //'10/07/2022'
$hourAttendance = filter_var(filter_input(INPUT_POST, 'hourAttendance')); //'08:00'
$idBarber = filter_var(filter_input(INPUT_POST, 'idBarber'), FILTER_SANITIZE_NUMBER_INT);

if ($idBarber == null || $hourAttendance == null || $dtAttendance == null) {
    echo json_encode(['STATUS' => 'EMPTY', 'RESULT' => null, JSON_PRETTY_PRINT]);
    exit;
}

$dtAttendance = date_format($rawDtAttendance, "Y-m-d"); //'2022-01-01';

$attendance = new Attendance();
$attendance->setDtAttendance($dtAttendance . $hourAttendance . ":00");
$attendance->setIdBarber($idBarber);

try {
    $result = (new AttendanceDAO())->insert($attendance);

    echo json_encode(['STATUS' => 'OK', 'RESULT' => $result, JSON_PRETTY_PRINT]);
} catch (\Exception $e) {
    echo json_encode(['STATUS' => 'ERROR', 'ERROR_MESSAGE' => $e->getMessage(), 'ERROR' => $e, JSON_PRETTY_PRINT]);
}
