<?PHP
session_start();

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => '',
		'db' => 'travis_login'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	)
);

spl_autoload_register(function($class) {
	require_once 'classes/' . $class . '.php';
});

require_once 'functions/sanitize.php';
$user = new User();

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
	//echo "user asked to be remembered";

	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));
	
	//print_r($hashCheck);

	if($hashCheck->count()) {
		//echo "Hash Matches, log user in!";
		//echo $hashCheck->first()->user_id;
		
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}
}
?>