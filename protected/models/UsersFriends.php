<?php

/**
 * This is the model class for table "users_friends".
 *
 * The followings are the available columns in table 'users_friends':
 * @property integer $id
 * @property integer $user_from
 * @property integer $user_to
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Users $userFrom
 * @property Users $userTo
 */
class UsersFriends extends CActiveRecord
{

    const STATUS_NEW_REQUEST = 0;
    const STATUS_FRIEND = 1;
    const STATUS_DELETED_REQUEST = 2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_friends';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_from, user_to, status', 'required'),
			array('user_from, user_to, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_from, user_to, status', 'safe', 'on'=>'search'),
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
			'userFrom' => array(self::BELONGS_TO, 'Users', 'user_from'),
			'userTo' => array(self::BELONGS_TO, 'Users', 'user_to'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_from' => 'User From',
			'user_to' => 'User To',
			'status' => 'Status',
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
		$criteria->compare('user_from',$this->user_from);
		$criteria->compare('user_to',$this->user_to);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersFriends the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function sendRequest($from,$to)
    {

        if(self::canRegisterRequest($from,$to))
        {

            $request = self::getRequest($from,$to);
            $request->user_from = $from;
            $request->user_to = $to;
            $request->status = 0;
            if($request->save())
                return 1;
            else
                return 0;

        }

    }

    public static function canRegisterRequest($from,$to)
    {

        if(Yii::app()->user->isGuest)
            return 0;

        if($from==$to)
            return 0;

        return !UsersFriends::model()->exists('((user_from=:from and user_to=:to) or (user_from=:to and user_to=:from)) and status <> '.self::STATUS_DELETED_REQUEST.'',array(
            ':from'=>$from,
            ':to'=>$to
        ));

    }

    public static function acceptRequest($from,$to)
    {

        $request = UsersFriends::model()->find('((user_from=:from and user_to=:to) and (status = '.self::STATUS_DELETED_REQUEST.' or status = '.self::STATUS_NEW_REQUEST.'))',array(
            ':from'=>$from,
            ':to'=>$to
        ));

        if(is_null($request))
            throw new CHttpException('404','Заявка не найдена');

        $request->status = self::STATUS_FRIEND;

        if($request->save())
            return 1;

        else
            return 0;

    }

    public static function rejectRequest($from,$to)
    {

        $request = UsersFriends::model()->find('((user_from=:from and user_to=:to) and (status = '.self::STATUS_NEW_REQUEST.'))',array(
            ':from'=>$from,
            ':to'=>$to
        ));

        if(is_null($request))
            throw new CHttpException('404','Заявка не найдена');

        $request->status = self::STATUS_DELETED_REQUEST;

        if($request->save())
            return 1;

        else
            return 0;

    }

    public static function deleteFromFriends($removing,$removed)
    {

        $request = UsersFriends::model()->find('(((user_from=:removing and user_to=:removed) or (user_from=:removed and user_to=:removing)) and ((status <> '.self::STATUS_DELETED_REQUEST.')))',array(
            ':removing'=>$removing,
            ':removed'=>$removed
        ));

        if(is_null($request))
            throw new CHttpException('403','Пользователь не является Вашим другом');

        $request->status = self::STATUS_DELETED_REQUEST;

        if($request->save())
            return 1;

        else
            return 0;

    }

    public static function getUserFriends($user)
    {
        $requests =  UsersFriends::model()->findAll('((user_from=:user) or (user_to=:user)) and status = '.self::STATUS_FRIEND.'',array(
            ':user'=>$user,
        ));

        if(!empty($requests))
        {
            foreach($requests as $key=>$request)
            {
                $requests[$key] = Users::model()->findByPk(self::recognizeUserFriend($request));
            }
        }

        return $requests;

    }

    public static function getUserFriendsForProfile($user)
    {

        $criteria = new CDbCriteria();
        $criteria->limit = 6;
        $criteria->condition = '((user_from=:user) or (user_to=:user)) and status = '.self::STATUS_FRIEND.'';
        $criteria->params = array(
            ':user'=>$user,
        );

        $requests = UsersFriends::model()->findAll($criteria);

        if(!empty($requests))
        {
            foreach($requests as $key=>$request)
            {
                $requests[$key] = Users::model()->findByPk(self::recognizeUserFriend($request));
            }
        }

        return $requests;

    }

    public static function recognizeUserFriend(&$request)
    {
        $user_friend = $request->user_to;

        if($user_friend == Yii::app()->user->id)
            $user_friend = $request->user_from;

        return $user_friend;
    }

    public static function getRequest($from,$to)
    {

        $request = UsersFriends::model()->find('((user_from=:from and user_to=:to) or (user_from=:to and user_to=:from)) and status = '.self::STATUS_DELETED_REQUEST.'',array(
            ':from'=>$from,
            ':to'=>$to
        ));

        if(is_null($request))
            return new UsersFriends();

        else
            return $request;

    }

    public static function isFriends($user1,$user2)
    {
        if(UsersFriends::model()->exists('((user_from=:from and user_to=:to) or (user_from=:to and user_to=:from)) and (status = '.self::STATUS_FRIEND.')',array(
            ':from'=>$user1,
            ':to'=>$user2
        )))
            return 1;
        else
            return 0;
    }

    public static function getUserIncommingRequests($user)
    {
        return UsersFriends::model()->findAll('(user_to=:user and status = '.self::STATUS_NEW_REQUEST.') ',array(
            ':user'=>$user
        ));
    }

    public static function getUserIncommingFriends($user)
    {

        $fiends_requests = self::getUserIncommingRequests($user);
        $friends = array();

        foreach($fiends_requests as $key=>$friend)
        {

            $friend_id = $friend->user_from;

            if($friend_id == Yii::app()->user->id)
                $friend_id = $friend->user_to;

            $friends[$key] = Users::model()->findByPk($friend_id);

        }

        return $friends;
    }

    public static function getUsersAccountsByRequests($requests)
    {


        foreach($requests as $key=>$friend)
        {

            $friend_id = $friend->user_from;

            if($friend_id == Yii::app()->user->id)
                $friend_id = $friend->user_to;

            $friends[$key] = Users::model()->findByPk($friend_id);

        }

        if(is_null($friends))
            $friends = array();

        return $friends;
    }
}
