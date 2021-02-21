<?php
namespace App\Model;
use Nette;
use Nette\Security\SimpleIdentity;
use Nette\Database\Context;
use Nette\Database\Explorer;
use Nette\Security\User;
use Nette\Utils\Validators;

class FormValidate
{
	public static function validateEmail(Control $control): bool
	{
		return Validators::isEmail((string) $control->getValue());
	}

}
?>