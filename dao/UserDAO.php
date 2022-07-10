<?php

include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dao/BaseDAO.php');
include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/model/User.php');

class UserDAO extends BaseDAO
{

	public function __construct()
	{
		$this->connection = DBControl::getConnection();
	}

	public function getUsers()
	{
		return parent::getListCast('SELECT * FROM user');
	}

	public function getUser($idUser)
	{
		return parent::getItemCastParam('SELECT * FROM user WHERE id_user = :id_user ', array(':id_user' => $idUser));
	}

	public function getUserByWhere($where)
	{
		return parent::getListCast("SELECT * FROM user WHERE 1=1 $where");
	}

	public function insert(\User $user)
	{
		$id = parent::insertItem(
			'INSERT INTO user (
										nm_user,
										ds_email,
										ds_login,
										tp_user
											) VALUES (:nm_user,
														:ds_email,
														:ds_login,
														:tp_user)',
			array(
				':nm_user' => $user->getNmUser(),
				':ds_email' => $user->getDsEmail(),
				':ds_login' => $user->getDsLogin(),
				':tp_user' => $user->getTpUser()
			)
		);

		if ($id) {
			$user = $this->getUser($id);
		}

		return $user;
	}

	public function update(\User $user)
	{
		parent::updateItem(
			'UPDATE user SET 
									 nm_user = :nm_user, 
									 ds_email = :ds_email, 
									 ds_login = :ds_login, 
									 tp_user = :tp_user
										 WHERE id_user = ?',
			array(
				':nm_user' => $user->getNmUser(),
				':ds_email' => $user->getDsEmail(),
				':ds_login' => $user->getDsLogin(),
				':tp_user' => $user->getTpUser(),
				':id_user' => $user->getIdUser()
			)
		);

		$user = $this->getUser($user->getIdUser());

		return $user;
	}

	public function delete($idUser)
	{
		$count = parent::deleteItem('DELETE FROM user WHERE id_user = :id_user ', array(':id_user' => $idUser));

		return $count > 0;
	}

	protected function processRow($rs)
	{

		$user = new User($rs);

		return $user;
	}
}
