<?php
namespace App\Presenters;


use Nette;
use Nette\Application\UI\Form;
use Nette\Utils\Html;
use Tracy\Debugger;
use Tracy\Dumper;

class RegPresenter extends Nette\Application\UI\Presenter
{
    protected function createComponentRegInForm(): Form
	{
    $form->addText('username', 'Your username:')
	->setRequired('Enter your username');


    $form->addPassword('password', 'Choose password:')
	->setRequired('Choose your password')
	->addRule($form::MIN_LENGTH, 'The password is too short: it must be at least %d characters', 3);

   $form->addPassword('password2', 'Reenter password:')
	->setRequired('Reenter your password')
	->addRule($form::EQUAL, 'Passwords do not match', $form['password']);

    $form->addEmail('email', 'email')
	->setRequired('enter email')
	->addRule($form::EMAIL);
    }

}
?>