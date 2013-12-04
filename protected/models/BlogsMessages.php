<?php

/**
 * This is the model class for table "blogs_messages".
 *
 * The followings are the available columns in table 'blogs_messages':
 * @property integer $id
 * @property integer $user
 * @property string $name
 * @property string $text
 * @property string $time
 * @property integer $privacy
 */
class BlogsMessages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'blogs_messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user, name, text, privacy', 'required'),
			array('user, privacy', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user, name, text, time, privacy', 'safe', 'on'=>'search'),
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
			'user' => 'User',
			'name' => Yii::t('blog', 'Name'),
			'text' => Yii::t('blog', 'Text'),
			'time' => 'Time',
			'privacy' => Yii::t('blog', 'Privacy'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('privacy',$this->privacy);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlogsMessages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getMessagesAndPages($blogger_id)
    {

        $criteria=new CDbCriteria;
        $criteria->condition = 'user = :user';


        if(!UsersFriends::isFriends($blogger_id,Yii::app()->user->id))
            if(Yii::app()->user->id!=$blogger_id)
                $criteria->condition .= ' and privacy = 0';

        $criteria->order = 'time desc';
        $criteria->params = array(':user'=>$blogger_id);

        $pages=new CPagination(BlogsMessages::model()->count($criteria));
        $pages->pageSize=10;
        $pages->applyLimit($criteria);

        $ret['pages'] = $pages;
        $ret['messages'] = BlogsMessages::model()->findAll($criteria);

        return $ret;
    }

    public static function addMessage($model, $user)
    {
      if(Yii::app()->user->id == $_GET['id'])
      {
        $model->attributes = $_POST['BlogsMessages'];
        $model->text = nl2br($model->text);
        $model->user = Yii::app()->user->id;
        $model->time = date('Y-m-d H:i:s',time());
        $model->save() or die(print_r($model->getErrors()));

        if (isset($_POST['BlogsImages']))
        {
          $image = new BlogsImages;
          $image->attributes = $_POST['BlogsImages'];
          $image->image = CUploadedFile::getInstance($image, 'filename');
          $name = md5(time().$image->image->name).strstr($image->image->name,'.');
          $image->image->saveAs('bimages/'.$name);
          $image->filename = $image->image->name;
          $image->blog_message = $model->getPrimaryKey();
          $image->save();
        }
      }
    }

    public static function editMessage($record)
    {

        if(Yii::app()->user->id == $record->user)
        {
            $record->attributes = $_POST['BlogsMessages'];
            $record->text = nl2br($record->text);
            $record->save() or die(print_r($record->getErrors()));
        }

    }
}
