<?php

namespace App\Presenters;

use Nette\Application\UI\Presenter;
use App\Model\ConstModel;
use App\Model\Database;
use Nette\Application\UI\ITemplate;
use Filters;
//use App\TEMPLATE_Module\TEMPLATE_Model;
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

 
   
 /*  public function injectDependencies(
    TEMPLATE_Model $modelPrayers,
    TEMPLATE_FormFactory $formFactory)
{
   $this->modelPrayers = $modelPrayers;
   $this->formFactory = $formFactory;
}*/

   protected function startup(): void {
      parent::startup();
     
   
   
  }



  public function filter($param) {
      return $param . ' paramFiltered';
  }

  public function funct($param) {
      return $param . ' Function done';
  }
   
    public function beforeRender(): void
    {

      parent::startup();
        $this->basePath = $this->getHttpRequest()->getUrl()->getBasePath();
      if (strlen($this->basePath) > 0)  //remove slash at end
         $this->basePath = rtrim($this->basePath);
        
         
       /*  $this->template->daos = $this->modelPrayers->findAll();
         $this->template->posts = $this->popisy_data
         ->getPublicArticles();*/

      
 
       $this->template->addFilter('name', [$this, 'filter']);
    
      
       $this->template->cssVersionSlug = $this->cssVersionSlug;
       $this->template->VERSION = self::VERSION;
       
    
  
    }


/*public function actionEdit(template $poster): void
{
	$this->template->$poster;

  
	$this['postForm']->setDefaults($poster);
}

public function postFormSucceeded(Form $form, array $values): void
{

		$post = $values;
		
	$this->redirect('Homepage:');
}
*/

/*protected function createComponentPostForm(): Form
{
	$form = new Form;
	$form->addTextArea('content', 'Obsah:')
	$form->addSubmit('send', 'Uložit a publikovat');
		->setRequired();
	$form->onSuccess[] = [$this, 'postFormSucceeded'];

	return $form;
}*/

  





}