<html>
    <head>
        <title>EBSCO Discovery Search</title>
    </head>
        
        <!-- $_GET vars:
            * - default
            *** - required
            
            newwindow:
                0 = search results appear in the same window
                *1 = search results appear in a new window
        
            ***custID: your institution's customer ID number (the log in to eadmin)
            
            groupID: the ID of the group that contains the profile you want to search
                *main = the MAIN group, which is generally the best option if you're not sure
                
            profID: the ID of the profile you want to search
                *eds = the default EDS profile
                
            user: if using UID as an authtype, put the username in this profile
                *none
                
            password: if using UID as an authtype, put the password in this profile
                *none
                
            lang: language the search interface should be in
                *en
                
            authtype: -- separate each authtype with commas (e.g., "guest,ip,cookie")
                *guest - Guest Access
                *ip - IP Range
                *cookie - Cookie
                uid - User ID
                athens - Athens
                user - Personal User
                url - referring URL
                shib - Shibboleth
                Other authtypes currently not supported in this iFrame: Patron ID and Patterned ID
                
            mode: type of search
                or = ANY search term must appear in each result
                *and = ALL search terms must appear in each results
                bool = treat the search terms as BOOLEAN (phrase searching)

            title: text above the search box. When writing the iFrame URL, include '+' between each word in place of the space (e.g. Discovery+Search will produce "Discovery Search")
                *EBSCO Discovery Service

            showAllOptions:
                1 = Show all limiter check boxs and radio buttons
                *0 = Show only limiters and options specified with "show" variables below
                
            showTitleAuthorButtons:
                N = Do not show Keyword/Title/Author radio buttons below search box (default is KEYWORD search)
                *<anything else> = Show these radio buttons
                
            showFT, showRV, showCO, showLC: -- show the FULL TEXT, PEER REVIEWED, CATALOG ONLY, and IN LIBRARY COLLECTION limiters, respectively
                1 = Show the limiter
                *0 = Do NOT show the limiter
                
            defaultFT, defaultRV, defaultCO, defaultLC: -- default values for the FULL TEXT, PEER REVIEWED, CATALOG ONLY, and IN LIBRARY COLLECTION limiters, respectively
            these limiters will be applied whether or not they are shown to the user (e.g., you can default the search to FULL TEXT even without SHOWING the checkbox to users)
                1 = Default to CHECKED
                *0 = Default to UNchecked
                
            labelFT, labelRV, labelCO, labelLC: -- labels for the various limiters.  They default to: "FULL TEXT", "PEER REVIEWED", "CATALOG ONLY", and "AVAILABLE IN THE LIBRARY COLLECTION"
            
            logoURL: -- URL to the logo.  No QUESTION MARKS or AMPHERSANDS (&) allowed in the URL
                default: http://supportforms.epnet.com/eit/images/eds100.gif
            
            logoWidth: -- padding to the left of the searchbox text and input field
                default: 110
                
            logoHeight: -- padding on top of the searchbox text and input field
                default: 5
                
            width: -- width of the entire searchbox
                default: 375
                
            height: -- height of the entire searchbox
                default: 66
                
            boxsize: -- size (in characters) of the searchbox input field
                default: 23
                
            nologo: -- remove the logo from the searchbox altogether
                1 = no logo will appear
                *0 = logo will appear
                
            bgcolor: -- background color hexcode (without the # symbol)
                default: none
                FFFFFF: white
        -->
        
<?php
    $newwindow = $_GET["newwindow"] ? $_GET["newwindow"] : 1;
    $custID = $_GET["custID"];
    $groupID = $_GET["groupID"] ? $_GET["groupID"] : 'main';
    $profID = $_GET["profID"] ? $_GET["profID"] : 'eds';
    $proxyURL = $_GET["proxy"] ? $_GET["proxy"] : '';
    
    
    $lang = $_GET["lang"] ? $_GET["lang"] : 'en';
    $authtype = $_GET["authtype"] ? $_GET["authtype"] : 'cookie,ip,guest';
    
    if ($_GET["user"] && $_GET["password"])
        $userpasscombo = "&user=" . $_GET["user"] . "&password=" . $_GET["password"];
    else
        $userpasscombo = "";
    
    $mode = $_GET["mode"] ? $_GET["mode"] : 'and';
    switch ($mode) {
        case 'and':
            $termconcatenator = '+AND+';
            break;
        case 'or':
            $termconcatenator = '+OR+';
            break;
        default:
            $termconcatenator = '+';
    }
    $title = $_GET["title"] ? $_GET["title"] : 'EBSCO Discovery Search';
    $title = urldecode($title);
    $showTitleAuthorDropdown = $_GET["showTitleAuthorDropdown"] ? $_GET["showTitleAuthorDropdown"] : TRUE;
    if ($showTitleAuthorDropdown == "N")
        $showTitleAuthorDropdown = FALSE;
    $showTitleAuthorButtons = $_GET["showTitleAuthorButtons"] ? $_GET["showTitleAuthorButtons"] : TRUE;
    if ($showTitleAuthorButtons == "N")
        $showTitleAuthorButtons = FALSE;

    $limiterFT = $_GET["showFT"];
    $limiterLC = $_GET["showLC"];
    $limiterCO = $_GET["showCO"];
    $limiterRV = $_GET["showRV"];
    $anyLimiters = $limiterFT || $limiterCO || $limiterLC || $limiterRV;
    
    $checkedFT = $_GET["defaultFT"];
    $checkedLC = $_GET["defaultLC"];        
    $checkedCO = $_GET["defaultCO"];
    $checkedRV = $_GET["defaultRV"];
    
    if ($checkedFT) {
        $checkedFT = "checked=\"checked\"";
    }
    if ($checkedLC) {
        $checkedLC = "checked=\"checked\"";
    }
    if ($checkedCO) {
        $checkedCO = "checked=\"checked\"";
    }
    if ($checkedRV) {
        $checkedRV = "checked=\"checked\"";
    }

    $noLimitTitle = $_GET["nolimitertitle"] ? "display:none;" : "";
    $labelFT = $_GET["FTlabel"] ? $_GET["FTlabel"] : "Full Text"; 
    $labelLC = $_GET["LClabel"] ? $_GET["LClabel"] : "Available in Library Collection"; 
    $labelCO = $_GET["COlabel"] ? $_GET["COlabel"] : "Catalog Only"; 
    $labelRV = $_GET["RVlabel"] ? $_GET["RVlabel"] : "Peer Reviewed"; 
    
    
    $labelFT = urldecode($labelFT);
    $labelLC = urldecode($labelLC);
    $labelCO = urldecode($labelCO);
    $labelRV = urldecode($labelRV);
    
    $logo = $_GET["logoURL"] ? $_GET["logoURL"] : 'https://supportforms.epnet.com/eit/images/eds100.gif';
    $h = $_GET["height"] ? $_GET["height"] : "66";
    $w = $_GET["widths"] ? $_GET["width"] : "375";
    $searchboxLeftPadding = $_GET["logoWidth"] ? $_GET["logoWidth"] : "110";
    $searchboxSize = $_GET["boxsize"] ? $_GET["boxsize"] : "23";
    $searchboxTopPadding = $_GET["logoHeight"] ? $_GET["logoHeight"] : "5";
    
    $bgcolor = $_GET["bgcolor"] ? "#" . $_GET["bgcolor"] : "none";
    
    if ($_GET["nologo"]) {
        $logo = '';
        $searchboxLeftPadding = '0';
        $searchboxTopPadding = '0';
    }
    
    if ($_GET["showAllOptions"]) {
        $anyLimiters = $limiterFT = $limiterCO = $limiterLC = $limiterRV = $showTitleAuthorButtons = 1;
    }
    
    if ($_GET["hiddenLimiter"]) {
        $hiddenLimiter = " AND " . $_GET["hiddenLimiter"];
    } else {
        $hiddenLimiter = "";
    }
    
    if ($_GET["defaultSearchText"]) {
        $defaultSearchText = $_GET["defaultSearchText"];
    } else {
        $defaultSearchText = "";
    }
    
    if ($_GET["styleDefinitions"]) {
        $styleDefinitions = $_GET["styleDefinitions"];
    }
    
    
?>

<body style="background-color:<?php echo $bgcolor; ?>;<?php if (isset($styleDefinitions)) echo $styleDefinitions; ?>">
        <!-- EBSCOhost Custom Search Box Begins -->
<script src="https://supportforms.epnet.com/eit/scripts/ebscohostsearch.js" type="text/javascript"></script>
<script type="text/javascript" src="https://imageserver.ebscohost.com/branding/hinttextbox/hint-textbox.js"></script>
<form action="" onsubmit="return ebscoHostSearchGo(this);" method="post" style="width:<?php echo $w; ?>px; overflow:auto;">
		<input id="ebscohostwindow" name="ebscohostwindow" type="hidden" value="<?php echo $newwindow; ?>" />
		<input id="ebscohosturl" name="ebscohosturl" type="hidden" value="<?php echo $proxyURL; ?>http://search.ebscohost.com/login.aspx?direct=true&site=eds-live&scope=site&type=0&db=eda&custid=<?php echo $custID; ?>&groupid=<?php echo $groupID; ?>&profid=<?php echo $profID; ?>&mode=<?php echo $mode; ?>&lang=<?php echo $lang; ?>&authtype=<?php echo $authtype; ?><?php echo $userpasscombo; ?>" />
		<input id="ebscohostsearchsrc" name="ebscohostsearchsrc" type="hidden" value="db" />
		<input id="ebscohostsearchmode" name="ebscohostsearchmode" type="hidden" value="<?php echo $termconcatenator; ?>" />
		<input id="ebscohostkeywords" name="ebscohostkeywords" type="hidden" value="" />
		<div style="background-image:url('<?php echo $logo; ?>'); background-repeat:no-repeat; height:<?php echo $h; ?>px; width:<?php echo $w; ?>px; font-family:Verdana,Arial,Helvetica,sans-serif;font-size:9pt; color:#353535;">
			<div style="padding-top:<?php echo $searchboxTopPadding; ?>px;padding-left:<?php echo $searchboxLeftPadding; ?>px;">
				<span style="font-weight:bold;"><?php echo $title; ?></span>

				<div>
                                    <?php
                                        if ($showTitleAuthorDropdown) {
                                        ?>    
                                        
					<select name="searchFieldSelector">
                                            <option value="">Keyword</option>
                                            <option value="TI">Title</option>
                                            <option value="AU">Author</option>
                                        </select>
                                        
                                        <?php } ?>
                                        <input id="ebscohostsearchtext" name="ebscohostsearchtext" type="text" size="<?php echo $searchboxSize; ?>" style="font-size:9pt;padding-left:5px;margin-left:0px;" class="hintTextbox" value="<?php echo $defaultSearchText; ?>" />
					<input type="submit" value="Search" style="font-size:9pt;padding-left:5px;" />
					<?php
                                            if ($showTitleAuthorButtons) {
                                        ?>
					<div id="guidedFieldSelectors">
						<input class="radio" type="radio" name="searchFieldSelector" id="guidedField_0" value="" checked="checked" />
						<label class="label" for="guidedField_0"> Keyword</label>
						<input class="radio" type="radio" name="searchFieldSelector" id="guidedField_1" value="TI" />
						<label class="label" for="guidedField_1"> Title</label>
						<input class="radio" type="radio" name="searchFieldSelector" id="guidedField_2" value="AU" />
						<label class="label" for="guidedField_2"> Author</label>
					</div>
                                        <?php
                                            } else {
                                        ?>
                                                <input type="hidden" name="searchFieldSelector" value="" />
                                        <?php
                                            }
                                        ?>
					
				</div>
			</div>
		</div>
		<div id="limiterblock" style="margin-left:-px; overflow: auto; <?php if (!($anyLimiters)) echo "display:none;"; ?>">
	
                            <div id="limitertitle" style="font-weight:bold;padding-top:25px;padding-bottom:5px;<?php echo $noLimitTitle; ?>">Limit Your Results</div>

			<div id="includeFT" style="float:left;margin:0;padding:0;width:50%;<?php if (!($limiterFT)) echo "display:none;"; ?>">
				<input type="checkbox" id="chkFullText" name="chkFullText" <?php echo $checkedFT; ?> />
				<label for="chkFullText"><?php echo $labelFT; ?></label>
			</div>

			<div id="includePR" style="float:left;margin:0;padding:0;width:50%;<?php if (!($limiterRV)) echo "display:none;"; ?>">
				<input type="checkbox" id="chkPeerReviewed" name="chkPeerReviewed" <?php echo $checkedRV; ?> />
				<label for="chkPeerReviewed"><?php echo $labelRV; ?></label>
			</div>

			<div id="includeCO" style="float:left;margin:0;padding:0;width:50%;<?php if (!($limiterCO)) echo "display:none;"; ?>">
				<input type="checkbox" id="chkCatalogOnly" name="chkCatalogOnly" <?php echo $checkedCO; ?> />
				<label for="chkCatalogOnly"><?php echo $labelCO; ?></label>
			</div>
 
			<div id="includeLC" style="float:left;margin:0;padding:0;width:50%;<?php if (!($limiterLC)) echo "display:none;"; ?>">
				<input type="checkbox" id="chkLibraryCollection" name="chkLibraryCollection" <?php echo $checkedLC; ?> />
				<label for="chkLibraryCollection"><?php echo $labelLC; ?></label>
			</div>

		</div>
		
	</form>
	<!-- EBSCOhost Custom Search Box Ends -->
    </body>
</html>