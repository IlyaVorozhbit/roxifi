<div class="record">
  <div class="author">
    <?php
      $lang = new Language;
      preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $record->time, $arr);
      $record->time = ($lang->lang == 'ru' ? $arr[3].'.'.$arr[2] : $arr[2].'.'.$arr[3]) .'.'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
    ?>
    <a href="/u<?php echo $record->user_from;?>"><?php echo $authors[$record->user_from]->login;?></a>, <!--сегодня в--> <?php echo $record->time;?>.
  </div>
  <div class="message">
    <?php echo $record->text;?>
  </div>
</div>
