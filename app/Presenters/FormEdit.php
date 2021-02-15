<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;

class FormPresenter extends Nette\Application\UI\Presenter{

	private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}
    protected function createComponentPostForm(): Form
    {
        $form = new Form;
        $form->addText('title', 'Titulek:')
            ->setRequired();
        $form->addTextArea('content', 'Obsah:')
            ->setRequired();
    
        $form->addSubmit('send', 'Uložit a publikovat');
        $form->onSuccess[] = [$this, 'postFormSucceeded'];
    
        return $form;
    }
    public function postFormSucceeded(Form $form, array $values): void
{
	/*if (!$this->getUser()->isLoggedIn()) {
		$this->error('Pro vytvoření, nebo editování příspěvku se musíte přihlásit.');
	}*/
	$postId = $this->getParameter('postId');

	if ($postId) {
		$post = $this->database->table('posts')->get($postId);
		$post->update($values);
	} else {
		$post = $this->database->table('posts')->insert($values);
	}

	$this->flashMessage('Příspěvek byl úspěšně publikován.', 'success');
	$this->redirect('show', $post->id);
}


    public function actionEdit(int $postId): void
{
	if (!$this->getUser()->isLoggedIn()) {
		$this->redirect('Sign:in');
	}
	$post = $this->database->table('posts')->get($postId);
	if (!$post) {
		$this->error('Příspěvek nebyl nalezen');
	}
	$this['postForm']->setDefaults($post->toArray());
}

}