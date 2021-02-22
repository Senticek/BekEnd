<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;
use Nette\Utils\Image;
use Nette\Utils\FileSystem;

class LogoPresenter extends Nette\Application\UI\Presenter{

	private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}
    protected function createComponentLogoForm(): Form
    {
        $form = new Form;
        $form->addUpload('image', 'obrazek:')
			->addRule($form::IMAGE, 'Avatar musí být JPEG, PNG, GIF or WebP.');
            
        
        $form->addSubmit('send', 'Uložit a publikovat');
        $form->onSuccess[] = [$this, 'logoFormSucceeded'];
        return $form;
    }
	public function logoFormSucceeded(Form $form, array $values): void
	{
		if (!$this->getUser()->isInRole('admin')) {
			$this->redirect(':Homepage:');
		}

			
		$values = $form->values;
		if($values->image->isImage() and $values->image->isOk()) {
		$path = "assets/img/" . $values->image->getName();
		$values->image->move($path);
		}
			$post = $this->database->table('logo')->get(1);
			$post->update($values);
		
		$this->flashMessage('Příspěvek byl úspěšně publikován.', 'success');
		$this->redirect(':Admin:');
	}


	public function actionEdit(): void
	{
		if (!$this->getUser()->isInRole('admin')) {
			$this->redirect('Sign:in');
		}
		$post = $this->database->table('logo')->get(1);
		if (!$post) {
			$this->error('Příspěvek nebyl nalezen');
		}
		$this['logoForm']->setDefaults($post->toArray());
	}

	public function actionCreate(): void
	{
		if (!$this->getUser()->isInRole('admin')) {
			$this->redirect('Sign:in');
		}
	}
}