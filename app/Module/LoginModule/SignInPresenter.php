<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\Authentication;
use Nette\Security\User;

class SignPresenter extends Nette\Application\UI\Presenter
{
   	private Authentication $authenticator;

   	public function __construct(Authentication $authenticator)
	{
		$this->authenticator = $authenticator;
	}

	protected function createComponentSignInForm(): Form
	{
		$form = new Form;
		$form->addText('username', 'Uživatelské jméno:');
		$form->addPassword('password', 'Heslo:');
		$form->addSubmit('send', 'Přihlásit');

		$form->onSuccess[] = [$this, 'signInFormSucceeded'];
		return $form;
	}

	public function signInFormSucceeded(Form $form, \stdClass $values): void
	{
		try {
           
        $user = $this->getUser();
		$user->authenticator->authenticate($values->username, $values->password);
		$user->login($values->username, $values->password);
			
		 
		$this->redirect('Homepage:');
	
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError("Nesprávné přihlašovací jméno nebo heslo.");
        
		}
	}

	public function actionOut(): void
	{
		$this->getUser()->logout();
		$this->flashMessage('Odhlášení bylo úspěšné.');
		$this->redirect('Homepage:');
	}
}
?>