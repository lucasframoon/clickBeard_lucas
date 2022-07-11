<?php

include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/BaseDAO.php');
include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/model/Attendance.php');

class AttendanceDAO extends BaseDAO
{

	public function __construct()
	{
		$this->connection = DBControl::getConnection();
	}

	public function getAttendances()
	{
		return parent::getListCast('SELECT * 
									FROM attendance 
									WHERE dt_attendance < SYSDATE() 
									AND ck_active = 1');
	}

	public function getAttendance($idAttendance)
	{
		return parent::getItemCastParam('SELECT * FROM attendance WHERE id_attendance = :id_attendance ', array(':id_attendance' => $idAttendance));
	}

	public function getAllAttendanceNotAvailableTime($dtAttendance, $idBarber)
	{

		$dtAttendanceInitial = $dtAttendance . " 08:00:00";
		$dtAttendanceFinal = $dtAttendance . " 18:00:00";

		return parent::getListCastParam(
			"SELECT * 
			FROM attendance 
			WHERE ck_active = 1
			AND id_barber = :id_barber
			AND dt_attendance BETWEEN :dt_attendance_initial AND :dt_attendance_final ",
			array(
				':dt_attendance_initial' => $dtAttendanceInitial,
				':dt_attendance_final' => $dtAttendanceFinal,
				':id_barber' => $idBarber
			)
		);
	}


	public function getAttendancesByWhere($where)
	{
		return parent::getListCast("SELECT * 
									FROM attendance 
									WHERE dt_attendance < SYSDATE() $where");
	}

	public function insert(\Attendance $attendance)
	{
		$id = parent::insertItem(
			'INSERT INTO attendance (
										id_barber,
										-- id_specialty,
										dt_attendance
											) VALUES (:id_barber,
														-- :id_specialty,
														:dt_attendance)',
			array(
				':id_barber' => $attendance->getIdBarber(),
				// ':id_specialty' => $attendance->getIdSpecialty(),
				':dt_attendance' => $attendance->getDtAttendance()
			)
		);

		if ($id) {
			$attendance = $this->getAttendance($id);
		}

		return $attendance;
	}

	public function update(\Attendance $attendance)
	{
		parent::updateItem(
			'UPDATE attendance SET 
									 id_barber = :id_barber, 
									--  id_specialty = :id_specialty,
									 dt_attendance = :dt_attendance
										 WHERE id_attendance = :id_attendance',
			array(
				':id_barber' => $attendance->getIdBarber(),
				// ':id_specialty' => $attendance->getIdSpecialty(),
				':dt_attendance' => $attendance->getDtAttendance(),
				':id_attendance' => $attendance->getIdAttendance()
			)
		);

		$attendance = $this->getAttendance($attendance->getIdAttendance());

		return $attendance;
	}

	public function delete($idAttendance)
	{
		$count = parent::deleteItem('DELETE FROM attendance WHERE id_attendance = :id_attendance ', array(':id_attendance' => $idAttendance));

		return $count > 0;
	}

	protected function processRow($rs)
	{

		$attendance = new Attendance($rs);

		return $attendance;
	}
}
