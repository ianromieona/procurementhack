<?php

/**
 * This is the model class for table "filters".
 *
 * The followings are the available columns in table 'filters':
 * @property integer $id
 * @property integer $userId
 * @property string $approved_budget
 * @property string $category
 * @property string $tags
 */
class Filters extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'filters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('userId', 'required'),
			array('userId', 'numerical', 'integerOnly'=>true),
			array('approved_budget', 'length', 'max'=>30),
			// array('category', 'length', 'max'=>100),
			array('tags', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userId, approved_budget, tags, classification', 'safe', 'on'=>'search'),
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
			'userId' => 'User',
			'approved_budget' => 'Approved Budget',
			'tags' => 'Tags',
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
		$criteria->compare('userId',$this->userId);
		$criteria->compare('approved_budget',$this->approved_budget,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('tags',$this->tags,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Filters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
