<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\FactoryLocator;

/**
 * Contacts Model
 *
 * @method \App\Model\Entity\Contact newEmptyEntity()
 * @method \App\Model\Entity\Contact newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Contact[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contact get($primaryKey, $options = [])
 * @method \App\Model\Entity\Contact findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Contact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Contact[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contact|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contact saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContactsTable extends Table
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

        $this->setTable('contacts');
        $this->setDisplayField('name');

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
         $validator->notEmptyString('name',"الاسم مطلوب");
         $validator->notEmptyString('mobile',"رقم الهاتف مطلوب");
         $validator->notEmptyString('subject',"عنوان الرسالة مطلوب");
         $validator
             ->email('email',true,"البريد الالكترونى خاطىء")   
             ->notEmptyString('email',"ادخل البريد الالكترونى");
         $validator ->notEmptyString('message',"الرسالة مطلوبة");
         return $validator;
     }

 


    function addNewContact($arr){
        $new = $this->newEmptyEntity();
        $new = $this->patchEntity($new,$arr);
        if($this->save($new)){
         $msg = "تم ارسال رسالتك بنجاح وسيتم مراجعته من خلال الادمن";$success = true ; $data = $new ; 
         }else{
             $msg = FactoryLocator::get('Table')->get('Users')->getDbErrors($new->getErrors()) ;$success = false ; $data = json_decode("{}") ; 
         }

     return ["msg"=>$msg , "success"=>$success , "data"=>$data];
     }
    
}
