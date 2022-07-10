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
		return parent::getListCast('SELECT * FROM attendance');
	}

	public function getAttendance($idAttendance)
	{
		// select * from attendance a where dt_attendance BETWEEN '2022-07-10 08:00:00' AND '2022-07-10 17:00'
		return parent::getItemCastParam('SELECT * FROM attendance WHERE id_attendance = :id_attendance ', array(':id_attendance' => $idAttendance));
	}

	public function getAllAttendanceAvailableTime($dtAttendance, $idBarber)
	{

		$dtAttendanceInitial = $dtAttendance . " 08:00:00";
		$dtAttendanceFinal = $dtAttendance . " 18:00:00";

		return parent::getItemCastParam(
			"SELECT * 
			FROM attendance 
			WHERE id_barber = :id_barber
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
		return parent::getListCast('SELECT * FROM attendance WHERE 1=1 $where');
	}

	public function insert(\Attendance $attendance)
	{
		$id = parent::insertItem(
			'INSERT INTO attendance (
										id_barber,
										dt_attendance
											) VALUES (:id_barber,
														:dt_attendance)',
			array(
				':id_barber' => $attendance->getIdBarber(),
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
									 dt_attendance = :dt_attendance
										 WHERE id_attendance = ?',
			array(
				':id_barber' => $attendance->getIdBarber(),
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
