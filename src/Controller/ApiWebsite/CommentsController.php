<?php
declare(strict_types=1);

namespace App\Controller\ApiWebsite;
use Cake\Datasource\FactoryLocator;
 
class CommentsController extends AppController
{

   public function initialize(): void
{
    parent::initialize();
$this->Authentication->allowUnauthenticated(['addComment']);

}



public function addComment()
{

   $req = $this->request->getData();
   $q = FactoryLocator::get('Table')->get('Comments')->addNewComment([
      "name"=>$req["name"],
      "email"=>$req["email"],
      "website"=>$req["website"],
      "comment"=>$req["comment"],
      "article_id"=>$req["article_id"],
   ]); 
    
   
   // fixed response in all functions
   $response = ["msg"=> $q["msg"] ,"success"=> $q["success"] , "data"=> $q["data"] ];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}



 
}
