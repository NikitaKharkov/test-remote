		<h2>What You Found</h2>
        <?php
            # see ./temp/objects.php
            /** @var array $sectionOptions */
        ?>
		<?if($sectionOptions) { //Display available sections for this article type ?>
			<h3><b>DynaMed content evaluated:</b> DynaMed content for 
			<i><?=$_REQUEST["title"]?></i> was found in the following sections:</h3>
			<fieldset id="sectionFields">
			<div class="fieldSetLabel required">Select topic sections reviewed:</div>
			<div class="checks"><div class="outerSet">
			<label for="allSections" class="check">
			<input type="checkbox" id="allSections" name="allSections"/>All Sections</label>
			<div id="sections">
			<?=getSections($sectionOptions);?>
			</div></div></div>
			</fieldset>
		
		<?} else { //If no sections then just display the statement ?>
			<h3><b>DynaMed content evaluated:</b> DynaMed content for 
			<i><?=$_REQUEST["title"]?></i> was found</h3>
			<input type="hidden" id="allSections" name="allSections" checked="checked"/>
		<?}?>

		<fieldset id="foundContent">
		<p><label for="found">Enter comments if needed to clarify:</label>
		<textarea id="found" name="found" rows="4" cols="20"></textarea></p>
		</fieldset>

<?
//Takes an empty sections fieldset and fills it with checkboxes for each option
//in sectionOptions
/* 2009-12-02 msanchez: changing function to output sections as string rather than replacing them
* in the xml variable $sections 
*/
//function fillSections($sections, $sectionOptions) {
function getSections($sectionOptions) {
	$label = "";
	/*for($i=0;$i<count($sectionOptions);$i++) {
		$id = "sections_" . $i;
		$label .= "<p><label class=\"check\" for=\"{$id}\">\n";
		$label .= "<input type=\"checkbox\" id=\"{$id}\" \n";
		$label .= "name=\"{$id}\" value=\"{$sectionOptions[$i]}\"/>\n";
		$label .= $sectionOptions[$i] . "</label></p>\n";
	}*/
	for($i=0;$i<count($sectionOptions);$i++) {
		$id = "sections_" . $i;
		$label .= "<p><div class=\"sectionCheck\">\n";
		$label .= "<input type=\"checkbox\" id=\"{$id}\" \n";
		$label .= "name=\"{$id}\" value=\"".$sectionOptions[$i]."\"/>\n";
		$label .= "</div><div class=\"sectionLabel\">\n";
		$label .= "<label for=\"{$id}\">".$sectionOptions[$i]."</label></div></p>\n";
	}
	//return str_replace("###content###",$label,$sections);
	return $label;
}
?>