<div class="phunit-summary<?php if(!$this -> result -> isPass()):?> phunit-summary-fail<?php endif;?>">
	<dl class="phunit-summary-count">
		<dt>Tests run</dt>
		<dd><?php echo $this -> result -> countAll();?></dd>
	</dl>
	<dl class="phunit-summary-failures">
		<dt>Failures</dt>
		<dd><?php echo $this -> result -> countFails();?></dd>
	</dl>
	<dl class="phunit-summary-passes">
		<dt>Passes</dt>
		<dd><?php echo $this -> result -> countPasses();?></dd>
	</dl>
</div>