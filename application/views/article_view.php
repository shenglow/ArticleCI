<div class="jumbotron content">
	<h1 class="display-4"><?=htmlspecialchars($article->title)?></h1>
	<p><?=htmlspecialchars($article->username)?></p>
	<hr class="my-2">
	<p><?=nl2br(htmlspecialchars($article->content))?></p>
	<?php 
		if(isset($_SESSION["user"]) && $_SESSION["user"] != null && $_SESSION["user"]->userid == $article->userid) { ?>
		<hr class="my-4">
		<a class="btn btn-secondary btn-md" href="<?=base_url("article/edit/".$article->articleid)?>" role="button">編輯此文章</a>
		<a class="btn btn-secondary btn-md" href="<?=base_url("article/del/".$article->articleid)?>" role="button">刪除此文章</a>
	<?php } ?>
</div>