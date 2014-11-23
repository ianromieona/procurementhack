<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $user_firstname
 * @property string $user_lastname
 * @property string $address
 * @property integer $age
 * @property string $password
 * @property string $username
 */
class Users extends CActiveRecord
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_firstname, email, password, username', 'required','on'=>'register'),
			array('password','length', 'min'=>6, 'max'=>100,'message'=>'Password must 6 characters long.','on'=>'register'),
			array('email','email','on'=>'register'),
			array('email','unique','className' => 'Users','attributeName' => 'email','message'=>'This Email is already in use','on'=>'register'),
			array('username, password', 'required' ,'on'=>'login'),
			array('age', 'numerical', 'integerOnly'=>true),
			array('user_firstname, user_lastname, username', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_firstname, user_lastname, address, age, password, username', 'safe', 'on'=>'search'),
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
			'user_firstname' => 'Full Name',
			'user_lastname' => 'Lastname',
			'address' => 'Address',
			'age' => 'Age',
			'password' => 'Password',
			'username' => 'Username',
			'email' => 'Email',
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
		$criteria->compare('user_firstname',$this->user_firstname,true);
		$criteria->compare('user_lastname',$this->user_lastname,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('username',$this->username,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}

	public static function userEdit($params,$budget,$classification,$tags,$cat){
		
		$u = Users::model()->findByPk(Yii::app()->user->id);
		$u->user_firstname = $params['name'];
		$u->address = $params['address'];
		$u->password = md5($params['password']);
		$u->email = $params['email'];
		$u->mobile = $params['mobile'];
		if($u->save(false)){
			$filters = Filters::model()->findByAttributes(array('userId'=>Yii::app()->user->id));
			// Common::pre($filters);exit;
			if($filters){
				$filters->approved_budget = $budget;
				$filters->tags = $tags;
				$filters->classification = $classification;
				$filters->save();
			}
			else{
				$filter2 = new Filters;
				$filter2->approved_budget = $budget;
				$filter2->tags = $tags;
				$filter2->classification = $classification;
				$filter2->save();
			}
			$getcat = Categories::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
			if($getcat){
				foreach($getcat as $aw=>$aw2){
					Categories::model()->findByPk($aw2['id'])->delete();
				}
			}
			$cat2 = explode("|", $cat);
			foreach($cat2 as $a=>$b){
				$c = new Categories;
				$c->category_name = $b;
				$c->user_id = Yii::app()->user->id;
				$c->save();
			}
		}

	}

}
