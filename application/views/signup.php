<form class="form-signup" action="<?=base_url("/user/signuping")?>" method="post">
	<div class="form-group">
		<label for="userid"><font class="text-danger">*</font>帳號</label>
		<input type="text" class="form-control" id="userid" name="userid" value="<?=$userid?>" placeholder="User Id" required>
	</div>
	<div class="form-group">
		<label for="password"><font class="text-danger">*</font>密碼</label>
		<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
	</div>
	<div class="form-group">
		<label for="re-password"><font class="text-danger">*</font>確認密碼</label>
		<input type="password" class="form-control" id="re-password" name="re-password" placeholder="Re-type Password" required>
	</div>
    <div class="form-group">
        <label for="username"><font class="text-danger">*</font>姓名</label>
        <input type="text" class="form-control" id="username" name="username" value="<?=$username?>" placeholder="User Name" required>
    </div>
	<div class="form-group">
		<label for="email">電子信箱</label>
		<input type="text" class="form-control" id="email" name="email" value="<?=$email?>" placeholder="Email">
	</div>
	<button type="submit" class="btn btn-lg btn-secondary btn-block mt-3">註冊</button>
</form>