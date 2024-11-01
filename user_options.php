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
		<legend style="padding:5px;border:2px #000 solid;"><b>Settings for <?php echo $uname; ?></b></legend>
		<div style="padding:5px;border:1px #777 solid;">
			<p>
				<label style="margin-left:20px;" for="top_ad">Top ad:</label>
				<textarea id="top_ad" name="top_ad" cols="50" rows="6"><?php echo stripslashes($top_ad); ?></textarea>
			</p>
			<p>
				<label style="margin-left:20px;" for="bottom_ad">Bottom ad:</label>
				<textarea id="bottom_ad" name="bottom_ad" cols="50" rows="6"><?php echo stripslashes($bottom_ad); ?></textarea>
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