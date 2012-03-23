<?php if(isset($messages) && count($messages)):?>
	<ul id="messages">
		<?php foreach($messages as $message):?>
			<li class="message-<?php echo $message["type"];?>"><?php echo $message["text"];?></li>
		<?php endforeach;?>
	</ul>
<?php endif;?>