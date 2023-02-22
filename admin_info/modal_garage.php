	<div id="add_house" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-body">
			<div class="alert alert-success">Add Grage</div>
            <form class="form-horizontal" method="POST" action="garage_save.php" enctype="multipart/form-data">
		
		<div class="control-group">
			<label class="control-label" for="inputEmail">Garage_Name:</label>
			<div class="controls">
			<input type="text" class="span4" id="inputEmail" name="guarage" width="20"  placeholder="Garage name" required>
			</div>
		</div>
		
		
			<div class="control-group">
			<label class="control-label" for="inputPassword">Location</label>
			<div class="controls">
			<select name="location_id">
			<option></option>
			<?php
			$cat_query = mysql_query("select * from location");
			while($cat_row = mysql_fetch_array($cat_query)){
			?>
			<option value="<?php echo $cat_row['location_id']; ?>"><?php echo $cat_row['location']; ?></option>
			<?php  } ?>
			</select>
		</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="inputEmail">Garage_desc:</label>
			<div class="controls">
	<input type="text"  class="span4" id="inputPassword" name="guarage_desc"  placeholder="garage_desc" required>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="inputPassword">service Price:</label>
			<div class="controls">
			<input type="text"  class="span4" id="inputPassword" name="price"  placeholder="Service_price" required>
			</div>
		</div>	
		<div class="control-group">
			<div class="controls">
			<button name="submit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Save</button>
			</div>
		</div>
    </form>					


		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
		</div>
    </div>
	
