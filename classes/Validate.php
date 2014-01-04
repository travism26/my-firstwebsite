<?php

class Validate {
	
	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct(){
		$this->_db = DB::getInstance();
	}

	//depending on your application you might need more rules...etc.
	public function check($source, $items = array()){
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				//echo "{$item} {$rule} must be {$rule_value}<br>";//echo $value;
				$value = trim($source[$item]);
				$item = escape($item);
				
				if($rule === 'required' && empty($value)){
					$this->addError("{$item} is required");
				}else if (!empty($value)){
					switch($rule){
						case 'min':
							if(strlen($value) < $rule_value){
								$this->addError("{$item} must me a min of {$rule_value} characters");
							}
						break;
						case 'max':
							if(strlen($value) > $rule_value){
								$this->addError("{$item} must me a min of {$rule_value} characters");
							}	
						break;
						case 'matches':
							if($value != $source[$rule_value]){
								$this->addError("{$rule_value} must match {$item}");
							}	
						break;
						case 'unique':
							//print_r($item);
							//print_r($value);
							//print_r($check = $this->_db->get($rule_value, array('$item', '=', $value)));
							$check = $this->_db->get($rule_value, array($item, '=', $value));
							if($check->count()) {
								$this->addError("{$item} already exist");
							}
						break;
					}//switch

				}
			}
		}
		if(empty($this->_errors)){
			$this->_passed = true;
		}
		return $this;
	}
	public function addError($error){
		$this->_errors[] = $error;
	}
	public function errors(){
		return $this->_errors;
	}
	public function passed(){
		return $this->_passed;
	}
}