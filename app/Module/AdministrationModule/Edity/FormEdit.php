<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;
use Nette\Utils\Image;
use Nette\Utils\FileSystem;

class FormPresenter extends Nette\Application\UI\Presenter{

	private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}
    protected function createComponentPortfolioForm(): Form
    {
        $form = new Form;
        $form->addText('headline', 'Titulek:')
        ->setRequired();
        $form->addUpload('image', 'obrazek:')
			->addRule($form::IMAGE, 'Avatar musí být JPEG, PNG, GIF or WebP.')
            ->setRequired();
        $form->addTextArea('text', 'Obsah:')
            ->setRequired();
    
        $form->addSubmit('send', 'Uložit a publikovat');
        $form->onSuccess[] = [$this, 'portfolioFormSucceeded'];
        return $form;
    }
	public function portfolioFormSucceeded(Form $form, array $values): void
	{
		if (!$this->getUser()->isInRole('admin')) {
			$this->redirect(':Homepage:');
		}
			$postId = $this->getParameter('postId');
			
		$values = $form->values;
		if($values->image->isImage() and $values->image->isOk()) {
		$path = "assets/img/portfolio/" . $values->image->getName();
		$values->image->move($path);
		}
		if ($postId) {
			$post = $this->database->table('portfolio')->get($postId);
			$post->update($values);
		} else {
			$post = $this->database->table('portfolio')->insert($values);
		}
		$this->flashMessage('Příspěvek byl úspěšně publikován.', 'success');
		$this->redirect(':Admin:');
	}


	public function actionEdit(int $postId): void
	{
		if (!$this->getUser()->isInRole('admin')) {
			$this->redirect('Sign:in');
		}
		$post = $this->database->table('portfolio')->get($postId);
		if (!$post) {
			$this->error('Příspěvek nebyl nalezen');
		}
		$this['portfolioForm']->setDefaults($post->toArray());
	}

	public function actionCreate(): void
	{
		if (!$this->getUser()->isInRole('admin')) {
			$this->redirect('Sign:in');
		}
	}

	public function actionDelete($id):void
	{
		if (!$this->getUser()->isInRole('admin')) {
			$this->redirect('Sign:in');
		}
		$res = $this->database->table('portfolio')->where('id',$id)->delete();
		$this->redirect(':Admin:');
		}

}