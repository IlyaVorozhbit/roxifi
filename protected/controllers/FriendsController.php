<?php

class FriendsController extends Controller
{

    public $defaultAction = 'FriendList';

	public function actionAccept($id)
	{
		if(UsersFriends::acceptRequest($id,Yii::app()->user->id))
            echo 'Заявка принята';
        else
            echo 'Произошла ошибка';
	}

	public function actionAdd($id)
	{

        if(UsersFriends::sendRequest(Yii::app()->user->id,$id))
            echo 'success';

        else
            echo 'failed';

	}

	public function actionDelete($id)
	{

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

        foreach($friends as $key=>$friend)
        {

            $friend_id = $friend->user_from;

            if($friend_id == Yii::app()->user->id)
                $friend_id = $friend->user_to;

            $friends[$key] = Users::model()->findByPk($friend_id);

        }

		$this->render('FriendList',array(
            'friends'=>$friends,
            'pages'=>$pages
        ));

	}

	public function actionReject($id)
	{
        if(UsersFriends::rejectRequest($id,Yii::app()->user->id))
            echo 'Заявка отклонена';
        else
            echo 'Произошла ошибка';
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