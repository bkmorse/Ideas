<?=form_open()?>
<p>Username: <?=form_input('username')?></p>

<p>Password: <?=form_password('password')?></p>

<p><?=form_submit('signup', 'Create')?> <?=form_submit('login', 'Login')?></p>
<?=form_close()?>