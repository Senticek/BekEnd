<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;

class TextPresenter extends Nette\Application\UI\Presenter{

	private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}
    protected function createComponentDescriptionsForm(): Form
    {
        $form = new Form;
        $form->addTextArea('descriptions', 'Obsah:')
            ->setRequired();
    
        $form->addSubmit('send', 'Uložit a publikovat');
        $form->onSuccess[] = [$this, 'descriptionsFormSucceeded'];
    
        return $form;
    }
	
	public function descriptionsFormSucceeded(Form $form, array $values): void
	{
		if (!$this->getUser()->isInRole('admin')) {
			$this->redirect(':Admin:');
		}
		$postId = $this->getParameter('postId');

		if ($postId) {
			$post = $this->database->table('descriptions')->get($postId);
			$post->update($values);
		} else {
			$post = $this->database->table('descriptions')->insert($values);
		}

		$this->flashMessage('Příspěvek 	byl úspěšně publikován.', 'success');
		$this->redirect(':Admin:');
	}


	public function actionEditText(int $postId): void
	{
		
		if (!$this->getUser()->isInRole('admin')) {
			$this->redirect('Sign:in');
		}
		$post = $this->database->table('descriptions')->get($postId);
		if (!$post) {
			$this->error('Příspěvek nebyl nalezen');
		}
		$this['descriptionsForm']->setDefaults($post->toArray());
	}

}