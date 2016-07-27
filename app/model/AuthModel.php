<?php

/**
 * Description of AuthModel
 *
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 */
class AuthModel extends ViewModel {

    public function login() {
	if (isset($this->info['login'])) {
	    if (!empty($this->info['username']) && !empty($this->info['password'])) {
		//database authentication;
		$this->dbAuthentication();
	    } else {
		// username and password requir
		$this->content['error'] = "Username and Password is required";
	    }
	} else {
	    $this->content['error'] = "Form not submitted properly please try again";
	}
    }

    private function dbAuthentication() {
	try {
	    $this->setDB(new DB());
	    $sql = "SELECT * FROM users WHERE user_name = :user && password = SHA1(:pass)";
	    $this->results = $this->db->fetch($sql, array(':user' => $this->info['username'], ':pass' => $this->info['password']));
	    if ($this->results) {
		Session::setUserInfo($this->results);
		header("location: ../portal");
	    } else {
		$this->content['error'] = "Invalid login, please try again";
	    }
	} catch (Exception $e) {
	    $this->content['error'] = "Sorry cannot login at this time. ";
	    $this->content['error'].= Env::isDev() ? $e->getMessage() : "";
	}
    }

}
