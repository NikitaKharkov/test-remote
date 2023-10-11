<?php
# ----------------------------------- #
#	SETUP
# ----------------------------------- #
	ob_start();
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/common.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/help.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/help_display.class.php");

	// HEADER template(db, title, (int) colums, section, page, style)
	$template = new template("", "EBSCO Help", 1, "", "", "help");
	$template->print_header();
		
	$h = new help_display($db->get_connection());
	$h->show_select_interface();

	$template->print_footer();
?>