<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $email
 * @property string $password
 *
 * The followings are the available model relations:
 * @property Dialogs[] $dialogs
 * @property Dialogs[] $dialogs1
 * @property EventsMembers[] $eventsMembers
 * @property EventsRights[] $eventsRights
 * @property GroupsRights[] $groupsRights
 * @property Messages[] $messages
 * @property Messages[] $messages1
 * @property Notes[] $notes
 * @property UserFriends[] $userFriends
 * @property UserFriends[] $userFriends1
 * @property UserRegistryHash[] $userRegistryHashes
 * @property UsersInfo[] $usersInfos
 * @property WallRecords[] $wallRecords
 * @property WallRecords[] $wallRecords1
 */
class Users extends CActiveRecord
{
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
			array('login, email, password', 'required'),
			array('login, email, password', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, email, password', 'safe', 'on'=>'search'),
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
			'dialogs' => array(self::HAS_MANY, 'Dialogs', 'creator'),
			'dialogs1' => array(self::HAS_MANY, 'Dialogs', 'invited'),
			'eventsMembers' => array(self::HAS_MANY, 'EventsMembers', 'user'),
			'eventsRights' => array(self::HAS_MANY, 'EventsRights', 'user'),
			'groupsRights' => array(self::HAS_MANY, 'GroupsRights', 'user'),
			'messages' => array(self::HAS_MANY, 'Messages', 'recipient'),
			'messages1' => array(self::HAS_MANY, 'Messages', 'sender'),
			'notes' => array(self::HAS_MANY, 'Notes', 'creator'),
			'userFriends' => array(self::HAS_MANY, 'UserFriends', 'user_from'),
			'userFriends1' => array(self::HAS_MANY, 'UserFriends', 'user_to'),
			'userRegistryHashes' => array(self::HAS_MANY, 'UserRegistryHash', 'user'),
			'usersInfos' => array(self::HAS_MANY, 'UsersInfo', 'user'),
			'wallRecords' => array(self::HAS_MANY, 'WallRecords', 'user_to'),
			'wallRecords1' => array(self::HAS_MANY, 'WallRecords', 'user_from'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'email' => 'Email',
			'password' => 'Password',
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);

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

	public function validatePassword($password)
  {
    if (crypt($password, $this->password) == $this->password)
      return true;
    else
      return false;
	}
}
