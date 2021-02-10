<?php
namespace App\Model;

use Nette;
use Nette\Database\Context;
use Nette\Database\Explorer;
class Database
{
	use Nette\SmartObject;

	private Nette\Database\Explorer $database;
	private $passwords;
	private Authentication $authenticator;
	
	

	private $password;
	private $username;
	
	private $email;
	
	public function __construct(Nette\Database\Explorer $database,Nette\Security\Passwords $passwords,Authentication $authenticator)
	{
		$this->database = $database;
		$this->passwords = $passwords;
		$this->authenticator = $authenticator;
	}

	public function databaseInsert( \stdClass $values)
	{
		$row="";
		$username = $values->username;
		$password = $this->passwords->hash($values->password); 
		$email = $values->email;

		

		if(!$row = $this->database->table('users')->where('username',$username)->fetch() )
		{
			$row="";
		if(!$row = $this->database->table('users')->where('email',$email)->fetch()){
	
		$this->database->table('users')->insert([
			
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'role' => 'uzivatel',
		]);
		$this->authenticator->authenticate($username, $values->password);
		return "nic";
		}else{
			return "email";
		}
	
		}else{return "Jmeno";}
	
		
		
	}



}

?>