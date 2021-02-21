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
    private Database $insert;
   
    public function __construct(Database $insert)
	{
		$this->insert = $insert;
	}

    protected function createComponentRegInForm(): Form
	{
        $values="";
        $form = new form;
    $form->addText('username', 'Your username:');
	


    $form->addPassword('password', 'Choose password:')
	->addRule($form::MIN_LENGTH, 'The password is too short: it must be at least %d characters', 5);
    $form->addPassword('password2', 'Reenter password:')
	->addRule($form::EQUAL, 'Passwords do not match', $form['password']);
    $form->addEmail('email', 'email')
	->addRule($form::EMAIL);

    $form->addSubmit('send', 'Registrovat');
    $form->onSuccess[] = [$this, 'signInFormSucceeded'];


    return $form;
    }

    public function signInFormSucceeded(Form $form,\stdClass $values): void
	{
        $message="";
        
		$message = $this->insert->databaseInsert($values);
        sleep(1);
        

        if($message =="email")
        {

            $form->addError("email je jiz pouzivan");
        }else if($message == "Jmeno")
        {

            $form->addError("Jmeno je obsazeno");
        }else if($message == "nic"){
       
            $user = $this->getUser();
        $user->authenticator->authenticate($values->username, $values->password);
        $user->login($values->username, $values->password);

            $this->redirect('Homepage:');
            

        }
        
      
	}

}
?>