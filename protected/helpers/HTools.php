<?php

  class HTools
  {
    public static function parseLink($string)
    {
      $string = preg_replace('#((http)?://(\S)+[\.](\S)*[^\s.,> )\];\'\"!?])#is', "<a href='\\1'>\\1</a>", $string);
      return $string;
    }
  }

?>
