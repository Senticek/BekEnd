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
	
	

	private $password;
	private $username;
	
	private $email;
	
	public function __construct(Nette\Database\Explorer $database,Nette\Security\Passwords $passwords)
	{
		$this->database = $database;
		$this->passwords = $passwords;
	}

	public function databaseInsert( \stdClass $values): void
	{

		$username = $values->username;
		$password = $this->passwords->hash($values->password); 
		$email = $values->email;

		
	
		$this->database->table('users')->insert([
			
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'role' => 'uzivatel',
		]);
	
	return;
		
	}



}

?>