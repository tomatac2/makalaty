<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\FactoryLocator;
/**
 * EmailList Model
 *
 * @method \App\Model\Entity\EmailList newEmptyEntity()
 * @method \App\Model\Entity\EmailList newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\EmailList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmailList get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmailList findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\EmailList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmailList[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmailList|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailList saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailList[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmailList[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmailList[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmailList[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailListTable extends Table
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

        $this->setTable('email_list');
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
            ->email('email',true,"البريد الالكترونى خاطىء")  //fields , bool (true || false) , "msg"
            ->notEmptyString('email',"ادخل البريد الالكترونى");

        return $validator;
    }


    function createMailList($f){
        $new = $this->newEmptyEntity();
        $new = $this->patchEntity($new,$f);
        if($this->save($new)){
            $msg = "تم اضافة البريد الالكترونى بنجاح";$success = true ; $data = $new ; 
        }else{
            $msg = FactoryLocator::get('Table')->get('Users')->getDbErrors($new->getErrors()) ;$success = false ; $data = json_decode("{}") ; 
        }

        return ["msg"=>$msg , "success"=>$success , "data"=>$data];
    }
}
