<?php

class User implements JsonSerializable{
	
	protected $idUser;
	protected $nmUser;
	protected $dsEmail;
	protected $dsLogin;
	protected $tpUser;
	
	public function jsonSerialize() {
		return [
			"idUser" => (string) $this->idUser,
			"nmUser" => (string) $this->nmUser,
			"dsEmail" => (string) $this->dsEmail,
			"dsLogin" => (string) $this->dsLogin,
			"tpUser" => (string) $this->tpUser
		];
	}
	
	public function __construct($data = null)
	{
		if (is_array($data))
		{
			$this->idUser = $data['id_user'];
			$this->nmUser = $data['nm_user'];
			$this->dsEmail = $data['ds_email'];
			$this->dsLogin = $data['ds_login'];
			$this->tpUser = $data['tp_user'];
		}
	}
	
	
	public function getIdUser(){
		return $this->idUser;
	}
	
	public function setIdUser($idUser){
		$this->idUser = $idUser;
	}
	
	public function getNmUser(){
		return $this->nmUser;
	}
	
	public function setNmUser($nmUser){
		$this->nmUser = $nmUser;
	}
	
	public function getDsEmail(){
		return $this->dsEmail;
	}
	
	public function setDsEmail($dsEmail){
		$this->dsEmail = $dsEmail;
	}
	
	public function getDsLogin(){
		return $this->dsLogin;
	}
	
	public function setDsLogin($dsLogin){
		$this->dsLogin = $dsLogin;
	}
	
	public function getTpUser(){
		return $this->tpUser;
	}
	
	public function setTpUser($tpUser){
		$this->tpUser = $tpUser;
	}
	
}
