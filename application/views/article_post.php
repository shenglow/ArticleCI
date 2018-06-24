<form action="<?=base_url("article/posting")?>" method="post"> 
	<div class="form-group">
	    <label for="title">標題</label>
	    <input type="text" class="form-control" id="title" name="title" value="<?=$title?>">
  	</div>
	<div class="form-group">
		<label for="content">內容</label>
		<textarea class="form-control" id="content" name="content" rows="10"><?=$content?></textarea>
	</div>
	<button type="submit" class="btn btn-lg btn-secondary btn-block">發文</button>
</form>