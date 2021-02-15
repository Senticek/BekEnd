<?php

namespace App\Model;

use Nette\Security as NS;

class UserAcl
{
   /**
    * @return NS\Permission
    */
   public static function create()
   {
      $acl = new NS\Permission;
      
      $acl->addRole('admin');
      $acl->addRole('user');
      $acl->addRole('guest');
      
      //todo
      $acl->addResource('edit');
      
      $acl->allow('admin','edit');
      return $acl;
   }
}


