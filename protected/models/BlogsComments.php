<?php

/**
 * This is the model class for table "blogs_comments".
 *
 * The followings are the available columns in table 'blogs_comments':
 * @property integer $id
 * @property integer $user
 * @property string $text
 * @property string $time
 *
 * The followings are the available model relations:
 * @property Users $user0
 */
class BlogsComments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'blogs_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user, text, time, blog_message', 'required'),
			array('user, blog_message', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user, text, time, blog_message', 'safe', 'on'=>'search'),
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
		$criteria->compare('user',$this->user);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('blog_message',$this->blog_message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlogsComments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

  public static function getBlogComments($blog)
  {
    $criteria = new CDbCriteria;
    $criteria->condition = 'blog_message =:blog';
    $criteria->order = 'time asc';
    $criteria->params = array(':blog'=>$blog);
    $pages = new CPagination(self::model()->count($criteria));
    $pages->pageSize = 10;
    $pages->applyLimit($criteria);
    $comments = self::model()->findAll($criteria);
    $ret = array();
    $ret['pages'] = $pages;
    $ret['comments'] = $comments;

    return $ret;
  }
}
