<?php
include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/BarberDAO.php');
// include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/SpecialtyDAO.php');

class Attendance implements JsonSerializable
{

	protected $idAttendance;
	protected $idBarber;
	// protected $idSpecialty;
	protected $dtAttendance;
	protected $ckActive;

	private $_barber;
	// private $_specialty;

	public function jsonSerialize()
	{
		return [
			"idAttendance" => (string) $this->idAttendance,
			"idBarber" => (string) $this->idBarber,
			"dtAttendance" => (string) $this->dtAttendance,
			// "idSpecialty" => (string) $this->idSpecialty,
			"ckActive" => (string) $this->ckActive,
			"barber" => $this->getBarber(),
			// "specialty" => $this->getSpecialty()


		];
	}

	public function __construct($data = null)
	{
		if (is_array($data)) {
			$this->idAttendance = $data['id_attendance'];
			$this->idBarber = $data['id_barber'];
			// $this->idSpecialty = $data['id_specialty'];
			$this->dtAttendance = $data['dt_attendance'];
			$this->ckActive = $data['ck_active'];
		}
	}

	public function getIdAttendance()
	{
		return $this->idAttendance;
	}

	public function setIdAttendance($idAttendance)
	{
		$this->idAttendance = $idAttendance;
	}

	public function getIdBarber()
	{
		return $this->idBarber;
	}

	public function setIdBarber($idBarber)
	{
		$this->idBarber = $idBarber;
	}

	public function getDtAttendance()
	{
		return $this->dtAttendance;
	}

	public function setDtAttendance($dtAttendance)
	{
		$this->dtAttendance = $dtAttendance;
	}

	public function getIdSpecialty()
	{
		return $this->idSpecialty;
	}

	public function setIdSpecialty($idSpecialty)
	{
		$this->idSpecialty = $idSpecialty;

		return $this;
	}

	// public function getSpecialty()
	// {
	// 	if ($this->getIdSpecialty() != null) {
	// 		$this->_specialty = (new SpecialtyDAO())->getSpecialty($this->getIdSpecialty());
	// 		return $this->_specialty;
	// 	} else {
	// 		return new Specialty();
	// 	}
	// }

	public function getBarber()
	{
		if ($this->getIdBarber() != null) {
			$this->_barber = (new BarberDAO())->getBarber($this->getIdBarber());
			return $this->_barber;
		} else {
			return new Barber();
		}
	}

	public function getCkActive()
	{
		return $this->ckActive;
	}

	public function setCkActive($ckActive)
	{
		$this->ckActive = $ckActive;

		return $this;
	}
}
