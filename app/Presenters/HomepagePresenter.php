<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Presenter;
use App\Model\Database;
use Nette\Application\UI\Form;

class HomepagePresenter extends BasePresenter
{

    private Database $popisy_data;
   
    private Template $post;
    public function __construct(Database $popisy_data)
    {
     $this->popisy_data = $popisy_data;
     
       //this forces all js and css to reload every single time version changes
       
       
    }
    
    public function renderDefault(): void
	{
		$this->template->posts = $this->popisy_data
    ->getPublicArticles();
   

    $this->template->headTitle = $this->template->posts->get(1);
    $this->template->subtitle = $this->template->posts->get(2);
    $this->template->aboutUS = $this->template->posts->get(3);
    $this->template->logo = $this->template->posts->get(4);

    $this->template->adresy = $this->popisy_data
    ->getAdresses();
    $this->template->portfolia = $this->popisy_data->getPortfolioItems();
    $this->template->postsA = $this->template->portfolia->get(100);
    $this->template->linky = $this->popisy_data
    ->getLinks();
    
  /*  parent::startup();
	if ($this->getUser()->isAllowed('edit')) {
		$this->template->headTitle = "ahojky";
	}*/

   

	}

  public function createComponentObjednavkaForm()
  {
    $form = new Nette\Application\UI\Form;
    

    $form->getElementPrototype()->role[] = "form";

    $form->addText('name')
        ->setRequired("zadejte jmeno");
    $form->addEmail('email')
        ->setRequired("zadejte email");
    $form->addInteger('phone')
        ->setRequired("spatne vyplnene cislo")
        ;
    $form->addTextArea('message')
        ->setRequired("zadejte zpravu");

 

 $form->addSubmit('send');

    $form->onSuccess[] = [$this, 'SentFormSucceeded'];
    return $form;
}

  
public function SentFormSucceeded($form, $values)
{


  try {
       
       $this->popisy_data->databaseFormInsert($values);
        $this->redirect('this');
    } catch (\Nette\InvalidStateException $e) {
        $form->addError('Špatně vyplněný formulář');
    }
}





}
