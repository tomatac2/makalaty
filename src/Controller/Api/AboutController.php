<?php
declare(strict_types=1);

namespace App\Controller\Api;
use Cake\Datasource\FactoryLocator;
use Cake\View\Helper\PaginatorHelper ;

class AboutController extends AppController
{

   public function initialize(): void
{
    parent::initialize();
    $this->Authentication->allowUnauthenticated(['view','update' ,'homepage']);
}

 ////////view/////////
 public function homepage()
 {
    $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
    $userModel =  FactoryLocator::get('Table')->get('Users') ; 
    if($jwtData && $jwtData->user_group == "admin"):
      
   $msg = "الصفحة الرئيسية"  ; $success = true ;   
   
   //video count && article count 
   $videoCount = FactoryLocator::get('Table')->get('Articles')->find()->where(['type'=>"video"])->count();
   $articlesCount = FactoryLocator::get('Table')->get('Articles')->find()->where(['type'=>"article"])->count();
      
   $contactsCount = FactoryLocator::get('Table')->get('Contacts')->find()->count();

   $categoriesCount = FactoryLocator::get('Table')->get('Categories')->find()->count();

   $advertisesCount = FactoryLocator::get('Table')->get('Advertises')->find()->count();

   $commentsCount = FactoryLocator::get('Table')->get('Comments')->find()->count();
 
    
   $data = [
      "videos_count"=> $videoCount,
      "articles_count"=> $articlesCount,
      "contacts_count"=> $contactsCount,
      "categories_count"=> $categoriesCount,
      "advertises_count"=> $advertisesCount,
      "comments_count"=> $commentsCount,
   ];
    else :   $msg = "غير مسموح الدخول لهذه الصفحة"  ; $success = false ; $data = json_decode("{}");
       
    endif;
 
     
    // fixed response in all functions
    $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data];   
    $this->set(['response' => $response]);
    $this->viewBuilder()->setOption('serialize', true);
    $this->RequestHandler->renderAs($this, 'json');
 }

 ////////update/////////
public function update($id)
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   $userModel =  FactoryLocator::get('Table')->get('Users') ; 
   if($jwtData && $jwtData->user_group == "admin"):
      $req = $this->request->getData();
      //get record from DB
      $update = $this->About->get($id) ;
    
      $fields = [
         "facebook"=> $req["facebook"],
         "twitter"=> $req["twitter"],
         "instgram"=> $req["instgram"],
         "youtube"=> $req["youtube"],
         "andriod"=> $req["andriod"],
         "ios"=> $req["ios"],
         "about_en"=> $req["about_en"],
         "about_ar"=> $req["about_ar"],
         "about_footer_en"=> $req["about_footer_en"],
         "about_footer_ar"=> $req["about_footer_ar"],
         ] ;

      $updateFields = $userModel->updateFieldsFromDB($fields) ;    
      
      $update = $this->About->patchEntity($update , $updateFields) ; // old record , new values
      //save on db
      if($this->About->save($update)){
         $msg = "تم تحديث معلومات الموقع بنجاح"  ; $success = true ;   $data = $update ; 
      } else{
         //get database errors
         $msg = FactoryLocator::get('Table')->get('Users')->getDbErrors($update->getErrors()); 
         $success = false ; $data = json_decode("{}");
      }
   

   else :   $msg = "غير مسموح الدخول لهذه الصفحة"  ; $success = false ; $data = json_decode("{}");
      
   endif;

    
   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}

 ////////view/////////
public function view($id)
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   $userModel =  FactoryLocator::get('Table')->get('Users') ; 
   if($jwtData && $jwtData->user_group == "admin"):
     
      //get record from DB
      $view = $this->About->get($id) ;
      if($view){
         $msg = "عرض عن الموقع"  ; $success = true ;   $data = $view ; 
      } else{
         //not found
         $msg = "عن الموقع غير موجود";   $success = false ; $data = json_decode("{}");
      }
   

   else :   $msg = "غير مسموح الدخول لهذه الصفحة"  ; $success = false ; $data = json_decode("{}");
      
   endif;

    
   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}
 

 
}







