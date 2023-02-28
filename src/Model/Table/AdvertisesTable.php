<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Advertises Model
 *
 * @method \App\Model\Entity\Advertise newEmptyEntity()
 * @method \App\Model\Entity\Advertise newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Advertise[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Advertise get($primaryKey, $options = [])
 * @method \App\Model\Entity\Advertise findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Advertise patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Advertise[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Advertise|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Advertise saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Advertise[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Advertise[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Advertise[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Advertise[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AdvertisesTable extends Table
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

        $this->setTable('advertises');
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
            ->scalar('link')
            ->maxLength('link', 255)
            ->allowEmptyString('link');

        $validator
            ->scalar('photo')
            ->maxLength('photo', 255)
            ->allowEmptyString('photo');

        $validator
            ->scalar('type')
            ->notEmptyString('type');

        $validator
            ->integer('page_num')
            ->notEmptyString('page_num');

        return $validator;
    }



    public function validationCreate(Validator $validator): Validator
    {
        $validator ->notEmpty('link',"الرابط مطلوب");
        $validator ->notEmpty('type',"نوع الاعلان مطلوب");
        $validator ->notEmpty('page_num',"رقم الصفحة مطلوبة");
        $validator->notEmptyFile('image_file' , "الصورة مطلوبة")
        ->uploadedFile('image_file', [
            'maxSize' => 1024*1024 // Max 1 MB
        ],"حجم الصورة كبير يجب الا يزيد عن 1ميجا بايت")
        ->add('image_file', 'extension', [
            'rule' => ['extension', ['png','jpg','jpeg','svg']] ,// .png file extension only
            'message'=> "امتداد الصورة غير مدعوم , الامدادات المدعومة ['png','jpg','jpeg','svg']"
        ]);
            return $validator;
        }


}
