<?php

class Attendance implements JsonSerializable{
	
	protected $idAttendance;
	protected $idBarber;
	protected $dtAttendance;
	
	public function jsonSerialize() {
		return [
			"idAttendance" => (string) $this->idAttendance,
			"idBarber" => (string) $this->idBarber,
			"dtAttendance" => (string) $this->dtAttendance
		];
	}
	
	public function __construct($data = null)
	{
		if (is_array($data))
		{
			$this->idAttendance = $data['id_attendance'];
			$this->idBarber = $data['id_barber'];
			$this->dtAttendance = $data['dt_attendance'];
		}
	}
	
	public function getIdAttendance(){
		return $this->idAttendance;
	}
	
	public function setIdAttendance($idAttendance){
		$this->idAttendance = $idAttendance;
	}
	
	public function getIdBarber(){
		return $this->idBarber;
	}
	
	public function setIdBarber($idBarber){
		$this->idBarber = $idBarber;
	}
	
	public function getDtAttendance(){
		return $this->dtAttendance;
	}
	
	public function setDtAttendance($dtAttendance){
		$this->dtAttendance = $dtAttendance;
	}
	
}
