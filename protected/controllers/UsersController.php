<?php

class UsersController extends Controller
{
  public $defaultAction = 'Profile';

	public function actionFriends()
	{
		$this->render('Friends');
	}

  public function actionEdit($id)
  {
    if ($id == Yii::app()->user->id)
    {
      if (isset($_GET['delete_image']))
      {
        $model = UsersImages::model()->find('user = :user', array(':user'=>Yii::app()->user->id));
        if ($model !== NULL)
        {
          $filename = 'avatars/u'.Yii::app()->user->id.'/'.$model->filename;
          unlink($filename);
          $model->delete();
        }
        header('Location: /u'.Yii::app()->user->id.'/edit');
      }
    }
    else
      header('Location: /');
    if (isset($_POST['Infos']))
    {
      foreach($_POST['Infos'] as $key => $field)
      {
        if ($field != '')
        {
          $model = UsersInfo::model()->find('user = :user AND field = :field', array(':user'=>Yii::app()->user->id,
                                                                                     ':field'=>$key));
          if ($model === NULL)
          {
            $model = new UsersInfo;
            $model->user = Yii::app()->user->id;
          }
          $model->value = $field;
          $model->field = $key;
          $model->save();
        }
      }
    }
    if (isset($_POST['Users']))
    {
      $model = Users::model()->findByPk($id);
      $model->language = $_POST['Users']['language'];
      $model->save();
    }
    if (isset($_POST['UsersImages']))
    {
      $model = UsersImages::model()->find('user = :user', array(':user'=>Yii::app()->user->id));
      if ($model === NULL)
      {
        $model = new UsersImages;
        $model->user = Yii::app()->user->id;
      }
      $model->attributes = $_POST['UsersImages'];
      $model->image = CUploadedFile::getInstance($model, 'filename');
      if ($model->image !== NULL)
      {
        $dirname = 'avatars/u'.Yii::app()->user->id.'/';
        if (!file_exists($dirname))
          mkdir($dirname);
        else
        {
          $op_dir = opendir($dirname);
          while($file = readdir($op_dir))
           if ($file != '.' && $file != '..') 
             unlink($dirname.$file);
          closedir($op_dir);
        }
        $model->image->saveAs('avatars/u'.Yii::app()->user->id.'/'.$model->image->name);
        $model->filename = $model->image->name;
        $model->save();
      }
    }
    $this->render('Edit', array(
      'user'=>Users::model()->with('usersInfos')->findByPk($id),));
  }

  public function actionWrec($id)
  {
    if (isset($_GET['delete']) && isset($_GET['record_id']))
    {
      $model = WallRecords::model()->findByPk($_GET['record_id']);
      if ($model !== NULL && ($model->user_from == Yii::app()->user->id ||
                              $model->user_to == Yii::app()->user->id))
		    $model->delete();
      header('Location: /u'.$id);
    }
  }

	public function actionNotes($id)
	{
    if ($id == Yii::app()->user->id)
    {
      $model = new Notes();

      if (isset($_POST['Notes']))
      {
        if (isset($_POST['Notes']['id']))
          $model = Notes::model()->findByPk($_POST['Notes']['id']);
        $model->attributes = $_POST['Notes'];
        $model->creator = Yii::app()->user->id;
        $model->time = date('Y-m-d H:i:s',time());
        $model->save() or die(print_r($model->getErrors()));
        header('Location: notes');
      }
      if (isset($_GET['delete']) && isset($_GET['note_id']))
      {
        $model = Notes::model()->findByPk($_GET['note_id']);
        if ($model !== NULL && $model->creator == Yii::app()->user->id)
          $model->delete();
        header('Location: notes');
      }
   
      $criteria=new CDbCriteria;
      $criteria->condition = 'creator =:user';
      $criteria->order = 'time desc';
      $criteria->params = array(':user'=>$id);
      $pages=new CPagination(Notes::model()->count($criteria));
      $pages->pageSize = 10;
      $pages->applyLimit($criteria);

      $notes = Notes::model()->findAll($criteria);
      $this->render('Notes', array(
              'user'=>Users::model()->with('usersInfos')->findByPk($id),
              'notes'=>$notes,
              'pages'=>$pages,));
    }
    else
      header('Location: /u'.$id); 
	}

	public function actionProfile($id)
	{
        if (isset($_POST['WallRecords']))
            WallRecords::sendRecordTo(new WallRecords(),$id);

        $wallRecords = WallRecords::getUserRecords($id);

        $this->render('Profile',array(
            'user'=>Users::model()->with('usersInfos')->findByPk($id),
            'friends'=>UsersFriends::getUserFriendsForProfile($id),
            'wallRecords'=>$wallRecords['records'],
            'pages'=>$wallRecords['pages'],
            'model'=>new WallRecords()
        ));
	}

	public function actionSearch()
	{
		$this->render('Search');
	}

}
