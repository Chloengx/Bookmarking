<form method = "get">
	<fieldset>
		<legend class="text-center"><?php echo $todo; ?></legend>
		<input type='hidden' name = 'action' value=<?php echo $action ?>>
		<input type="hidden" name="controller" value=<?php echo $controller?>>
	
		<div class="row">
		<p class="col-lg-7 col-lg-push-3">
			<label for="url_id">Votre lien : </label>
			<input type="text" value="<?php echo $lien->get('url');?>" size="40" name="url" id="url_id" required/>
		</p>
		</div>

		<div class="row">
		<p class="col-lg-7 col-lg-push-3">
			<label for="description_id">Description : </label>
			<input type="text" value="<?php echo $lien->get('description');?>" size="45" name="description" id="description_id" required/>
		</p>
		</div>

		<div class="row">
		<p class="text-center">
			<input type="submit" class=" btn btn-basic" value="<?php echo $todo;?>"/>
		</p>
		</div>


	</fieldset>
</form>