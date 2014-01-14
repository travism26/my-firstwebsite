<?php
class User{
	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;

	public function __construct($user = null){
		$this->_db = DB::getInstance();

		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');

		if(!$user){
			if (Session::exists($this->_sessionName)) {
				$user = Session::get($this->_sessionName);
				//echo $user;

				if ($this->find($user)) {
					$this->_isLoggedIn = true;
				} else {
					//process logout
				}
			} 

		}else {
				$this->find($user);
		}
	}

	public function update($fields = array(), $id = null){
		if(!$id && $this->isLoggedIn()){
			$id = $this->data()->id;
		}
		if(!$this->_db->update('users', $id, $fields)){
			throw new Exception("Error Processing Request");
		}
	}
	public function create($fields = array()){
		if(!$this->_db->insert('users', $fields)){
			throw new Exception("this was an error while registering a user");	
		}
	}

	public function createPost($fields = array()){
		if(!$this->_db->insert('post', $fields)){
			throw new Exception("this was an error while registering a user");	
		}
	}

	public function find($user = null){
		if($user){
			$field = (is_numeric($user)) ? 'id' : 'username';
			$data = $this->_db->get('users', array($field, '=', $user));

			if($data->count()){
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function login($username = null, $password = null, $remember = false){
		//echo !$username;
		//echo !$password;
		//echo !$remember;
		//echo $this->exists();
		
		if (!$username && !$password && $this->exists()) {
			//echo "Check";
			Session::put($this->_sessionName, $this->data()->id);

		} else {
			//echo "Check else";
			$user = $this->find($username);

			if($user){
				if($this->data()->password === Hash::make($password, $this->data()->salt)){
					//echo 'OK';
					Session::put($this->_sessionName, $this->data()->id);

					if($remember){
						$hash = Hash::unique();
						$hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));

						//print_r($hashCheck);
						//print_r($hash);

						if(!$hashCheck->count()){ 
							$this->_db->insert('users_session', array(
								'user_id' => $this->data()->id,
								'hash' => $hash 
							));
						} else {
							$hash = $hashCheck->first()->hash;
						}
						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
					}
					return true;
				}
			}
		}
		return false;
	}

	public function hasPermission($key) {
		$group = $this->_db->get('groups', array('id', '=', $this->data()->group));
		//print_r($group->first());

		if($group->count()){
			$permissions = json_decode($group->first()->permissions, true);
			//print_r($permissions);

			if ($permissions[$key] == true) {
				return true;
			}
		}
		return false;
	}

	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}
	public function data(){
		return $this->_data;
	}
	public function isLoggedIn(){
		return $this->_isLoggedIn;
	}
	public function logout(){
		$this->_db->delete('users_session', array('user_id', '=', $this->data()->id));
		echo 'users_session', array('user_id', '=', $this->data()->id);
		//die();
		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}
	
}

?>