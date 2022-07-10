<?php

include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/SpecialtyDAO.php');

class Barber implements JsonSerializable{
	
	protected $idBarber;
	protected $nmBarber;
	protected $dtBirthday;
	protected $dtContract;
	protected $dsImagePath;

	private $_specialty;
	
	public function jsonSerialize() {
		return [
			"idBarber" => (string) $this->idBarber,
			"nmBarber" => (string) $this->nmBarber,
			"dtBirthday" => (string) $this->dtBirthday,
			"dtContract" => (string) $this->dtContract,
			"dsImagePath" => (string) $this->dsImagePath,
			"specialty" => $this->getSpecialty()
		];
	}
	
	public function __construct($data = null)
	{
		if (is_array($data))
		{
			$this->idBarber = $data['id_barber'];
			$this->nmBarber = $data['nm_barber'];
			$this->dtBirthday = $data['dt_birthday'];
			$this->dtContract = $data['dt_contract'];
			$this->dsImagePath = $data['ds_image_path'];
		}
	}

		
	public function getIdBarber(){
		return $this->idBarber;
	}
	
	public function setIdBarber($idBarber){
		$this->idBarber = $idBarber;
	}
	
	public function getNmBarber(){
		return $this->nmBarber;
	}
	
	public function setNmBarber($nmBarber){
		$this->nmBarber = $nmBarber;
	}
	
	public function getDtBirthday(){
		return $this->dtBirthday;
	}
	
	public function setDtBirthday($dtBirthday){
		$this->dtBirthday = $dtBirthday;
	}
	
	public function getDtContract(){
		return $this->dtContract;
	}
	
	public function setDtContract($dtContract){
		$this->dtContract = $dtContract;
	}

	public function getDsImagePath()
	{
		return $this->dsImagePath;
	}
	
	public function setDsImagePath($dsImagePath)
	{
		$this->dsImagePath = $dsImagePath;

		return $this;
	}

	public function getSpecialty(){
		if($this->getIdBarber() != null) {
			$this->_specialty = (new SpecialtyDAO())->getSpecialtysByBarber($this->getIdBarber());
		return $this->_specialty;
		
		} else {		
		return new Specialty();
			
		}
	}
}
