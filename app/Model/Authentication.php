<?php
namespace App\Model;
use Nette;
use Nette\Security\SimpleIdentity;
use Nette\Database\Context;
use Nette\Database\Explorer;
use Nette\Security\User;

class Authentication implements Nette\Security\Authenticator
{
	private $database;
	private $passwords;

	public function __construct(
		Nette\Database\Explorer $database,
		Nette\Security\Passwords $passwords
	) {
		$this->database = $database;
		$this->passwords = $passwords;
	}

	public function authenticate(string $username, string $password): SimpleIdentity
	{
		$row = $this->database->table('users')
			->where('username', $username)
			->fetch();
	
		if (!$row) {
			throw new Nette\Security\AuthenticationException('');
		}

		if (!$this->passwords->verify($password, $row->password)) {
			throw new Nette\Security\AuthenticationException("Invalid password");
		}

		return new SimpleIdentity(
			
			$row->id,
			$row->role, // can add more roles
			['name' => $row->username]
		
		);
	}
}
?>