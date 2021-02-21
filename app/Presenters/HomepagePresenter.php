<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Presenter;
use App\Model\Database;
use Nette\Application\UI\Form;

class HomepagePresenter extends Presenter 
{
     private Database $dtb_data;
     private Template $post;
     public function __construct(Database $dtb_data)
     {
     $this->dtb_data =$dtb_data ;
     }
    
    public function renderDefault(): void
	{
     
          $this->template->posts = $this->dtb_data->getPublicArticles();

          $this->template->headTitle = $this->template->posts->get(1);
          $this->template->subtitle = $this->template->posts->get(2);
          $this->template->aboutUS = $this->template->posts->get(3);
          $this->template->logo = $this->template->posts->get(4);
      
          $this->template->adresses = $this->dtb_data->getAdresses();
      
          $this->template->portfolio = $this->dtb_data->getPortfolioItems();
          $this->template->postsA = $this->template->portfolio->get(100);
      
          $this->template->links = $this->dtb_data->getLinks();
          $this->template->Logos = $this->dtb_data->getLogo();
          $this->template->mainLogo = $this->template->Logos->get(1);
  
        
          $this->template->socials = $this->dtb_data->getSoc();

	}

     public function createComponentCommentForm()
     {
     $form = new Nette\Application\UI\Form;
     $form->getElementPrototype()->role[] = "form";

     $form->addText('name')
          ->setRequired("");
     $form->addEmail('email')
          ->setRequired("");
     $form->addInteger('phone')
          ->setRequired("");
     $form->addTextArea('message')
          ->setRequired("");

     $form->addSubmit('send');

     $form->onSuccess[] = [$this, 'SentFormSucceeded'];
     return $form;
     }

  
     public function SentFormSucceeded($form, $values)
     {
          try {
               $this->dtb_data->databaseFormInsert($values);
               $this->redirect('this');
          } catch (\Nette\InvalidStateException $e) {
               $form->addError('Špatně vyplněný formulář');
          }
     }

}
