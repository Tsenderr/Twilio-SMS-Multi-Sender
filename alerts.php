
		<?php if(!empty($messageBox) || !empty($_SESSION['msg']) ){ 
			if(empty($messageBox)){$messageBox = $_SESSION['msg'];}
		?>
		<div class="row" style="background-color:transparent">
			<div class="col-xs-12 alert alert-success fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php echo $messageBox; if($_SERVER['REQUEST_METHOD'] != "POST"){$_SESSION['msg'] = "";}?>
			</div>
		</div>
		<?php } ?>
		
		<?php if(!empty($errBox)){ ?>
		<div class="row" style="background-color:transparent">
			<div class="col-xs-12 alert alert-danger fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php echo $errBox; ?>
			</div>
		</div>
		<?php } ?>
		
		<?php if(!empty($infoBox)){ ?>
		<div class="row" style="background-color:transparent">
			<div class="col-xs-12 alert alert-info fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php echo $infoBox; ?>
			</div>
		</div>
		<?php } ?>
		
		<?php if(!empty($warBox)){ ?>
		<div class="row" style="background-color:transparent">
			<div class="col-xs-12 alert alert-warning fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php echo $warBox; ?>
			</div>
		</div>
		<?php } ?>