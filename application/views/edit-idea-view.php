<?=form_open()?>

<p><?=form_label('Subject')?><br />
<?=form_error('subject')?>
<?=form_input('subject', $idea->subject)?></p>

<p><?=form_label('Body')?><br />
<?=form_error('body')?>
<?=form_textarea('body', $idea->body)?></p>

<p><?=form_submit('submit', 'Update')?></p>
<?=form_close()?>

<?php
foreach($ideas as $r): ?>
  <p><?=$r->subject.' '.$r->body.' '.anchor('add/edit/'.$r->id, 'edit').' | '.anchor('add/delete/'.$r->id, 'delete')?></p>
<?php endforeach; ?>
