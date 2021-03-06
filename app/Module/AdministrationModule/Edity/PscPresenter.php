<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;

class PscPresenter extends Nette\Application\UI\Presenter{

	private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}
	
    protected function createComponentAddressForm(): Form
    {
        $form = new Form;
        $form->addTextArea('adress', 'adresa:');
        $form->addTextArea('psc', 'psč:');
    
        $form->addSubmit('send', 'Uložit a publikovat');
        $form->onSuccess[] = [$this, 'addressFormSucceeded'];
    
        return $form;
    }

    public function addressFormSucceeded(Form $form, array $values): void
    {
		if (!$this->getUser()->isInRole('admin')) {
			$this->redirect(':Homepage:');
		}
		$postId = $this->getParameter('postId');

		if ($postId) {
			$post = $this->database->table('footeradress')->get($postId);
			$post->update($values);
		} else {
			$post = $this->database->table('footeradress')->insert($values);
		}

		$this->flashMessage('Příspěvek byl úspěšně publikován.', 'success');
		$this->redirect(':Admin:');
	}

	public function actionEditAdress(int $postId): void
	{
		if (!$this->getUser()->isInRole('admin')) {
			$this->redirect('Sign:in');
		}
		$post = $this->database->table('footeradress')->get($postId);
		if (!$post) {
			$this->error('Příspěvek nebyl nalezen');
		}
		$this['addressForm']->setDefaults($post->toArray());
	}

}