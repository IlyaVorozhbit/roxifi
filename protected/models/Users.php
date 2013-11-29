<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $last_update
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

    public $user_info;

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
			array('login, email, password, language, name, surname', 'required'),
			array('login, email, password, language, name, surname', 'length', 'max'=>255),
            array('email','email'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, email, password, language, name, surname', 'safe', 'on'=>'search'),
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
			'login' => Yii::t('profile', 'Login'),
			'email' => 'Email',
			'password' => Yii::t('profile', 'Password'),
			'last_update' => 'last_update',
            'language' => Yii::t('profile', 'Language'),
            'name' => Yii::t('profile', 'name'),
            'surname' => Yii::t('profile', 'surname'),
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
		$criteria->compare('language',$this->language,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('last_update',$this->last_update,true);

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

    public function beforeValidate()
    {
        if($this->isNewRecord == 1)
        {

            if(empty($_POST['Users']['name']))
                $this->addError('name','Логин уже используется.');

            if(Users::model()->exists('login=:login',array(':login'=>$this->login)))
                $this->addError('login','Логин '.$this->login .' уже используется.');

            if(Users::model()->exists('email=:email',array(':email'=>$this->email)))
                $this->addError('email','Email '.$this->email .' уже используется.');

            $this->password = crypt($this->password);
        }
        return parent::beforeValidate();
    }

    public function generateRegisterHash()
    {
        $hash = new UsersRegistryHash();
        $hash->user = $this->id;
        $hash->hash = uniqid();
        $hash->save();
        return $hash->hash;
    }

    public function validatePassword($password)
    {
      return crypt($password, $this->password) == $this->password ? true : false;
    }

    public function findByPk($pk,$condition='',$params=array())
    {
      Yii::trace(get_class($this).'.findByPk()','system.db.ar.CActiveRecord');
      $prefix = $this->getTableAlias(true).'.';
      $criteria = $this->getCommandBuilder()->createPkCriteria($this->getTableSchema(), $pk, $condition, $params, $prefix);
      $result =  $this->query($criteria);

      if(is_null($result))
        throw new CHttpException(404,'Профиль не найден');
      return $result;
    }

    public static function getFullName($id)
    {
      $user = self::model()->findByPk($id);
      return array('name'=>$user->name, 'surname'=>$user->surname);
    }

    public function sendRegisterMessage($email,$hash)
    {
        $message = 'Благодарим Вас за регистрацию на сайте. Для того чтобы подтвердить аккаунт, перейдите по ссылке: http://roxifi.ru/verify/'.$hash;
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->From = 'no-reply@roxifi.ru';
        $mailer->AddAddress($email);
        $mailer->FromName = 'Roxifi Team';
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = 'Регистрация на Roxifi.';
        $mailer->Body = $message;
        $mailer->Send();
    }
}
