<?php

include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/BaseDAO.php');
include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/model/Barber.php');

class BarberDAO extends BaseDAO
{

	public function __construct()
	{
		$this->connection = DBControl::getConnection();
	}

	public function getBarbers()
	{
		return parent::getListCast('SELECT * FROM barber ORDER BY nm_barber');
	}

	public function getBarbersBySpecialtys($idsSpecialtys)
	{
		$sql = "SELECT DISTINCT b.* 
				FROM barber b, barber_specialty bs
				WHERE b.id_barber = bs.id_barber 
					AND bs.id_specialty IN (" . $idsSpecialtys . ") ORDER BY b.nm_barber ";
		return parent::getListCast($sql);
	}

	public function getBarber($idBarber)
	{
		return parent::getItemCastParam('SELECT * FROM barber WHERE id_barber = :id_barber ORDER_BY nm_barber', array(':id_barber' => $idBarber));
	}

	public function getBarbersByWhere($where)
	{
		return parent::getListCast("SELECT * FROM barber WHERE 1=1 $where ORDER BY nm_barber");
	}

	public function insert(\Barber $barber)
	{
		$id = parent::insertItem(
			'INSERT INTO barber (
										nm_barber,
										dt_birthday,
										dt_contract
											) VALUES (:nm_barber,
														:dt_birthday,
														:dt_contract)',
			array(
				':nm_barber' => $barber->getNmBarber(),
				':dt_birthday' => $barber->getDtBirthday(),
				':dt_contract' => $barber->getDtContract()
			)
		);

		if ($id) {
			$barber = $this->getBarber($id);
		}


		return $barber;
	}

	public function update(\Barber $barber)
	{
		parent::updateItem(
			'UPDATE barber SET 
									 nm_barber = :nm_barber, 
									 dt_birthday = :dt_birthday, 
									 dt_contract = :dt_contract
										 WHERE id_barber = ?',
			array(
				':nm_barber' => $barber->getNmBarber(),
				':dt_birthday' => $barber->getDtBirthday(),
				':dt_contract' => $barber->getDtContract(),
				':id_barber' => $barber->getIdBarber()
			)
		);

		$barber = $this->getBarber($barber->getIdBarber());


		return $barber;
	}

	public function delete($idBarber)
	{
		$count = parent::deleteItem('DELETE FROM barber WHERE id_barber = :id_barber ', array(':id_barber' => $idBarber));


		return $count > 0;
	}

	protected function processRow($rs)
	{

		$barber = new Barber($rs);

		return $barber;
	}
}
