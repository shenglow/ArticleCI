<?php foreach ($results as $article) { ?>
<div class="card mb-3">
	<div class="card-header">
		<a href="<?=base_url("article/view/".$article->articleid)?>">
			<?=htmlspecialchars($article->title)?>
		</a>
	</div>
	<div class="card-body">
		<p class="card-text"><?=nl2br(htmlspecialchars($article->content))?></p>
		<?php 
			if(isset($_SESSION["user"]) && $_SESSION["user"] != null && $_SESSION["user"]->userid == $article->userid) { ?>
			<hr class="my-4">
			<a class="btn btn-secondary btn-md" href="<?=base_url("article/edit/".$article->articleid)?>" role="button">編輯此文章</a>
			<a class="btn btn-secondary btn-md" href="<?=base_url("article/del/".$article->articleid)?>" role="button">刪除此文章</a>
		<?php } ?>
	</div>
</div>
<?php } ?>

<p><?=$pageLinks?></p>