<?php

/**
 * This is the model class for table "materials_files".
 *
 * The followings are the available columns in table 'materials_files':
 * @property integer $id
 * @property integer $folder
 * @property integer $user
 * @property string $file
 * @property string $name
 * @property string $description
 * @property string $time
 */
class MaterialsFiles extends CActiveRecord
{

    public $F;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'materials_files';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('folder, user, file, name, description', 'required'),
			array('folder, user', 'numerical', 'integerOnly'=>true),
			array('file, name', 'length', 'max'=>255),
			array('time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, folder, user, file, name, description, time', 'safe', 'on'=>'search'),
            array('F', 'file'),
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
			'folder' => 'Folder',
			'user' => 'User',
			'file' => 'File',
			'name' => 'Name',
			'description' => 'Description',
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
		$criteria->compare('folder',$this->folder);
		$criteria->compare('user',$this->user);
		$criteria->compare('file',$this->file,true);
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
	 * @return MaterialsFiles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getUserFiles($user)
    {
        $criteria=new CDbCriteria;
        $criteria->condition = 'user =:user';
        $criteria->order = 'time desc';
        $criteria->params = array(
            ':user'=>$user,
        );

        return self::model()->findAll($criteria);
    }
}
