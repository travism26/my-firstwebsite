<?PHP
class DB{
	private static $_instance = null;
	private $_pdo,//this is the object so we can use it
			$_query, //last query we did
			$_error = false, // just the set of error
			$_results, //store our results sets
			$_count = 0;//this is the count of resultes ie is there are resultes returned?

	private function __construct(){
		try {
			$this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname=' .Config::get('mysql/db'). '', Config::get('mysql/username'), Config::get('mysql/password'));
			//echo "Connected";
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance(){
		if (!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}
	public function query($sql, $params = array(), $username = null){
		$this->error = false;
		if($this->_query = $this->_pdo->prepare($sql)){
			//echo "Success";
			$x=1;
			if(count($params)){
				foreach ($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			//print_r($this->_query);
			//die();
			if ($this->_query->execute()) {
				//echo "Success";
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}else{
				$this->_error = true;
			}
		}
		if ($username !== null) {
			echo $username;
			die();
		}
		return $this;
	}

	public function action($action, $table, $where = array()) {
		if (count($where) ===3) {
			$operators = array('=', '>', '<', '>=', '<=', 'like');

			$field = $where[0];
			$operator = $where[1];
			$value = $where[2];

			if(in_array($operator, $operators)){
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}
			}
		}
	}

	public function get($table, $where){
		return $this->action('SELECT *', $table, $where);
	}
	public function delete($table, $where){
		return $this->action('DELETE', $table, $where);
	}
	public function insert($table, $fields = array()){
		if (count($fields)) {
			$keys = array_keys($fields);
			$values ='';
			$x = 1;

			foreach($fields as $field){
				$values .="?";
				if ($x < count($fields)) {
					$values .= ', ';
				}
				$x++;
			}

			$sql = "INSERT INTO {$table} (`". implode('`, `', $keys) ."`) VALUES ({$values})";
			if(!$this->query($sql, $fields)->error()){
				return true;
			}
			//echo $sql;
		}
		return false;
	}
	public function update($table, $id, $fields){
		$set = '';
		$x = 1;

		foreach($fields as $name => $value){
			$set .= "{$name} = ?";
			if($x < count($fields)){
				$set .= ', ';
			}
			$x++;
		}
		//die($set);
		$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

		if(!$this->query($sql, $fields)->error()){
			return true;
		}
		return false;
	}

		public function update_password($table, $fields, $where = array()){
		$set = '';
		$x = 1;

		$operators = array('=', '>', '<', '>=', '<=', 'like');
		//print_r($where);
		//die();
		$field = $where[0];
		$operator = $where[1];
		$value = $where[2];
		//$username = $where[2];
		//die();

		foreach($fields as $name => $value){
			$set .= "{$name} = {$value}";
			if($x < count($fields)){
				$set .= ', ';
			}
			//echo $set;
			$x++;
		}

		if(in_array($operator, $operators)){
			$sql = "UPDATE {$table} SET {$set} WHERE {$field} {$operator} ?";
			//echo $sql;
			//die();
			if(!$this->query($sql, array($value), $where[2])->error()) {
				return $this;
			}
		}


		//die($set);
		//$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

		//if(!$this->query($sql, $fields)->error()){
			//return true;
		//}
		//return false;
	}


		public function getSearch($table, $where){
		return $this->action('SELECT *', $table, $where);
	}

	public function results(){
		return $this->_results;
	}
	public function first(){
	$this->_first = $this->results();
	return $this->_first[0];
}
	public function error(){
		return $this->_error;
	}
	public function count(){
		return $this->_count;
	}
	public function fetchSingle(){
        return $this->_query->fetch(PDO::FETCH_OBJ);
    }

}

?>