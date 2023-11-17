<?php
$products = $_GET['product'];

 
$areaOfSupport = array(
            'bscoadmin' => array('Update Administrator','Authentication','Reporting','Other'),
            'bscohost' => array('Searching','Viewing Results','Persistent Links','Branding','Widgets','Other'),
            'yehost' => array('Alerts','Saved Searches','Folder','Other'),
            'ds' => array('Branding','Content questions','Limiters/Facets','Persistent Links','Searching','Viewing Results','Widgets', 'Other'),
            'dsapi' => array('Connection issue','Setup','Other'),
            'books' => array('MARC Records/OCLC Collection Manager','Direct URL','Downloading eBook','Reports','eBook Mobile','Other'),
            'cm' => array('PDA/Lists','Billing Inquiries','Owned Titles','Reports','Other'),
            'earningexpress' => array('Access Codes','Registration/Login Issue','Other'),
            'udiobooks' => array('Downloading app','Downloading Audiobooks','Other'),
            'oldingsmanagement' => array('Upload to HLM','Selecting/Deselecting/Hiding Resources','Downloading Holdings','Create/Update/Assign Notes','Update coverage','Other'),
            'toz' => array('Upload to A-to-Z','Selecting/Deselecting/Hiding Resources','Downloading Holdings','Create/Update/Assign Notes','Update coverage','Other'),
            'ubfinder' => array('Customize interface','Searching','Link Not appearing','Other'),
            'inksource' => array('Error message/no results','Authentication','Link Creation/addition/update','Other'),
            'ynamed' => array('DynaMed Mobile','Other')
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