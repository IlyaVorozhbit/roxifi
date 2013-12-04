<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $id
 * @property integer $dialog
 * @property integer $sender
 * @property integer $recipient
 * @property string $text
 * @property string $time
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Users $recipient0
 * @property Dialogs $dialog0
 * @property Users $sender0
 */
class Messages extends CActiveRecord
{

    const STATUS_NEW = 0;
    const STATUS_READED = 1;
    const STATUS_DELETED_FROM_RECIPIENT = 2;
    const STATUS_DELETED_FROM_SENDER = 3;
    const STATUS_DELETED_FROM_ALL = 4;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dialog, sender, recipient, text, time', 'required'),
			array('dialog, sender, recipient', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dialog, sender, recipient, text, time', 'safe', 'on'=>'search'),
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
			'recipient0' => array(self::BELONGS_TO, 'Users', 'recipient'),
			'dialog0' => array(self::BELONGS_TO, 'Dialogs', 'dialog'),
			'sender0' => array(self::BELONGS_TO, 'Users', 'sender'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dialog' => 'Dialog',
			'sender' => 'Sender',
			'recipient' => 'Recipient',
			'text' => 'Text',
			'time' => 'Time',
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
		$criteria->compare('dialog',$this->dialog);
		$criteria->compare('sender',$this->sender);
		$criteria->compare('recipient',$this->recipient);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('time',$this->time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Messages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function deleteMessage($message)
    {

        if($message->status == 2 or $message->status == 3)
            $message->status = 4;
        else
        {
            if($message->status==0)
                $message->status = 5;
            else
            {
                if ($message->sender == Yii::app()->user->id)
                    $message->status = 3;
                elseif ($message->recipient == Yii::app()->user->id)
                    $message->status = 2;
            }

        }

        $message->save();

    }

    public static function makeMessagesReaded($messages)
    {
        foreach($messages as $key => $message)
        {
            if($message->recipient == Yii::app()->user->id)
            {
                if($message->status != 3)
                {
                    $message->status = 1;
                    $message->save();
                }
            }
        }
    }

    public function findByPk($pk,$condition='',$params=array())
    {
        Yii::trace(get_class($this).'.findByPk()','system.db.ar.CActiveRecord');
        $prefix=$this->getTableAlias(true).'.';
        $criteria=$this->getCommandBuilder()->createPkCriteria($this->getTableSchema(),$pk,$condition,$params,$prefix);
        $result = $this->query($criteria);

        if(is_null($result))
            throw new CHttpException('404','not found');

        return $result;
    }

}
