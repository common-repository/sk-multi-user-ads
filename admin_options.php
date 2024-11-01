<div class='wrap muad'>
	<h2>SK Multi User Ads</h2>
    <h4>Displays user's ads on their own articles.</h4>
	
	<form method='POST'>
	<?php if($this->message != ''){		
		echo '<div style="border:2px #0f0 solid; margin:10px; padding:20px">'.$this->message.'</div>';
		}?>
	<?php if($this->errorMessage != ''){		
		echo '<div style="border:2px #f00 solid; margin:10px; padding:20px"><h3>Error:</h3>'.$this->errorMessage.'</div>';
		}?>
	<fieldset style="margin-top:15px; border:2px #000 solid; padding:15px;">
		<legend style="padding:5px;border:2px #000 solid;"><b>Settings</b></legend>
		<div style="padding:5px;border:1px #777 solid;">
			<p>
				<label style="margin-left:20px;" for="minimum_user_level">Min user level to display own ads:</label>
				<select name="minimum_user_level">
					<?php
						for($i = 1; $i <= 10; $i++){
							echo '<option value="'.$i.'" '.(($this->settings['minimum_user_level'] == $i)? 'selected="selected"': '').'>'.$i.'</option>';
						}
					?>
				</select>
			</p>
			<p>
				<label style="margin-left:20px;" for="default_top_ad">Default top ad:</label>
				<textarea id="default_top_ad" name="default_top_ad" cols="50" rows="6"><?php echo $this->settings['default_top_ad']; ?></textarea>
			</p>
			<p>
				<label style="margin-left:20px;" for="top_wrap_before">Before top ad:</label>
				<textarea id="top_wrap_before" name="top_wrap_before" cols="50" rows="3"><?php echo $this->settings['top_wrap_before']; ?></textarea>
			</p>
			<p>
				<label style="margin-left:20px;" for="top_wrap_after">After top ad:</label>
				<textarea id="top_wrap_after" name="top_wrap_after" cols="50" rows="3"><?php echo $this->settings['top_wrap_after']; ?></textarea>
			</p>
			<p>
				<label style="margin-left:20px;" for="default_bottom_ad">Default bottom ad:</label>
				<textarea id="default_bottom_ad" name="default_bottom_ad" cols="50" rows="6"><?php echo $this->settings['default_bottom_ad']; ?></textarea>
			</p>
			<p>
				<label style="margin-left:20px;" for="bottom_wrap_before">Before bottom ad:</label>
				<textarea id="bottom_wrap_before" name="bottom_wrap_before" cols="50" rows="3"><?php echo $this->settings['bottom_wrap_before']; ?></textarea>
			</p>
			<p>
				<label style="margin-left:20px;" for="bottom_wrap_after">After bottom ad:</label>
				<textarea id="bottom_wrap_after" name="bottom_wrap_after" cols="50" rows="3"><?php echo $this->settings['bottom_wrap_after']; ?></textarea>
			</p>
    </fieldset>
    <fieldset style="margin-top:15px; border:2px #000 solid; padding:15px;">
        <legend style="padding:5px;border:2px #000 solid;"><b>Apply settings</b></legend>
			<p style="text-align:right;">
				<input type="submit" name="muad_submit" />
			</p>
		</div>
	</fieldset>
	</form>
</div>