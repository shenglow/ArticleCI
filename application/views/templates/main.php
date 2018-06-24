<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="<?=base_url("assets/css/bootstrap.min.css")?>" />
		<link rel="stylesheet" href="<?=base_url("assets/css/main.css")?>" />
        <title><?=$title?></title>
    </head>
 
    <body>
    	<?=$navbar?>
		<div class="container">
			<?php if (isset($Message)) {?>
			<div class="alert alert-success">
				<?=$Message?>
			</div>
			<?php } ?>

			<?php if (isset($errorMessage)) {?>
			<div class="alert alert-danger">
				<?=$errorMessage?>
			</div>
			<?php } ?>
			
			<?=$content?>
		</div>
    </body>  
</html>