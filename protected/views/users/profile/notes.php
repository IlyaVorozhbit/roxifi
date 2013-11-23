<div class="record">
  <div class="author">
    <?php
      $lang = new Language;
      preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $note->time, $arr);
      $note->time = ($lang->lang == 'ru' ? $arr[3].'.'.$arr[2] : $arr[2].'.'.$arr[3]) .'.'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
    ?>
  </div>
  <div class="message">
    <?php echo $lang->Translate(15).': '.'<i>'.$note->time.'</i><br>'.$lang->Translate(11).': <i>'.$note->name.'</i><br>'.$lang->Translate(12).': <i>'.$note->text.'<i>';?>
  </div>
</div>
