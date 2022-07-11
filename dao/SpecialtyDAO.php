<?php

include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/BaseDAO.php');
include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/model/Specialty.php');

class SpecialtyDAO extends BaseDAO
{

	public function __construct()
	{
		$this->connection = DBControl::getConnection();
	}

	public function getSpecialtys()
	{
		return parent::getListCast('SELECT * FROM specialty');
	}

	public function getSpecialty($idSpecialty)
	{
		return parent::getItemCastParam('SELECT * FROM specialty WHERE id_specialty = :id_specialty ', array(':id_specialty' => $idSpecialty));
	}

	public function getSpecialtysByBarber($idBarber)
	{
		return parent::getListCastParam(
			'SELECT * 
			FROM specialty 
			WHERE id_specialty IN (SELECT id_specialty FROM barber_specialty  WHERE :id_barber = :id_barber ) ',
			array(':id_barber' => $idBarber)
		);
	}

	public function getSpecialtysByWhere($where)
	{
		return parent::getListCast("SELECT * FROM specialty WHERE 1=1 $where");
	}

	public function insert(\Specialty $specialty)
	{
		$id = parent::insertItem(
			'INSERT INTO specialty (
										nm_specialty
											) VALUES (:nm_specialty)',
			array(
				':nm_specialty' => $specialty->getNmSpecialty()
			)
		);

		if ($id) {
			$specialty = $this->getSpecialty($id);
		}

		return $specialty;
	}

	public function update(\Specialty $specialty)
	{
		parent::updateItem(
			'UPDATE specialty SET 
									 nm_specialty = :nm_specialty
										 WHERE id_specialty = :id_specialty',
			array(
				':nm_specialty' => $specialty->getNmSpecialty(),
				':id_specialty' => $specialty->getIdSpecialty()
			)
		);

		$specialty = $this->getSpecialty($specialty->getIdSpecialty());

		return $specialty;
	}

	public function delete($idSpecialty)
	{
		$count = parent::deleteItem('DELETE FROM specialty WHERE id_specialty = :id_specialty ', array(':id_specialty' => $idSpecialty));

		return $count > 0;
	}

	protected function processRow($rs)
	{

		$specialty = new Specialty($rs);

		return $specialty;
	}
}
