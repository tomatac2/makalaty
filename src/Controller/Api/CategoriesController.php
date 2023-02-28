<?php
declare(strict_types=1);

namespace App\Controller\Api;
use Cake\Datasource\FactoryLocator;
use Cake\View\Helper\PaginatorHelper ;
class CategoriesController extends AppController
{

   public function initialize(): void
{
    parent::initialize();
    $this->Authentication->allowUnauthenticated(['create','update','delete','view','index']);
}

 

////////index/////////
public function index()
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   $userModel =  FactoryLocator::get('Table')->get('Users') ; 
   if($jwtData && $jwtData->user_group == "admin"):
     
       //get all records from DB
       $this->paginate =  [
         'limit' => 5 ,
         'order'=> ['Categories.id'=>'DESC' ] //id
        ] ;
      $index = $this->paginate($this->Categories);
      $pagination = $this->request->getAttribute('paging')['Categories'];

    //  $view = $this->Categories->get($id) ;
      if($index){
         $msg = "عرض كل التصنيفات"  ; $success = true ;   $data = $index ; 
      } else{
         //not found
         $msg = "لايوجد تصنيفات";   $success = false ; $data = json_decode("[]");  // {} == 1  [] > 1
      }
   

   else :   $msg = "غير مسموح الدخول لهذه الصفحة"  ; $success = false ; $data = json_decode("{}");
      
   endif;

    
   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data , "pagination"=>$pagination ];   
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
      $view = $this->Categories->get($id) ;
      if($view){
         $msg = "عرض التصنيف"  ; $success = true ;   $data = $view ; 
      } else{
         //not found
         $msg = "التصنيف غير موجود";   $success = false ; $data = json_decode("{}");
      }
   

   else :   $msg = "غير مسموح الدخول لهذه الصفحة"  ; $success = false ; $data = json_decode("{}");
      
   endif;

    
   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}
////////delete/////////
public function delete($id)
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   $userModel =  FactoryLocator::get('Table')->get('Users') ; 
   if($jwtData && $jwtData->user_group == "admin"):
     
      //get record from DB
      $delete = $this->Categories->get($id) ;
      //delete from db
      if($this->Categories->delete($delete)){
         $msg = "تم حذف التصنيف بنجاح"  ; $success = true ;   $data = $delete ; 
      } else{
         //get database errors
         $msg = FactoryLocator::get('Table')->get('Users')->getDbErrors($delete->getErrors()); 
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
////////update/////////
public function update($id)
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   $userModel =  FactoryLocator::get('Table')->get('Users') ; 
   if($jwtData && $jwtData->user_group == "admin"):
      $req = $this->request->getData();
      //get record from DB
      $update = $this->Categories->get($id) ;
    
      $fields = ["name"=> $req["name"]] ;

      $updateFields = $userModel->updateFieldsFromDB($fields) ;    
      
      $update = $this->Categories->patchEntity($update , $updateFields) ; // old record , new values
      //save on db
      if($this->Categories->save($update)){
         $msg = "تم تحديث التصنيف بنجاح"  ; $success = true ;   $data = $update ; 
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
///////////create//////
public function create()
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   if($jwtData && $jwtData->user_group == "admin"):
      $req = $this->request->getData();
      //new empty record 
      $create = $this->Categories->newEmptyEntity() ;
      $fields = ["name"=> $req["name"]] ;
      $create = $this->Categories->patchEntity($create , $fields , ['validate'=>'create']) ; // empty record , values
      //save on db
      if($this->Categories->save($create)){
         $msg = "تم انشاء التصنيف بنجاح"  ; $success = true ;   $data = $create ; 
      } else{
         //get database errors
         $msg = FactoryLocator::get('Table')->get('Users')->getDbErrors($create->getErrors()); 
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



 
}
