<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/AttendanceDAO.php');

header("Content-Type: application/json");

$rawDtAttendance = filter_var(filter_input(INPUT_POST, 'rawDtAttendance')); //'10/07/2022'
$idBarber = filter_var(filter_input(INPUT_POST, 'idBarber'), FILTER_SANITIZE_NUMBER_INT);

$rawDtAttendance = new DateTime($rawDtAttendance);
$dtAttendance = date_format($rawDtAttendance, "Y-m-d"); //'2022-01-01';

$notAvaliableTimes = [];
$listTimes = [
    '08:00:00',
    '08:30:00',
    '09:00:00',
    '09:30:00',
    '10:00:00',
    '10:30:00',
    '11:00:00',
    '11:30:00',
    '12:00:00',
    '12:30:00',
    '13:00:00',
    '13:30:00',
    '14:00:00',
    '14:30:00',
    '15:00:00',
    '15:30:00',
    '16:00:00',
    '16:30:00',
    '17:00:00',
    '17:30:00',
    '18:00:00'
];

try {

    $result = (new AttendanceDAO())->getAllAttendanceAvailableTime($dtAttendance, $idBarber);

    foreach ($result as $key => $notAvaliableTime) {
        $notAvaliableTimeSplit = explode(' ', $notAvaliableTime->getDtAttendance());
        $notAvaliableTimes = $notAvaliableTimeSplit[1]; //'08:00:00'
    }

    $avaliableTimes = array_diff($listTimes, $notAvaliableTimes);

    echo json_encode(['STATUS' => 'OK', 'RESULT' => $avaliableTimes, JSON_PRETTY_PRINT]);
} catch (\Exception $e) {

    echo json_encode(['STATUS' => 'ERROR', 'ERROR_MESSAGE' => $e->getMessage(), 'ERROR' => $e, JSON_PRETTY_PRINT]);
}
