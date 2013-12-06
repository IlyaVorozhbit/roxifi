<?php

/**
 * This is the model class for table "dialogs".
 *
 * The followings are the available columns in table 'dialogs':
 * @property integer $id
 * @property integer $creator
 * @property integer $invited
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Users $creator0
 * @property Users $invited0
 * @property Messages[] $messages
 */
class Dialogs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dialogs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('creator, invited, status', 'required'),
			array('creator, invited, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, creator, invited, status', 'safe', 'on'=>'search'),
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
			'creator0' => array(self::BELONGS_TO, 'Users', 'creator'),
			'invited0' => array(self::BELONGS_TO, 'Users', 'invited'),
			'messages' => array(self::HAS_MANY, 'Messages', 'dialog'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'creator' => 'Creator',
			'invited' => 'Invited',
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
		$criteria->compare('creator',$this->creator);
		$criteria->compare('invited',$this->invited);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dialogs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getUserDialogs($user)
    {
        $criteria=new CDbCriteria;
        $criteria->order = 'last_update desc';
        $criteria->condition = '(creator =:user or invited=:user) and (status = 1 or status = 5) and (SELECT count(*) from messages where (dialog =t.id and status <> '.Messages::STATUS_DELETED_FROM_ALL.') and ((sender=:user and status<>3) or (recipient=:user and status<>2)))';
        $criteria->params = array(':user'=>$user);
        $pages=new CPagination(Dialogs::model()->count($criteria));
        $pages->pageSize=10;
        $pages->applyLimit($criteria);

        $ret['pages'] = $pages;
        $ret['dialogs'] = Dialogs::model()->findAll($criteria);

        return $ret;
    }

    public static function getDialogMessages($dialog)
    {
        $criteria=new CDbCriteria;
        $criteria->condition = '(dialog =:dialog and status <> '.Messages::STATUS_DELETED_FROM_ALL.') and ((sender=:user and status<>3) or (recipient=:user and status<>2))';
        $criteria->order = 'time desc';
        $criteria->params = array(
            ':dialog'=>$dialog,
            ':user'=>Yii::app()->user->id,
        );
        $pages=new CPagination(Messages::model()->count($criteria));
        $pages->pageSize=10;
        $pages->applyLimit($criteria);

        $ret['pages'] = $pages;
        $ret['messages'] = Messages::model()->findAll($criteria);

        return $ret;
    }

    public static function getDialog($user1,$user2)
    {
        $dialog = Dialogs::model()->find('((creator=:user1 and invited=:user2) or (creator=:user2 and invited=:user1)) and status = 1',array(
            ':user1'=>$user1,
            ':user2'=>$user2,
        ));

        if(!is_null($dialog))
            return $dialog;

        $dialog = new Dialogs();
        $dialog->creator = $user1;
        $dialog->invited = $user2;
        $dialog->status = 1;

        if($dialog->save())
            return $dialog;
    }

    public static function WriteMessage($sender,$recipient,$text)
    {
        $dialog = self::getDialog($sender,$recipient);

        $message = new Messages();
        $message->dialog = $dialog->id;
        $message->sender = $sender;
        $message->recipient = $recipient;
        $message->text = CHtml::encode($message->text);
        $message->text = HTools::parseLink($message->text);
        $message->text = $text;
        $message->time = date('Y-m-d H:i:s',time());

        $dialog->last_update = date('Y-m-d H:i:s',time());
        if($message->save())
            if($dialog->save())
                return $dialog;
    }

    public function findByPk($pk,$condition='',$params=array())
    {
        Yii::trace(get_class($this).'.findByPk()','system.db.ar.CActiveRecord');
        $prefix=$this->getTableAlias(true).'.';
        $criteria=$this->getCommandBuilder()->createPkCriteria($this->getTableSchema(),$pk,$condition,$params,$prefix);

        $result = $this->query($criteria);

        if($result->creator != Yii::app()->user->id && $result->invited != Yii::app()->user->id)
            throw new CHttpException('403','Access denied');

        return $result;
    }


    public static function recognizeUserFriend(&$dialog)
    {
        $user_friend = $dialog->invited;

        if($user_friend == Yii::app()->user->id)
            $user_friend = $dialog->creator;

        return $user_friend;
    }

}
