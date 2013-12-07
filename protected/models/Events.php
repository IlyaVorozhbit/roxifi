<?php

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $time
 *
 * The followings are the available model relations:
 * @property EventsMembers[] $eventsMembers
 * @property EventsRights[] $eventsRights
 */
class Events extends CActiveRecord
{

    const USER_JOINED = 1;
    const USER_LEFT = 2;
    const USER_INVITED = 0;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'events';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, time', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, time', 'safe', 'on'=>'search'),
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
			'eventsMembers' => array(self::HAS_MANY, 'EventsMembers', 'event'),
			'eventsRights' => array(self::HAS_MANY, 'EventsRights', 'event'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::t('events','Name'),
			'description' => Yii::t('events','Description'),
			'time' => Yii::t('events','Date')
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('time',$this->time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Events the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getEventsAndPages()
    {
        $criteria=new CDbCriteria;
        $criteria->order = 'id desc';
        $pages=new CPagination(Events::model()->count($criteria));
        $pages->pageSize=10;
        $pages->applyLimit($criteria);

        $ret['pages'] = $pages;
        $ret['events'] = Events::model()->findAll($criteria);

        return $ret;
    }

    public static function getUserEventsAndPages()
    {
        $criteria=new CDbCriteria;
        $criteria->condition = 'user=:user and status =:status';
        $criteria->params = array(
            ':user'=>Yii::app()->user->id,
            ':status'=>Events::USER_JOINED
        );
        $criteria->with = 'event0';

        $pages=new CPagination(EventsMembers::model()->count($criteria));
        $pages->pageSize=10;
        $pages->applyLimit($criteria);

        $ret['pages'] = $pages;
        $ret['events'] = EventsMembers::model()->findAll($criteria);

        return $ret;
    }

    public static function getEventMembersAndPages($event)
    {
        $criteria=new CDbCriteria;
        $criteria->order = 't.id desc';
        $criteria->condition = 'event=:event and status=:status';
        $criteria->params = array(
            ':event'=>$event,
            ':status'=>Events::USER_JOINED,
        );
        $criteria->with = 'user0';
        $pages=new CPagination(EventsMembers::model()->count($criteria));
        $pages->pageSize=10;
        $pages->applyLimit($criteria);

        $ret['pages'] = $pages;
        $ret['members'] = EventsMembers::model()->findAll($criteria);

        return $ret;
    }

    public static function joinUserToEvent($user,$event)
    {
        $event_member = EventsMembers::model()->find('user=:user and event=:event and status=:status',array(
            ':event'=>$event,
            ':user'=>$user,
            ':status'=>self::USER_LEFT
        ));

        if(is_null($event_member))
            $event_member = new EventsMembers();

        $event_member->user = $user;
        $event_member->status = 1;
        $event_member->event = $event;
        $event_member->save();

        if($event_member->save())
            return 1;
    }

    public static function leaveEvent($user,$event)
    {

        $event_member = EventsMembers::model()->find('user=:user and event=:event',array(
            ':user'=>$user,
            ':event'=>$event,
        ));

        if(is_null($event_member))
            throw new CHttpException(404,'Record not found.');

        $event_member->status = self::USER_LEFT;

        if($event_member->save())
            return 1;
    }

    public static function isMember($user,$event)
    {
        return EventsMembers::model()->exists('user=:user and event=:event and status=:status',array(
            ':event'=>$event,
            ':user'=>$user,
            ':status'=>self::USER_JOINED,
        ));
    }

    public static function isMemberOrInvited($user,$event)
    {
        return EventsMembers::model()->exists('user=:user and event=:event and (status=:status or status=:invited)',array(
            ':event'=>$event,
            ':user'=>$user,
            ':status'=>self::USER_JOINED,
            ':invited'=>self::USER_INVITED,
        ));
    }
}
