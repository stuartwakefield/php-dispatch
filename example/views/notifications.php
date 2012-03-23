<?php if($presenter -> hasNotifications()):?>
	<ul class="messages">
		<?php foreach($presenter -> getNotifications() as $notification):?>
			<li class="message-<?php echo $notification -> getType();?>"><?php echo $notification -> getMessage();?></li>
		<?php endforeach;?>
	</ul>
<?php endif;?>