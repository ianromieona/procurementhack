<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property integer $id
 * @property integer $ref_id
 * @property string $publish_date
 * @property string $classification
 * @property string $business_category
 * @property string $location
 * @property string $tender_title
 * @property string $description
 */
class Post extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_id, publish_date', 'required'),
			array('ref_id', 'numerical', 'integerOnly'=>true),
			array('classification, business_category, location', 'length', 'max'=>100),
			array('tender_title, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ref_id, publish_date, classification, business_category, location, tender_title, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ref_id' => 'Ref',
			'publish_date' => 'Publish Date',
			'classification' => 'Classification',
			'business_category' => 'Business Category',
			'location' => 'Location',
			'tender_title' => 'Tender Title',
			'description' => 'Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('ref_id',$this->ref_id);
		$criteria->compare('publish_date',$this->publish_date,true);
		$criteria->compare('classification',$this->classification,true);
		$criteria->compare('business_category',$this->business_category,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('tender_title',$this->tender_title,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function searchPost($param){
		$query = Yii::app()->db->createCommand()->select('*')->from('post');
		$has = false;
		$loop = false;
		// Common::pre($param["tags"]);
		if(isset($param['tags'])){
			foreach ($param['tags'] as $value) {
				if($loop){
					$query->andWhere("ref_id like :id or tender_title like :id or description like :id",array(':id'=>'%'.$value.'%'));
				}else{
					$query->where("ref_id like :id or tender_title like :id or description like :id",array(':id'=>'%'.$value.'%'));
					$loop=true;
				}
			}
			$has = true;
		}
		if(isset($param['location'])){
			if($has){
				$query->andWhere('location= :location',array(':location'=>$param['location']));
			}else{
				$query->where('location= :location',array(':location'=>$param['location']));
			}
			$has = true;
		}

		if(isset($param['dateFrom'])){
			if($has){
				$query->andWhere('publish_date>= :datefrom',array(':datefrom'=>$param['dateFrom']));
			}else{
				$query->where('publish_date>= :datefrom',array(':datefrom'=>$param['dateFrom']));
			}
			$has = true;
		}
		if(isset($param['dateTo'])){
			if($has){
				$query->andWhere('publish_date<= :dateto',array(':dateto'=>$param['dateTo']));
			}else{
				$query->where('publish_date<= :dateto',array(':dateto'=>$param['dateTo']));
			}
			$has = true;
		}
		if(isset($param['classification'])){
			$string = "";
			foreach ($param['classification'] as $value) {
				$string .='"'.$value.'",';
			}
			if($has){
				$query->andWhere('classification IN ('.substr($string,0,-1).')');
			}else{
				$query->where('classification IN ('.substr($string,0,-1).')');
			}
			$has = true;
		}
		if(isset($param['category'])){
			$string = "";
			foreach ($param['category'] as $value) {
				$string .='"'.$value.'",';
			}
			if($has){
				$query->andWhere('business_category IN ('.substr($string,0,-1).')');
			}else{
				$query->where('business_category IN ('.substr($string,0,-1).')');
			}
			$has = true;
		}
		//Common::pre($query,true);
		return $query->queryAll();
	}
}
