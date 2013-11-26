<?php

class FriendsController extends Controller
{

    public $defaultAction = 'FriendList';

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('accept','add','delete','friendlist','reject'),
                'users'=>array('@'),
            ),

            array('deny',
                'users'=>array('*'),
            ),
        );
    }

	public function actionAccept($id)
	{

		if(UsersFriends::acceptRequest($id,Yii::app()->user->id))
            Yii::app()->user->setFlash('success', Yii::t('friends', 'Request has been approved'));
        else
            Yii::app()->user->setFlash('success', Yii::t('friends', 'An error occured'));

        $this->render('Accept');

	}

	public function actionAdd($id)
	{

        if(UsersFriends::sendRequest(Yii::app()->user->id,$id))
            Yii::app()->user->setFlash('success', Yii::t('friends', 'Request has been sent'));

        else
            Yii::app()->user->setFlash('fail', Yii::t('friends', 'An error occured'));

        $this->render('Add');

	}

	public function actionDelete($id)
	{

        if(UsersFriends::deleteFromFriends(Yii::app()->user->id,$id))
            Yii::app()->user->setFlash('success', Yii::t('friends', 'User removed from friends'));

        else
            Yii::app()->user->setFlash('fail', Yii::t('friends', 'An error occured'));

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

        $friends = UsersFriends::getUsersAccountsByRequests($friends);

		$this->render('FriendList',array(
            'friends'=>$friends,
            'requests'=>$requests,
            'pages'=>$pages
        ));

	}

	public function actionReject($id)
	{

        if(UsersFriends::rejectRequest($id,Yii::app()->user->id))
            Yii::app()->user->setFlash('success', Yii::t('friends', 'Request has been rejected'));
        else
            Yii::app()->user->setFlash('success', Yii::t('friends', 'An error occured'));

        $this->render('Reject');
	}

}