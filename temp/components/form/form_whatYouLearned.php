		<h2>What You Learned</h2>
		<h3><b>Success in meeting learning objective:</b></h3>

<fieldset id="learned">
<div class="fieldSetLabel required">Check one or more of the following:</div>
<div class="checks">
			<?
			foreach( getElements("//item", $learnedItems) as $xml )
				echo $xml;
			?>
</div>
</fieldset>
	
