<?php
namespace App\Presenters;


use Nette;
use Nette\Application\UI\Form;
use Nette\Utils\Html;
use Tracy\Debugger;
use Tracy\Dumper;
use Nette\Security\Passwords;
use Nette\Database\Explorer;
use App\Model\Database;

class RegPresenter extends Nette\Application\UI\Presenter
{ 
    private Database $vlozit;
   


    public function __construct(Database $vlozit)
	{
		$this->vlozit = $vlozit;
	}

    protected function createComponentRegInForm(): Form
	{
        $values="";
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

    $form->addSubmit('send', 'Registrovat');
    $form->onSuccess[] = [$this, 'signInFormSucceeded'];


    return $form;
    }

    public function signInFormSucceeded(Form $form,\stdClass $values): void
	{
        $zprava="";
        
		$zprava = $this->vlozit->databaseInsert($values);
        sleep(1);
        $user = $this->getUser();
        $user->authenticator->authenticate($values->username, $values->password);
        $user->login($values->username, $values->password);

        if($zprava =="email")
        {

            $form->addError("email je jiz pouzivan");
        }else if($zprava == "Jmeno")
        {

            $form->addError("Jmeno je obsazeno");
        }else if($zprava == "nic"){
       
            $this->redirect('Homepage:');


        }
        
      
	}

}
?>