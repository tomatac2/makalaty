<?php
declare(strict_types=1);

namespace App\Controller\ApiWebsite;
use Cake\Datasource\FactoryLocator;
 
class ArticlesController extends AppController
{

   public function initialize(): void
{
    parent::initialize();
$this->Authentication->allowUnauthenticated(['homepage','emailList' ,'videos','articleDetails']);

}



public function emailList()
{

   $req = $this->request->getData();
   $q = FactoryLocator::get('Table')->get('EmailList')->createMailList(["email"=>$req["email"]]); 
    
   
   // fixed response in all functions
   $response = ["msg"=> $q["msg"] ,"success"=> $q["success"] , "data"=> $q["data"] ];   
   $this->set(['response' => $response]);
   $this->viewBuilder()->setOption('serialize', true);
   $this->RequestHandler->renderAs($this, 'json');
}

//  ////////articleDetails/////////
 public function articleDetails($id)
 {
       
   $msg = "صفحة تفاصيل المقال"  ; $success = true ;   


   //headers
   $last5ArticlesForHeader = $this->Articles->last5ArticlesForHeader(); 
   $about =  FactoryLocator::get('Table')->get('About')->find()->first();

   //footer
   $categoriesList = FactoryLocator::get('Table')->get('Categories')->find()->limit(4)->toArray();
    
   //body left side 
   $page = $_GET["page"]?$_GET["page"]:1;
   $horzintalAdv = FactoryLocator::get('Table')->get('Advertises')->find()->where(['page_num'=>$page,"type"=>"Horizontal"])->limit(2)->toArray();

   $last3VideosHightViwers =  FactoryLocator::get('Table')->get('Articles')->find()->where(['type'=>"video"])->order(['Articles.viewers_count'=>"DESC"])->limit(3)->toArray();
   
   $last3ArticlesHightViwers =  FactoryLocator::get('Table')->get('Articles')->find()->where(['type'=>"article"])->order(['Articles.viewers_count'=>"DESC"])->limit(3)->toArray();

   //body right side
   //get article details
   $details = $this->Articles->find()->where(['Articles.id'=>$id])->contain(['Categories','Comments'])->first() ;
 
 
   $related = $this->Articles->find()
            ->where(['Articles.id !='=>$id , 'Articles.category_id'=>$details->category_id])
            ->order(['Articles.id'=>'DESC'])
            ->contain(['Categories'])
            ->limit(2)
            ->toArray() ;
   $virticalAdv = FactoryLocator::get('Table')->get('Advertises')->find()->where(['page_num'=>$page,"type"=>"Vertical"])->first();
       

   $data = [
      "header"=> [
         "last5Articles"=>$last5ArticlesForHeader , 
         "android" =>$about->andriod ,
         "ios" =>$about->ios ,
      ] ,
      "body"=>[
         "right_side_pagination"=> [
            "details"=>  $details,
            "related"=>  $related,
            "virticalAdv"=>$virticalAdv
         ],
         "left_side"=>[
            "horzintalAdv"=>$horzintalAdv, //2
            "last3VideosHightViwers"=>$last3VideosHightViwers,
            "last3ArticlesHightViwers"=>$last3ArticlesHightViwers,
            "social"=>[
               "facebook" =>  $about->facebook ,
               "twitter" =>  $about->twitter ,
               "instgram" =>  $about->instgram ,  
               "youtube" =>  $about->youtube ,  
            ]
         ],
       
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
  //increase viewers count 
   $this->Articles->increaseViewersCount($details);
    
    // fixed response in all functions
    $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data ];   
    $this->set(['response' => $response]);
    $this->viewBuilder()->setOption('serialize', true);
    $this->RequestHandler->renderAs($this, 'json');
 }

//  ////////videos/////////
 public function videos()
 {
       
   $msg = "صفحة الفيديوهات"  ; $success = true ;   

   // //get all records from DB
   $this->paginate =  [
   'limit' => 6 ,
   'order'=> ['Articles.id'=>'DESC' ] ,
   'conditions' => ["Articles.type"=>"video"] //where
   ] ;
   $videos = $this->paginate($this->Articles);
   $pagination = $this->request->getAttribute('paging')['Articles'];

   //headers
   $last5ArticlesForHeader = $this->Articles->last5ArticlesForHeader(); 
   $about =  FactoryLocator::get('Table')->get('About')->find()->first();

   //footer
   $categoriesList = FactoryLocator::get('Table')->get('Categories')->find()->limit(4)->toArray();
    

   //body    
   $page = $_GET["page"]?$_GET["page"]:1;
   $horzintalAdv = FactoryLocator::get('Table')->get('Advertises')->find()->where(['page_num'=>$page,"type"=>"Horizontal"])->limit(2)->toArray();

   $last3VideosHightViwers =  FactoryLocator::get('Table')->get('Articles')->find()->where(['type'=>"video"])->order(['Articles.viewers_count'=>"DESC"])->limit(3)->toArray();
   
   $last3ArticlesHightViwers =  FactoryLocator::get('Table')->get('Articles')->find()->where(['type'=>"article"])->order(['Articles.viewers_count'=>"DESC"])->limit(3)->toArray();

   $data = [
      "header"=> [
         "last5Articles"=>$last5ArticlesForHeader , 
         "android" =>$about->andriod ,
         "ios" =>$about->ios ,
      ] ,
      "body"=>[
         "right_side_pagination"=> [
            "videos_paginate"=>  $videos,
         ],
         "left_side"=>[
            "horzintalAdv"=>$horzintalAdv, //2
            "last3VideosHightViwers"=>$last3VideosHightViwers,
            "last3ArticlesHightViwers"=>$last3ArticlesHightViwers,
            "social"=>[
               "facebook" =>  $about->facebook ,
               "twitter" =>  $about->twitter ,
               "instgram" =>  $about->instgram ,  
               "youtube" =>  $about->youtube ,  
            ]
         ],
       
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
    $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data , "pagination"=>$pagination];   
    $this->set(['response' => $response]);
    $this->viewBuilder()->setOption('serialize', true);
    $this->RequestHandler->renderAs($this, 'json');
 }
 ////////view/////////
 public function homepage()
 {
       
   $msg = "الصفحة الرئيسية"  ; $success = true ;   

   //headers
   $last5ArticlesForHeader = $this->Articles->last5ArticlesForHeader(); 
   $about =  FactoryLocator::get('Table')->get('About')->find()->first();

   //footer
   $categoriesList = FactoryLocator::get('Table')->get('Categories')->find()->limit(4)->toArray();

   //body 
   $this->paginate =  [
      'limit' => 6 ,
      'order'=> ['Articles.id'=>'DESC' ] ,
      "select"=>['category_id','id','address_ar','short_desc_ar','photo','created'],
      "contain"=>[
         'Categories'=>function($q){
            return $q->select(['id','name']) ;
         }
         ]
      ] ;
      $articles = $this->paginate($this->Articles);
      $pagination = $this->request->getAttribute('paging')['Articles'];
      $page = $_GET["page"]?$_GET["page"]:1;
         
      $virticalAdv = FactoryLocator::get('Table')->get('Advertises')->find()->where(['page_num'=>$page,"type"=>"Vertical"])->first();
      
      $horzintalAdv = FactoryLocator::get('Table')->get('Advertises')->find()->where(['page_num'=>$page,"type"=>"Horizontal"])->first();

      $last3VideosHightViwers =  FactoryLocator::get('Table')->get('Articles')->find()->where(['type'=>"video"])->order(['Articles.viewers_count'=>"DESC"])->limit(3)->toArray();
      
      $last3ArticlesHightViwers =  FactoryLocator::get('Table')->get('Articles')->find()->where(['type'=>"article"])->order(['Articles.viewers_count'=>"DESC"])->limit(3)->toArray();
   
   $data = [
      "header"=> [
         "last5Articles"=>$last5ArticlesForHeader , 
         "android" =>$about->andriod ,
         "ios" =>$about->ios ,
      ] ,
      "body"=>[
         "last5Articles"=>$last5ArticlesForHeader , 
         "right_side_pagination"=> [
            "articles_paginate"=>  $articles,
            "virticalAdv"=>$virticalAdv 
         ],
         "left_side"=>[
            "horzintalAdv"=>$horzintalAdv,
            "last3VideosHightViwers"=>$last3VideosHightViwers,
            "last3ArticlesHightViwers"=>$last3ArticlesHightViwers,
            "social"=>[
               "facebook" =>  $about->facebook ,
               "twitter" =>  $about->twitter ,
               "instgram" =>  $about->instgram ,  
               "youtube" =>  $about->youtube ,  
            ]
         ],
       
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
    $response = ["msg"=> $msg ,"success"=> $success , "data"=> $data , "pagination"=>$pagination];   
    $this->set(['response' => $response]);
    $this->viewBuilder()->setOption('serialize', true);
    $this->RequestHandler->renderAs($this, 'json');
 }



 
}
