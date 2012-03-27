<ul class="phunit-cases">
	<?php foreach($this -> result -> getCaseResults() as $case):?>
		<?php $id = preg_replace("/\./", "-", $case -> getName());?>
		<li class="test<?php if(!$case -> isPass()):?> phunit-fail<?php endif;?>">
			<a href="#<?php echo $id;?>"><?php echo $case -> getName();?></a>
			<div class="phunit-case-results">
				<dl class="phunit-case-results-count">
					<dt>Test methods</dt>
					<dd><?php echo $case -> countAll();?></dd>
				</dl>
				<dl class="phunit-case-results-failures">
					<dt>Failures</dt>
					<dd><?php echo $case -> countFails();?></dd>
				</dl>
				<dl class="phunit-case-results-passes">
					<dt>Passes</dt>
					<dd><?php echo $case -> countPasses();?></dd>
				</dl>
			</div>
		</li>
	<?php endforeach;?>
</ul>