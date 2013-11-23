<?php
  class Language
  {
    public $lang = 'ru';
    private $pt = 'lang/';

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

    public function Translate($str)
    {
      $file = $this->pt.$this->lang.'.conf';
      $res = 'error';
      if (file_exists($file))
      {
        $arr = parse_ini_file($file);
        return isset($arr[$str]) ? $arr[$str] : $str;
      }
      return $res;
    }
  }
?>
