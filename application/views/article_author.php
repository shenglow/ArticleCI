<?php foreach ($results as $article) { ?>
<div class="card mb-3">
	<div class="card-header">
		<a href="<?=base_url("article/view/".$article->articleid)?>">
			<?=htmlspecialchars($article->title)?>
		</a>
	</div>
	<div class="card-body">
		<p class="card-text">
			<?php
				$content = htmlspecialchars($article->content);
				if (mb_strlen($content) > 200) {
					echo nl2br(mb_substr($content,0,200,'utf-8')).'...';
				} else {
					echo nl2br($content);
				}
			?>
		</p>
		<?php 
			if(isset($_SESSION["user"]) && $_SESSION["user"] != null && $_SESSION["user"]->userid == $article->userid) { ?>
			<hr class="my-4">
			<a class="btn btn-secondary btn-md" href="<?=base_url("article/edit/".$article->articleid)?>" role="button">編輯此文章</a>
			<a class="btn btn-secondary btn-md" href="<?=base_url("article/del/".$article->articleid)?>" role="button">刪除此文章</a>
		<?php } ?>
	</div>
</div>
<?php } ?>

<?=$pageLinks?>