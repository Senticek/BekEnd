<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;

class LinkPresenter extends Nette\Application\UI\Presenter{

	private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}
    protected function createComponentLinkForm(): Form
    {
        $form = new Form;
    
        $form->addText('text', 'Titulek:')
        ->setRequired();
        $form->addEmail('odkaz', 'obrazek:')
            ->setRequired();
        $form->addTextArea('proklikText', 'Obsah:')
            ->setRequired();
    
        $form->addSubmit('send', 'Uložit a publikovat');
        $form->onSuccess[] = [$this, 'linkFormSucceeded'];
    
        return $form;
    }
    public function linkFormSucceeded(Form $form, array $values): void
{
	 if (!$this->getUser()->isInRole('admin')) {
	
		$this->redirect(':Homepage:');
	
	}
	$postId = $this->getParameter('postId');

	if ($postId) {
		$post = $this->database->table('links')->get($postId);
		$post->update($values);
	} else {
		$post = $this->database->table('links')->insert($values);
	}

	$this->flashMessage('Příspěvek byl úspěšně publikován.', 'success');
	$this->redirect(':Admin:');
}


    public function actionEditLink(int $postId): void
{
	if (!$this->getUser()->isInRole('admin')) {
		$this->redirect('Sign:in');
	}
	$post = $this->database->table('links')->get($postId);
	if (!$post) {
		$this->error('Příspěvek nebyl nalezen');
	}
	$this['linkForm']->setDefaults($post->toArray());
}

}