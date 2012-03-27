<ul class="phunit-results">
	<?php foreach($this -> result -> getCaseResults() as $case):?>
		<?php $id = preg_replace("/\./", "-", $case -> getName());?>
		<li>
			<h3 id="<?php echo $id;?>"><?php echo $case -> getName();?></h3>
			<ul>
				<?php foreach($case -> getMethodResults() as $method):?>
					<li class="log<?php if(!$method -> isPass()):?> phunit-fail<?php endif;?>">
						<div class="test"><?php echo $method -> getName();?></div>
						<div class="message"><?php echo $method -> getMessage();?></div>
					</li>
				<?php endforeach;?>
			</ul>
		</li>
	<?php endforeach;?>
</ul>