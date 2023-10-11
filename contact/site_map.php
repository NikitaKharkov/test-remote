<?php
# ----------------------------------- #
#	SETUP
# ----------------------------------- #
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/common.php");
	
	// HEADER template(db, title, (int) colums, section, page, style)
	$template = new template("", "Site Map", 2, "contact us", "site map", "site");
	$template->set_column("left", "contact.php");
	$template->print_header();
	
# ----------------------------------- #
#	BODY
# ----------------------------------- #
?>


<h1>Site Map</h1>








<?php
# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->print_footer();
?>
