<?php if(count($hotArticles) == 0 || count($hotUsers) == 0) { ?>
	<div class="jumbotron">
		<h1 class="display-4">目前尚未有任何文章</h1>
		<a class="btn btn-secondary btn-lg" href="<?=base_url("article/post")?>" role="button">分享文章</a>
	</div>
<?php } else{ ?>
	<div class="my-3 p-3 bg-white rounded box-shadow">
		<h2 class="border-bottom pb-2 mb-0">熱門文章</h2>
		<?php foreach ($hotArticles as $article) { ?>
		<div>
			<p class="pt-3 pb-3 mb-0 border-bottom">
				<strong class="d-block">
					<a href="<?=base_url("article/view/".$article->articleid)?>">
						<?=htmlspecialchars($article->title)?>
					</a>
				</strong>
				<?=htmlspecialchars($article->content)?>
			</p>
		</div>
		<?php } ?>
	</div>

	<div class="my-3 p-3 bg-white rounded box-shadow">
		<h2 class="border-bottom pb-2 mb-0">熱門作者</h2>
		<?php foreach ($hotUsers as $user) { ?>
		<div>
			<p class="pt-3 pb-3 mb-0 border-bottom">
				<strong class="d-block">
					<a href="<?=base_url("article/author/".$user->userid)?>">
						<?=htmlspecialchars($user->username)?>
					</a>
				</strong>
				文章最高點閱次數:<?=htmlspecialchars($user->view)?>
			</p>
		</div>
		<?php } ?>
	</div>
<?php } ?>