<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articles Model
 *
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\Article newEmptyEntity()
 * @method \App\Model\Entity\Article newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Article[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Article get($primaryKey, $options = [])
 * @method \App\Model\Entity\Article findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Article[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Article|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArticlesTable extends Table
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

        $this->setTable('articles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
        ]);

        $this->hasMany('Comments', [
            'foreignKey' => 'article_id',
        ]);
       
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
            ->integer('category_id')
            ->allowEmptyString('category_id');

        $validator
            ->scalar('address_en')
            ->maxLength('address_en', 255)
            ->allowEmptyString('address_en');

        $validator
            ->scalar('address_ar')
            ->maxLength('address_ar', 255)
            ->allowEmptyString('address_ar');

        $validator
            ->scalar('short_desc_en')
            ->maxLength('short_desc_en', 255)
            ->allowEmptyString('short_desc_en');

        $validator
            ->scalar('short_desc_ar')
            ->maxLength('short_desc_ar', 255)
            ->allowEmptyString('short_desc_ar');

        $validator
            ->scalar('content_en')
            ->maxLength('content_en', 4294967295)
            ->allowEmptyString('content_en');

        $validator
            ->scalar('content_ar')
            ->maxLength('content_ar', 4294967295)
            ->allowEmptyString('content_ar');

        $validator
            ->scalar('type')
            ->allowEmptyString('type');

        $validator
            ->scalar('youtube_link')
            ->maxLength('youtube_link', 255)
            ->allowEmptyString('youtube_link');

        $validator
            ->scalar('photo')
            ->maxLength('photo', 255)
            ->allowEmptyString('photo');

        return $validator;
    }

    ///////////
    public function validationCreate(Validator $validator): Validator
    {
        $validator ->notEmpty('category_id',"التصنيف مطلوب");
        $validator ->notEmpty('address_en',"العنوان بالانجليزى مطلوب");
        $validator ->notEmpty('address_ar',"العنوان بالعربى مطلوب");
        $validator ->notEmpty('short_desc_en',"الوصف المختصر الانجليزى مطلوب");
        $validator ->notEmpty('short_desc_ar',"الوصف المختصر العربى مطلوب");
        $validator ->notEmpty('content_en',"المحتوى بالانجليزى مطلوب");
        $validator ->notEmpty('content_ar',"المحتوى بالعربى مطلوب");
        $validator ->notEmpty('type',"نوع المقال مطلوب");
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



    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('category_id', 'Categories' , "التصنيف غبر موجود"), ['errorField' => 'category_id']);

        return $rules;
    }



    /////////function custom 

    function increaseViewersCount($q){
        $oldCount = $q->viewers_count ;
        $q->viewers_count = $oldCount+1;
        $this->save($q);
       // echo json_encode($q) ; exit ; 
    }

    //////////
    function last5ArticlesForHeader(){
        $last5Articles =$this->find()
                        ->order(['Articles.id'=>'DESC'])
                        ->select(['category_id','id','address_ar','short_desc_ar','photo','created'])
                        ->contain(['Categories'=>function($q){
                            return $q->select(['id','name']) ;
                        }])
                        ->limit(5)
                        ->toArray();
      return $last5Articles ? $last5Articles  : [] ;
    }
    
}








 