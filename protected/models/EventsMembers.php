<?php

/**
 * This is the model class for table "events_members".
 *
 * The followings are the available columns in table 'events_members':
 * @property integer $id
 * @property integer $user
 * @property integer $event
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Events $event0
 * @property Users $user0
 */
class EventsMembers extends CActiveRecord
{

    const STATUS_INVITED = 0;
    const STATUS_JOINED = 1;
    const STATUS_LEAVED = 2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'events_members';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user, event, status', 'required'),
			array('user, event, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user, event, status', 'safe', 'on'=>'search'),
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
			'event0' => array(self::BELONGS_TO, 'Events', 'event'),
			'user0' => array(self::BELONGS_TO, 'Users', 'user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user' => 'User',
			'event' => 'Event',
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
		$criteria->compare('user',$this->user);
		$criteria->compare('event',$this->event);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EventsMembers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getInvitesAndPages($user)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'user=:user and status = 0';
        $criteria->params = array('user'=>$user);
        $criteria->order = 'id desc';

        $pages=new CPagination(self::model()->count($criteria));
        $pages->pageSize=10;
        $pages->applyLimit($criteria);

        $ret['pages'] = $pages;
        $ret['invites'] = self::model()->findAll($criteria);

        return $ret;
    }

}
