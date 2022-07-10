<?php

class Specialty implements JsonSerializable{
	
	protected $idSpecialty;
	protected $nmSpecialty;
	
	public function jsonSerialize() {
		return [
			"idSpecialty" => (string) $this->idSpecialty,
			"nmSpecialty" => (string) $this->nmSpecialty
		];
	}
	
	public function __construct($data = null)
	{
		if (is_array($data))
		{
			$this->idSpecialty = $data['id_specialty'];
			$this->nmSpecialty = $data['nm_specialty'];
		}
	}
	
	public function getIdSpecialty(){
		return $this->idSpecialty;
	}
	
	public function setIdSpecialty($idSpecialty){
		$this->idSpecialty = $idSpecialty;
	}
	
	public function getNmSpecialty(){
		return $this->nmSpecialty;
	}
	
	public function setNmSpecialty($nmSpecialty){
		$this->nmSpecialty = $nmSpecialty;
	}
	
}

?>