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

 
   
 /*  public function injectDependencies(
    TEMPLATE_Model $modelPrayers,
    TEMPLATE_FormFactory $formFactory)
{
   $this->modelPrayers = $modelPrayers;
   $this->formFactory = $formFactory;
}*/

public function createComponentObjednavkaForm()
{
    $form = new Nette\Application\UI\Form;

    $form->getElementPrototype()->role[] = "form";

    $form->addText('jmeno')
        ->setRequired();

    $form->addText('prijmeni')
        ->setRequired();

 

 $form->addSubmit('send');

    $form->onSuccess[] = [$this, 'KontaktFormSucceeded'];
    return $form;
}

public function KontaktFormSucceeded($form)
{

 $this->redirect(':Homepage:');
  /*  try {
        $this->sendMail($form->getValues());
       );
        $this->redirect('this');
    } catch (\Nette\InvalidStateException $e) {
        $form->addError($this->translator->translate('messages.form.nepodarilo_se_odeslat_email_zkuste_to_prosim_za_chvili'));
    }*/
}


  





}