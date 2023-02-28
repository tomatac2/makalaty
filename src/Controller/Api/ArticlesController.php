<?php
declare(strict_types=1);

namespace App\Controller\Api;
use Cake\Datasource\FactoryLocator;
use Cake\View\Helper\PaginatorHelper ;

class ArticlesController extends AppController
{

   public function initialize(): void
{
    parent::initialize();
    $this->Authentication->allowUnauthenticated(['create','update','delete','view','index']);
}

 

// ////////index/////////
public function index()
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   $userModel =  FactoryLocator::get('Table')->get('Users') ; 
   if($jwtData && $jwtData->user_group == "admin"):
     
       //get all records from DB
       $this->paginate =  [
         'limit' => 5 ,
         'order'=> ['Articles.id'=>'DESC' ] //id
        ] ;
      $index = $this->paginate($this->Articles);
      $pagination = $this->request->getAttribute('paging')['Articles'];

       if($index){
         $msg = "عرض كل المقالات"  ; $success = true ;   $data = $index ; 
      } else{
         //not found
         $msg = "لايوجد مقالات";   $success = false ; $data = json_decode("[]");  // {} == 1  [] > 1
      }
   

   else :   $msg = "غير مسموح الدخول لهذه الصفحة"  ; $success = false ; $data = json_decode("{}");
      
   endif;

    
   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data , "pagination"=>$pagination ];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}

 

// ////////view/////////
public function view($id)
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   $userModel =  FactoryLocator::get('Table')->get('Users') ; 
   if($jwtData && $jwtData->user_group == "admin"):
     
      //get record from DB
      $view = $this->Articles->get($id) ;
      if($view){
         $msg = "عرض المقال"  ; $success = true ;   $data = $view ; 
      } else{
         //not found
         $msg = "المقال غير موجود";   $success = false ; $data = json_decode("{}");
      }
   

   else :   $msg = "غير مسموح الدخول لهذه الصفحة"  ; $success = false ; $data = json_decode("{}");
      
   endif;

    
   // fixed response in all functions
   $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}
// ////////delete/////////
public function delete($id)
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   $userModel =  FactoryLocator::get('Table')->get('Users') ; 
   if($jwtData && $jwtData->user_group == "admin"):
     
      //get record from DB
      $delete = $this->Articles->get($id) ;
      //delete from db
      if($this->Articles->delete($delete)){
         $msg = "تم حذف المقال بنجاح"  ; $success = true ;   $data = $delete ; 
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
// ////////update/////////
public function update($id)
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   $userModel =  FactoryLocator::get('Table')->get('Users') ; 
   if($jwtData && $jwtData->user_group == "admin"):
      $req = $this->request->getData();
      //get record from DB
      $update = $this->Articles->get($id) ;
    
      $fields = [
         "category_id"=> $req["category_id"], //required
         "address_en"=> $req["address_en"], //required
         "address_ar"=> $req["address_ar"], //required
         "short_desc_en"=> $req["short_desc_en"], //required
         "short_desc_ar"=> $req["short_desc_ar"], //required
         "content_en"=> $req["content_en"], //required
         "content_ar"=> $req["content_ar"], //required
         "type"=> $req["type"], //required  
         "youtube_link"=> $req["youtube_link"],  //[video =>required]
      ] ;

      $updateFields = $userModel->updateFieldsFromDB($fields) ;    
      
      $update = $this->Articles->patchEntity($update , $updateFields) ; // old record , new values
      
    //  echo json_encode($_FILES["image_file"]["name"]);exit;
      //upload file if exist 
      if (!$update->getErrors() && $_FILES["image_file"]["name"]) {
         //upload file
         $uploadFile =  FactoryLocator::get('Table')->get('Users')->uploadImage(["imgNameReq"=>$this->request->getData('image_file'), 'path' => 'library/articles']) ; 
         //update field 
         $update->photo = $uploadFile;
     }
     
      //save on db
      if($this->Articles->save($update)){
         $msg = "تم تحديث المقال بنجاح"  ; $success = true ;   $data = $update ; 
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
// ///////////create//////
public function create()
{
   $jwtData = FactoryLocator::get('Table')->get('Users')->jwtData(); 
   if($jwtData && $jwtData->user_group == "admin"):
      $req = $this->request->getData();
      //new empty record 
      $create = $this->Articles->newEmptyEntity() ;
      $fields = [
            "category_id"=> $req["category_id"], //required
            "address_en"=> $req["address_en"], //required
            "address_ar"=> $req["address_ar"], //required
            "short_desc_en"=> $req["short_desc_en"], //required
            "short_desc_ar"=> $req["short_desc_ar"], //required
            "content_en"=> $req["content_en"], //required
            "content_ar"=> $req["content_ar"], //required
            "type"=> $req["type"], //required  
            "youtube_link"=> $req["youtube_link"],  //[video =>required]
            "image_file"=> $req["image_file"], //required
         ] ;
      $create = $this->Articles->patchEntity($create , $fields , ['validate'=>'create']) ; // empty record , values
     
      if (!$create->getErrors()) {
         //upload file
         $uploadFile =  FactoryLocator::get('Table')->get('Users')->uploadImage(["imgNameReq"=>$this->request->getData('image_file'), 'path' => 'library/articles']) ; 
         //update field 
         $create->photo = $uploadFile;
     }
     
      //save on db
      if($this->Articles->save($create)){
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











//https://stackoverflow.com/questions/60755872/cakephp-object-of-class-laminas-diactoros-uploadedfile-could-not-be-converted
// if (!$create->getErrors()) {

//    $image = $this->request->getData('image_file');
//    $fileName = $image->getClientFilename();

//    $image->moveTo(WWW_ROOT . 'img' . DS . $fileName);

//    $create->photo = $fileName;
//    }