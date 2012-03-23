<?php include "header.inc";?>
<?php include "validations.inc";?>
<form id="add_tree" action="<?php echo $context -> buildUrl("addtree");?>" method="post">
	<dl class="field">
		<dt><label for="add_tree_name">Name your tree</label></dt>
		<dd><input id="add_tree_name" name="name" type="text" value="<?php echo htmlspecialchars($name);?>"/></dd>
	</dl>
	<dl class="field">
		<dt>Add coordinates for your tree</dt>
		<dd><label for="add_tree_coords_lat">Latitude</label><input id="add_tree_coords_lat" name="coords_lat" type="text" value="<?php echo htmlspecialchars($coordsLat);?>"/></dd>
		<dd><label for="add_tree_coords_long">Longitude</label><input id="add_tree_coords_long" name="coords_long" type="text" value="<?php echo htmlspecialchars($coordsLong);?>"/></dd>
	</dl>
	<button type="submit">Add tree</button>
	<a class="cancel" href="<?php echo $context -> buildUrl("home");?>">Cancel</a>
</form>
<?php include "footer.inc";?>