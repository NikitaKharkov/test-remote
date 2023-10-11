<?php
$products = $_GET['product'];

 
$areaOfSupport = array(
            ebscoadmin => array('Update Administrator','Authentication','Reporting','Other'),
            ebscohost => array('Searching','Viewing Results','Persistent Links','Branding','Widgets','Other'),
            myehost => array('Alerts','Saved Searches','Folder','Other'),
            eds => array('Branding','Content questions','Limiters/Facets','Persistent Links','Searching','Viewing Results','Widgets', 'Other'),
            edsapi => array('Connection issue','Setup','Other'),
            ebooks => array('MARC Records/OCLC Collection Manager','Direct URL','Downloading eBook','Reports','eBook Mobile','Other'),
            ecm => array('PDA/Lists','Billing Inquiries','Owned Titles','Reports','Other'),
            learningexpress => array('Access Codes','Registration/Login Issue','Other'),
            audiobooks => array('Downloading app','Downloading Audiobooks','Other'),
            holdingsmanagement => array('Upload to HLM','Selecting/Deselecting/Hiding Resources','Downloading Holdings','Create/Update/Assign Notes','Update coverage','Other'),
            atoz => array('Upload to A-to-Z','Selecting/Deselecting/Hiding Resources','Downloading Holdings','Create/Update/Assign Notes','Update coverage','Other'),
            pubfinder => array('Customize interface','Searching','Link Not appearing','Other'),
            linksource => array('Error message/no results','Authentication','Link Creation/addition/update','Other'),
            dynamed => array('DynaMed Mobile','Other')
        );
         
$currentAreaOfSupport = $areaOfSupport[$products];
?>

<select name="area" id="area" <?php if(empty($currentAreaOfSupport)) { echo "disabled"; } ?>>
    <option value="">Area of Support</option>
    <?php
       foreach($currentAreaOfSupport as $area) {
        ?>
    <option value="<?php echo $area; ?>"><?php echo $area; ?></option>
    <?php 
    }
    ?>
</select>