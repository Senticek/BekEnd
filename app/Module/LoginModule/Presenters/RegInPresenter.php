<?php
namespace App\Presenters;


use Nette;
use Nette\Application\UI\Form;
use Nette\Utils\Html;
use Tracy\Debugger;
use Tracy\Dumper;
use Nette\Security\Passwords;
use Nette\Database\Explorer;

class RegPresenter extends Nette\Application\UI\Presenter
{
    private 


    protected function createComponentRegInForm(): Form
	{
        $form = new form;
    $form->addText('username', 'Your username:')
	->setRequired('Enter your username');


    $form->addPassword('password', 'Choose password:')
	->setRequired('Choose your password')
	->addRule($form::MIN_LENGTH, 'The password is too short: it must be at least %d characters', 5);

   $form->addPassword('password2', 'Reenter password:')
	->setRequired('Reenter your password')
	->addRule($form::EQUAL, 'Passwords do not match', $form['password']);

    $form->addEmail('email', 'email')
	->setRequired('enter email')
	->addRule($form::EMAIL);

    $form->addSubmit('send', 'Přihlásit');


    return $form;
    }

    public function signInFormSucceeded(Form $form, \stdClass $values): void
	{

        
		
		try {
           // $this->getUser()->login($values->username, $values->password);
           
		 
		   $this->authenticator->authenticate($values->username, $values->password);
	
			$this->redirect('Homepage:');
	
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError("Nesprávné přihlašovací jméno nebo heslo.{$row->password}");
        
		}
	}

}
?>