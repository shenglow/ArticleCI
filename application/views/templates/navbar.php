<nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-4">
	<a class="navbar-brand mr-auto" href="<?=base_url("/")?>">Home</a>
	<?php if(isset($_SESSION["user"]) && $_SESSION["user"] != null) { ?>
	<div>
		<a class="text-light bg-dark mr-3" href="<?=base_url("article/author/".$_SESSION["user"]->userid)?>"><?=$_SESSION["user"]->username?></a>
		<a class="btn btn-outline-light" href="<?=base_url("user/logout")?>">Logout</a>
		<a class="btn btn-outline-light" href="<?=base_url("article/post")?>">Post</a>
	</div>
	<?php }else{ ?> 
	<div>
		<a class="btn btn-outline-light" href="<?=base_url("user/login")?>">Login</a>
		<a class="btn btn-outline-light" href="<?=base_url("user/signup")?>">Sign up</a>
	</div>
	<?php } ?>
</nav>