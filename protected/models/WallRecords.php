<?php

/**
 * This is the model class for table "wall_records".
 *
 * The followings are the available columns in table 'wall_records':
 * @property integer $id
 * @property integer $user_from
 * @property integer $user_to
 * @property integer $text
 * @property string $time
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Users $userTo
 * @property Users $userFrom
 */
class WallRecords extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wall_records';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_from, user_to, text, time, status', 'required'),
			array('user_from, user_to, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_from, user_to, text, time, status', 'safe', 'on'=>'search'),
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
			'userTo' => array(self::BELONGS_TO, 'Users', 'user_to'),
			'userFrom' => array(self::BELONGS_TO, 'Users', 'user_from'),
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
			'text' => 'Text',
			'time' => 'Time',
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
		$criteria->compare('text',$this->text);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WallRecords the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
