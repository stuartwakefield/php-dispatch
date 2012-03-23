<?php if($this -> subject -> hasErrors()):?>
	<ul class="valerrors">
		<?php foreach($this -> subject -> getErrors() as $error):?>
			<li class="valerror-<?php $error -> getType();?>"><?php echo $error -> getMessage();?></li>
		<?php endforeach;?>
	</ul>
<?php endif;?>