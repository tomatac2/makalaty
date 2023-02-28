<?php
declare(strict_types=1);

namespace App\Controller\ApiMobile;
use Cake\Datasource\FactoryLocator;
 
class ArticlesController extends AppController
{

   public function initialize(): void
{
    parent::initialize();
    $this->Authentication->allowUnauthenticated(['homepage','videos','articleDetails']);
}


 ////////articleDetails/////////
 public function articleDetails($id)
 {
       
   $msg = "صفحة تفاصيل المقال"  ; $success = true ;   

   //get article details
   $details = $this->Articles->find()->where(['Articles.id'=>$id])->contain(['Categories'])->first() ;
   //echo json_encode($details->category_id);exit;
   //2 related artilces 
   $related = $this->Articles->find()
            ->where(['Articles.id !='=>$id , 'Articles.category_id'=>$details->category_id])
            ->order(['Articles.id'=>'DESC'])
            ->contain(['Categories'])
            ->limit(2)
            ->toArray() ;
            
   $data =  [
      "details"=>$details ,
      "related"=>$related ,
   ] ;  

  //increase viewers count 
   $this->Articles->increaseViewersCount($details);
    
    // fixed response in all functions
    $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data ];   
    $this->set(['response' => $response]);
    $this->viewBuilder()->setOption('serialize', true);
    $this->RequestHandler->renderAs($this, 'json');
 }

 ////////videos/////////
 public function videos()
 {
       
   $msg = "صفحة الفيديوهات"  ; $success = true ;   

   //get all records from DB
   $this->paginate =  [
   'limit' => 5 ,
   'order'=> ['Articles.id'=>'DESC' ] ,
   'conditions' => ["Articles.type"=>"video"] //where
   ] ;
   $videos = $this->paginate($this->Articles);
   $pagination = $this->request->getAttribute('paging')['Articles'];

    
   $data = $videos ;
   
     
    // fixed response in all functions
    $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data , "pagination"=>$pagination];   
    $this->set(['response' => $response]);
    $this->viewBuilder()->setOption('serialize', true);
    $this->RequestHandler->renderAs($this, 'json');
 }
 ////////view/////////
 public function homepage()
 {
       
   $msg = "الصفحة الرئيسية"  ; $success = true ;   
   
   //categories list 
   $categoriesList = FactoryLocator::get('Table')->get('Categories')->find()->toArray();

   //get all records from DB
   $this->paginate =  [
   'limit' => 5 ,
   'order'=> ['Articles.id'=>'DESC' ] //id
   ] ;
   $articles = $this->paginate($this->Articles);
   $pagination = $this->request->getAttribute('paging')['Articles'];

    
   $data = [
      "categories"=> $categoriesList,
      "articles"=> $articles,
   ];
   
     
    // fixed response in all functions
    $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data , "pagination"=>$pagination];   
    $this->set(['response' => $response]);
    $this->viewBuilder()->setOption('serialize', true);
    $this->RequestHandler->renderAs($this, 'json');
 }



 
}
