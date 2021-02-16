<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Presenter;
use App\Model\Database;

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
    $this->template->linky = $this->popisy_data
    ->getLinks();
    
  /*  parent::startup();
	if ($this->getUser()->isAllowed('edit')) {
		$this->template->headTitle = "ahojky";
	}*/

   

	}



}
