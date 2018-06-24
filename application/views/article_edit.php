<form action="<?=base_url("article/editing")?>" method="post" > 
	<input type="hidden" name="articleid" value="<?=$article->articleid?>" />
	<div class="form-group">
	    <label for="title">標題</label>
	    <input type="text" class="form-control" id="title" name="title" value="<?=htmlspecialchars($article->title)?>">
  	</div>
	<div class="form-group">
		<label for="content">內容</label>
		<textarea class="form-control" id="content" name="content" rows="10"><?=htmlspecialchars($article->content)?></textarea>
	</div>
	<button type="submit" class="btn btn-lg btn-secondary btn-block">修改</button>
</form>