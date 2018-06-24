<form class="form-login text-center" action="<?=base_url("/user/logining")?>" method="post">
	<h1 class="h3 mb-3 font-weight-normal">會員登入</h1>
	<input type="text" class="form-control" id="userid" name="userid" value="<?=$userid?>" placeholder="User Id" required autofocus>
	<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
	
	<button class="btn btn-lg btn-secondary btn-block mt-3" type="submit">登入</button>
</form>