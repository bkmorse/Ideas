<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> 
<script type="application/javascript">
$(document).ready(function() {
$('#submit').click(function() {
var form_data = {
subject : $('.subject').val(),
body : $('.body').val(),
ajax : '1'
};
$.ajax({
url: "<?php echo site_url('add/ajax_check'); ?>",
type: 'POST',
async : false,
data: form_data,
success: function(msg) {
$('#message').html(msg);
}
});
return false;
});
});
</script>
</head>
<body>
  
  <div id="message">
  </div>
  
  <?=form_open()?>

  <p><?=form_label('Subject')?><br />
  <?=form_error('subject')?>
  <?=form_input('subject', '', 'class="subject"')?></p>

  <p><?=form_label('Body')?><br />
  <?=form_error('body')?>
  <?=form_textarea('body', '', 'class="body"')?></p>

  <p><?=form_submit('submit', 'Add Idea', 'id="submit"')?></p>
  <?=form_close()?>

</body>
</html>