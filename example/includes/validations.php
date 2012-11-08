<?php if(isset($errors) && count($errors)):?>
	<ul id="valerrors">
		<?php foreach($errors as $error):?>
			<li class="valerror"><?php echo $error;?></li>
		<?php endforeach;?>
	</ul>
<?php endif;?>