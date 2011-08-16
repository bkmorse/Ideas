<?=form_open()?>
<p>Email <?=form_input('email')?></p>
<p>Password <?=form_password('password')?></p>

<p><?=form_submit('signup', 'Signup')?></p>
<?=form_close()?>