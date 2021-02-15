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
		//$this->template->posts = $this->popisy_data
    //->getPublicArticles();
  

    //$this->template->headTitle = $this->template->posts[0];
    $this->template->subtitle = 'ree';
    $this->template->aboutUS = 'reee';

    $this->template->portfolia = $this->popisy_data->getPortfolioItems();

	}

}
