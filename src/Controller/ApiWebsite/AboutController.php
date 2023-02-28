<?php
declare(strict_types=1);

namespace App\Controller\ApiWebsite;
use Cake\Datasource\FactoryLocator;
 
class AboutController extends AppController
{

   public function initialize(): void
{
    parent::initialize();
$this->Authentication->allowUnauthenticated(['about','contact']);

}

////////view/////////
public function about()
{
      
  $msg = "صفحة تواصل معنا"  ; $success = true ;   

  //headers
  $last5ArticlesForHeader =  FactoryLocator::get('Table')->get('Articles')->last5ArticlesForHeader(); 
  $about =  FactoryLocator::get('Table')->get('About')->find()->first();

  //footer
  $categoriesList = FactoryLocator::get('Table')->get('Categories')->find()->limit(4)->toArray();

  $data = [
     "header"=> [
        "last5Articles"=>$last5ArticlesForHeader , 
        "android" =>$about->andriod ,
        "ios" =>$about->ios ,
     ] ,
     "body"=>[
      "about"=> $about->about_ar 
     ],
     "footer"=>[
        "about_footer_ar" => $about->about_footer_ar ,
        "about_footer_en" => $about->about_footer_en ,
        "facebook" =>  $about->facebook ,
        "twitter" =>  $about->twitter ,
        "instgram" =>  $about->instgram ,  
        "youtube" =>  $about->youtube ,  
        "categories"=> $categoriesList,
     ]
  ];
  
    
   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data ];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}

public function contact()
{

   $req = $this->request->getData();
   $q = FactoryLocator::get('Table')->get('Contacts')->addNewContact([
      "name"=>$req["name"],
      "email"=>$req["email"],
      "subject"=>$req["subject"],
      "message"=>$req["message"],
      "mobile"=>$req["mobile"],
   ]); 
    
   
   // fixed response in all functions
   $response = ["msg"=> $q["msg"] ,"success"=> $q["success"] , "data"=> $q["data"] ];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}



 
}
