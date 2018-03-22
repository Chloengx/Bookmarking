<form method = "get">
	<fieldset>
		
		<?php 
			if ($verif == "mdp"){
				echo '<div class= "alert alert-danger text-center"> ';
				echo "$message";
				echo '</div>';
			} 
			elseif ($verif == "email"){
				echo '<div class= "alert alert-danger text-center"> ';
				echo "$message";
				echo '</div>';
			}
		?>


		<legend class="text-center"><h3><b> <?php echo $todo; ?></b> </h3></legend>
		<input type='hidden' name = 'action' value=<?php echo $action ?>>
		<input type="hidden" name="controller" value=<?php echo $controller?>>

		<div class="row">
		<p class="col-lg-7 col-lg-push-3">
			Les champs * sont obligatoire <br><br>
			<label for="login_id">* Login :</label>
			<input type="text" value="<?php echo $user->get('email');?>" name="email" id="login_id" placeholder="e.g: abc@yopmail.com" required/>
		</p>
		</div>

		<div class="row">
		<p class="col-lg-7 col-lg-push-3">
			<label for="pseudo_id">* Pseudo :</label>
			<input type="text" value="<?php echo $user->get('pseudo');?>" name="pseudo" id="pseudo_id" required/>
		</p>
		</div>

        <div class="row">
		<p class="col-lg-7 col-lg-push-3">
			<label for="mdp_id">* Créez un mot de passe :</label>
			<input type="password" name="mdp" id="mdp_id" size="15" placeholder="e.g: 123456" required/>
		</p>
		</div>

		<div class="row">
		<p class="col-lg-7 col-lg-push-3">
			<label for="verif_mdp_id">* Confirmez votre mot de passe :</label>
			<input type="password" name="verif_mdp" id="verif_mdp_id" size = "10" placeholder="e.g: 123456" required/>
		</p>
		</div>

		<p class="text-center">
			<input type="submit" class=" btn btn-basic" value="Envoyer"/>
		</p>

	</fieldset>
</form>