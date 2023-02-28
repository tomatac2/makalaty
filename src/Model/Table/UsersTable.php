<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
/**
 * Users Model
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->allowEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->allowEmptyString('password');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('user_group')
            ->notEmptyString('user_group');

        return $validator;
    }


    public function validationRegister(Validator $validator): Validator
    {
        $validator->notEmpty('username',"اسم المستخدم مطلوب");
        $validator->notEmpty('password',"كلمة المرور مطلوبة");
        $validator->notEmpty('email',"البريد الالكترونى مطلوب");

 
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username'] ,"اسم المستخدم موجود بالفعل"), ['errorField' => 'username']);
        $rules->add($rules->isUnique(['email'],"البريد الالكترونى موجود بالفعل"), ['errorField' => 'email']);

        return $rules;
    }

    //////queries 

    function jwtToken($data){
        $key = 'MakalaTy@2023';
        $payload = [
            'id' => $data["id"],
            'username' => $data["username"],
            'email' => $data["email"],
            'user_group' => $data["user_group"],
        ];
        
        
        $jwt = JWT::encode($payload, $key, 'HS256');  //generate token (hash)
        
        return $jwt ;
        
        }
        
        
        function jwtData(){
           $token = $this->getBearerToken();

        try {
            $decoded = JWT::decode($token?$token:"", new Key("MakalaTy@2023", 'HS256')); ////unhash token  display data
        } catch (\Exception $e) { // Also tried JwtException
             
        }
          
        
           return $decoded ;
        }



        function getAuthorizationHeader(){
            $headers = null;
            if (isset($_SERVER['Authorization'])) {
                $headers = trim($_SERVER["Authorization"]);
            }
            else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
                $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
            } elseif (function_exists('apache_request_headers')) {
                $requestHeaders = apache_request_headers();
                // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
                $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
                //print_r($requestHeaders);
                if (isset($requestHeaders['Authorization'])) {
                    $headers = trim($requestHeaders['Authorization']);
                }
            }
            return $headers;
        }
        
        /**
         * get access token from header
         * */
        function getBearerToken() {
            $headers = $this->getAuthorizationHeader();
            //echo json_encode($headers);exit;
            // HEADER: Get the access token from the header
            if (!empty($headers)) {
                if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                    return $matches[1];
                }
            }
            return null;
        }
        
        // get db errors function 
        function getDbErrors($errsArr){
            foreach($errsArr as $k=>$v){
                foreach($v as $kk=>$vv){
                   $getErrors = $vv ; 
                }
                }

                return $getErrors ;
        }

        //update fields 

        function updateFieldsFromDB($fields){
            
            $updateFields = [] ;
            foreach($fields as $k=>$v):
                if($v):
                    $updateFields[$k] .= $v ;   #.= {اضافة فيلدات اخرى على updatefields الجديدة}
                endif;
            endforeach;

        return $updateFields ;
        }


        //upload file 

        function uploadImage($arr){
            $image = $arr["imgNameReq"];
            $fileName = $image->getClientFilename();
   
            //get extention
            $getExtention =  explode(".", strtolower($fileName)); 
   
            //generate filename
            $generateFileName = "makalaty_articles_".rand(9,99).time().'.'.$getExtention[1];
   
            //move to library
            $image->moveTo(WWW_ROOT . $arr["path"] .'/'. $generateFileName);

            return $arr["path"].'/'.$generateFileName ; 
        }
}
