<?php

namespace virtualwonders\piwikvw;


class PiwikUsersManager extends PiwikAPI 
{
    /**
     * @return mixed
     */
	public function getUsers()
	{
		return $this->request(parent::USERS_MANAGER . parent::GET_USER);
	}

    /**
     * @return mixed
     */
	public function getUsersLogin()
	{	
		return $this->request(parent::USERS_MANAGER . parent::GET_USERS_LOGIN);
	}

    /**
     * @param $login
     * @return mixed
     */
	public function getUser($login)
	{
		return $this->request(parent::USERS_MANAGER . parent::GET_USER, ['userLogin' => $login]);
	}

    /**
     * @param $email
     * @return mixed
     */
	public function getUserByEmail($email)
	{
		return $this->request(parent::USERS_MANAGER . parent::GET_USER_BY_EMAIL, ['userEmail' => $email]);
	}

    /**
     * @param $login
     * @param $password
     * @param $email
     * @param string $alias
     * @return mixed
     */
	public function addUser($login, $password, $email, $alias = '')
	{
		$params = [
			'userLogin' => $login,			
			'password' => $password,
			'email' => $email,			
			'alias' => $alias,
        ];

		return $this->request(parent::USERS_MANAGER . parent::ADD_USER, $params);
	}

    /**
     * @param $login
     * @param string $password
     * @param string $email
     * @param string $alias
     * @return mixed
     */
	public function updateUser($login, $password = '', $email = '', $alias = '')
	{
		$params = [
			'userLogin' => $login,			
			'password' => $password,
			'email' => $email,			
			'alias' => $alias,
        ];

		return $this->request(parent::USERS_MANAGER . parent::UPDATE_USER, $params);
	}

    /**
     * @param $login
     * @return mixed
     */
	public function deleteUser($login)
	{
		return $this->request(parent::USERS_MANAGER . parent::DELETE_USER, ['userLogin' => $login]);
	}

    /**
     * @param $login
     * @return mixed
     */
	public function userExists($login)
	{
		return $this->request(parent::USERS_MANAGER . parent::USER_EXISTS, ['userLogin' => $login]);
	}

    /**
     * @param $email
     * @return mixed
     */
	public function userEmailExists($email)
	{
		return $this->request(parent::USERS_MANAGER . parent::USER_EMAIL_EXISTS, ['userEmail' => $email]);
	}

    /**
     * @param $login
     * @param $password
     * @return mixed
     */
	public function getTokenAuth($login, $password)
	{
		$params = [
			'userLogin' => $login,
			'md5Password' => md5($password),
        ];

		return $this->request(parent::USERS_MANAGER . parent::GET_TOKEN_AUTH, $params);
	}

    /**
     * @param $login
     * @param $password
     * @return mixed
     */
	public function getTokenAuthMD5($login, $password)
	{
		$params = [
			'userLogin' => $login,
			'md5Password' => $password,
        ];

		return $this->request(parent::USERS_MANAGER . parent::GET_TOKEN_AUTH, $params);
	}

    /**
     * @param $login
     * @param $access
     * @param $siteId
     * @return mixed
     */
	public function setUserAccess($login, $access, $siteId)
	{
		$params = [
			'userLogin' => $login,
			'access' => $access,
			'idSites' => $siteId
        ];

		return $this->request(parent::USERS_MANAGER . parent::SET_USER_ACCESS, $params);
	}

    /**
     * @param $siteId
     * @param $access
     * @return mixed
     */
	public function getUsersWithSiteAccess($siteId, $access)
	{
		$params = [
			'idSite' => $siteId,
			'access' => $access
        ];

		return $this->request(parent::USERS_MANAGER . parent::GET_USERS_WITH_SITE_ACCESS, $params);
	}

    /**
     * @param $access
     * @return mixed
     */
	public function getUsersSitesFromAccess($access)
	{
		$params = ['access' => $access];

		return $this->request(parent::USERS_MANAGER . parent::GET_USERS_SITES_FROM_ACCESS, $params);
	}

    /**
     * @param $login
     * @return mixed
     */
	public function getSitesAccessFromUser($login)
	{
		$params = ['userLogin' => $login];

		return $this->request(parent::USERS_MANAGER . parent::GET_SITES_ACCESS_FROM_USER, $params);
	}

    /**
     * @param $siteId
     * @return mixed
     */
	public function getUsersAccessFromSite($siteId)
	{
		$params = ['idSite' => $siteId];

		return $this->request(parent::USERS_MANAGER . parent::GET_USERS_ACCESS_FROM_SITE, $params);
	}
}

