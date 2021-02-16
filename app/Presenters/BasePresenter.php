<?php

namespace App\Presenters;

use Nette\Application\UI\Presenter;
use App\Model\ConstModel;
use App\Model\Database;
use Nette\Application\UI\ITemplate;
use Nette\Application\UI\Form;

 class BasePresenter extends Presenter 
{
      /**
    * @var string
    */
       /**
    * @var string
    */
   public $cssVersionSlug;
     /** @var TEMPLATE_FormFactory */
     private $formFactory;

     /** @var TEMPLATE_Model */
     private $modelPrayers;
   /**
    * @var string
    */
   protected $currentPageTitle;
    /** 
   * @var string
   */
  const VERSION = 'dev - 1.0.1';
   
   /** @persistent */
   public $locale;
   public $basePath;

   public function __construct(Database $popisy_data)
    {
     $this->popisy_data = $popisy_data;
       //this forces all js and css to reload every single time version changes
       
    }

 
  


  





}