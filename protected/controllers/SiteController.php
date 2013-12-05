<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionLogin()
	{
		$model=new LoginForm;

		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];

			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}

		$this->render('login',array('model'=>$model));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionRegister()
    {
        $model = new Users();

        if(isset($_POST['Users']))
        {

            $model->attributes=$_POST['Users'];

            if($model->save())
            {
                $model->sendRegisterMessage($model->email,$model->generateRegisterHash());
                $this->render('register_success');
                die();
            }

        }

        $this->render('register',array(
            'model'=>$model
        ));



    }

    public function actionVerify($hash)
    {
        $hash = UsersRegistryHash::model()->find('hash=:hash',array(
            ':hash'=>$hash
        ));

        if(!is_null($hash))
        {
            $hash->delete();
            $this->render('email_confirmed');
        }

    }

    public function actionFeedback()
    {
        $this->render('feedback');
    }


}
