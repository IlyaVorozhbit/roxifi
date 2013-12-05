<?php
  class Language
  {
    public $lang = 'ru';

    function Language()
    {
      try
      {
        if (Yii::app()->user->id !== NULL)  
          $this->lang = Users::model()->findbyPk(Yii::app()->user->id)->language;
        else
          $this->lang = 'ru';
      }
      catch(Exception $e)
      {
        $this->lang = 'ru';
      }
    }
  }
?>
