<?php

class FriendsController extends Controller
{

    public $defaultAction = 'FriendList';


    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('accept','add','delete','friendlist','reject'),
                'users'=>array('@'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	public function actionAccept($id)
	{

        $lang = new Language;

		if(UsersFriends::acceptRequest($id,Yii::app()->user->id))
            Yii::app()->user->setFlash('success', $lang->Translate(25));
        else
            Yii::app()->user->setFlash('success', $lang->Translate(31));

        $this->render('Accept');

	}

	public function actionAdd($id)
	{

        $lang = new Language;

        if(UsersFriends::sendRequest(Yii::app()->user->id,$id))
            Yii::app()->user->setFlash('success', $lang->Translate(24));

        else
            Yii::app()->user->setFlash('fail', 'an error occured');

        $this->render('Add');

	}

	public function actionDelete($id)
	{

        $lang = new Language;

        if(UsersFriends::deleteFromFriends(Yii::app()->user->id,$id))
            Yii::app()->user->setFlash('success', $lang->Translate(28));

        else
            Yii::app()->user->setFlash('fail', 'an error occured');

        $this->render('Delete');

	}

	public function actionFriendList()
	{

        $criteria=new CDbCriteria;
        $criteria->condition = '(user_to =:user or user_from=:user) and status = 1';
        $criteria->params = array(':user'=>Yii::app()->user->id);
        $pages=new CPagination(UsersFriends::model()->count($criteria));
        $pages->pageSize=10;
        $pages->applyLimit($criteria);

        $friends = UsersFriends::model()->findAll($criteria);
        $requests = UsersFriends::getUserIncommingFriends(Yii::app()->user->id);

        foreach($friends as $key=>$friend)
        {

            $friend_id = $friend->user_from;

            if($friend_id == Yii::app()->user->id)
                $friend_id = $friend->user_to;

            $friends[$key] = Users::model()->findByPk($friend_id);

        }


		$this->render('FriendList',array(
            'friends'=>$friends,
            'requests'=>$requests,
            'pages'=>$pages
        ));

	}

	public function actionReject($id)
	{

        $lang = new Language;

        if(UsersFriends::rejectRequest($id,Yii::app()->user->id))
            Yii::app()->user->setFlash('success', $lang->Translate(26));
        else
            Yii::app()->user->setFlash('success', $lang->Translate(31));

        $this->render('Reject');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}