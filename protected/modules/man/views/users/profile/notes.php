<div class="record">
  <div class="author">
    <?php
      $lang = new Language;
      preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $note->time, $arr);
      $note->time = ($lang->lang == 'ru' ? $arr[3].'.'.$arr[2] : $arr[2].'.'.$arr[3]) .'.'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
    ?>
  </div>
  <div class="message">
    <?php
    echo $note->creator == Yii::app()->user->id ?
         '<a href="/u'.$note->creator.'/notes?note_id='.$note->id.'&delete"><img style="height: 30px; width: 30px;" src="/images/delete.png" align="right"/></a>'.
         '<a href="/u'.$note->creator.'/notes?note_id='.$note->id.'&edit"><img style="height: 30px; width: 30px;"  src="/images/edit.png" align="right"/></a>' : '';
    echo Yii::t('notes', 'Created').': '.'<i>'.$note->time.'</i><br>'.Yii::t('notes', 'Name').': <i>'.$note->name.'</i><br>'.Yii::t('notes', 'Content').': <i>'.$note->text.'</i>';?>
  </div>
</div>
<hr/>
