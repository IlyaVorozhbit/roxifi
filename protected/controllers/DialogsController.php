<?php

class DialogsController extends Controller
{

    public $defaultAction = 'DialogList';

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('ban','view','dialoglist','sendmessage','deletemessage'),
                'users'=>array('@'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	public function actionBan()
	{
		$this->render('Ban');
	}

	public function actionView($id)
	{

        $model = new Messages();

        $dialog = Dialogs::model()->findByPk($id);
        if($dialog->creator != Yii::app()->user->id && $dialog->invited != Yii::app()->user->id)
            throw new CHttpException('403','Access denied');

        $messagesAndPages = Dialogs::getDialogMessages($dialog->id);
        $messages = $messagesAndPages['messages'];
        $pages = $messagesAndPages['pages'];

        $user_friend = $dialog->invited;

        if($user_friend == Yii::app()->user->id)
            $user_friend = $dialog->creator;

        if (isset($_POST['Messages']))
        {
            if(Dialogs::WriteMessage(Yii::app()->user->id,$user_friend,$_POST['Messages']['text']))
                Yii::app()->user->setFlash('success', $this->lang->Translate(41));
            $this->redirect('/dialogs/view/'.$id);
        }


        $user_friend = Users::model()->findByPk($user_friend);


        $this->render('View',array(
            'lang'=>$this->lang,
            'messages'=>$messages,
            'pages'=>$pages,
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
            'user_friend'=>$user_friend,
            'model'=>$model
        ));

        foreach($messages as $key => $message)
        {
            $message->status = 1;
            $message->save();
        }

	}

	public function actionDialogList()
	{
        $dialogsAndPages = Dialogs::getUserDialogs(Yii::app()->user->id);
        $dialogs = $dialogsAndPages['dialogs'];
        $pages = $dialogsAndPages['pages'];

		$this->render('DialogList',array(
            'lang'=>$this->lang,
            'dialogs'=>$dialogs,
            'pages'=>$pages,
        ));
	}

    public function actionSendMessage($id)
    {

        $model = new Messages();

        if (isset($_POST['Messages']))
        {
            if(is_object($dialog = Dialogs::WriteMessage(Yii::app()->user->id,$id,$_POST['Messages']['text'])))
                Yii::app()->user->setFlash('success', $this->lang->Translate(41));
                $this->redirect('/dialogs/view/'.$dialog->id);
            die();
        }

        $this->render('sendmessage',array(
            'model'=>$model,
            'lang'=>$this->lang,
            'user'=>Users::model()->findByPk($id)
        ));
    }

    public function actionDeleteMessage($id)
    {
        $message = Messages::model()->findByPk($id);

        if(is_null($message))
            throw new CHttpException('404','not found');

        Messages::deleteMessage($message);
        $this->redirect('/dialogs/view/'.$message->dialog);
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
