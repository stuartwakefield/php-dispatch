<form id="add_tree" action="<?php echo $actionUrl;?>" method="post">
	<dl class="field">
		<dt><label for="add_tree_name">Name your tree</label></dt>
		<dd><input id="add_tree_name" name="name" type="text" value="<?php echo $name;?>"/></dd>
	</dl>
	<dl class="field">
		<dt>Coordinates</dt>
		<dd>
			<label for="add_tree_lat">Latitude</label>
			<input id="add_tree_lat" name="lat" type="text" value="<?php echo $lat;?>"/>
		</dd>
		<dd>
			<label for="add_tree_long">Longitude</label>
			<input id="add_tree_long" name="long" type="text" value="<?php echo $long;?>"/>
		</dd>
	</dl>
	<button type="submit">Add tree</button>
	<a class="cancel" href="<?php echo $cancelUrl;?>">Cancel</a>
</form>
