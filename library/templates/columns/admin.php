<div class="column_nav">
	<div class="column_nav_section">
		<p><strong>Need More Room?</strong></p>
		<p><a href="/admin/styles.php?sidebar=off">Hide this sidebar</a></p>
	</div>


<?php
	$su = ($_SESSION['session_authorization'] == "Super Admin") ? true : false;
?>

<? if ($su || ($_SESSION['session_authorization'] == "Knowledge Base Admin") ) { ?>
	<div class="column_nav_section">
		<p><strong>Knowledge Base</strong></p>
		<p><a href="/admin/kb_topic.php">Topics</a></p>
		<p><a href="/admin/kb.php">Knowledge Base</a></p>
		<p><a href="/admin/news.php">News</a></p>
	</div>
<? } ?>


<? if ($su || ($_SESSION['session_authorization'] == "Help Admin") || ($_SESSION['session_authorization'] == "Database Help Admin") ) { ?>
	<div class="column_nav_section">
		<p><strong>Help</strong></p>
		
		<? if ($su || ($_SESSION['session_authorization'] == "Help Admin") ) { ?>
		<p><a href="/admin/help_topic.php">Topics</a></p>
		<p><a href="/admin/help.php">Help Pages</a></p>
		<? } ?>

		<? if ($su || ($_SESSION['session_authorization'] == "Database Help Admin"))  { ?>
		<p><a href="/admin/database_help.php">Database Help</a></p>
		
		<? } ?>
		
		<!-- added ability to add/delete databases for DB Help admins -->
		
		<? if ($_SESSION['session_authorization'] == "Database Help Admin")  { ?>
			<p><a href="/admin/database.php">Databases</a></p>
			<? } ?>
	</div>
<? } ?>



<? if ($su) { ?>
	<div class="column_nav_section">
		<p><strong>Users</strong></p>
		<p><a href="/admin/administrator.php">Administrators</a></p>
		<p><a href="/admin/change_log.php">Change Log</a></p>
	</div>
	<div class="column_nav_section">
		<p><strong>Support Data</strong></p>
		<p><a href="/admin/browser.php">Browsers</a></p>
		<p><a href="/admin/database.php">Databases</a></p>
		<p><a href="/admin/feature.php">Feature IDs</a></p>
		<p><a href="/admin/interface.php">Interfaces</a></p>
		<p><a href="/admin/language.php">Languages</a></p>
		<p><a href="/admin/operating_system.php">Operating Systems</a></p>
		<p><a href="/admin/toc.php">TOC</a></p>
	</div>
	<div class="column_nav_section">
		<p><strong>Search Engine</strong></p>
		<p><a href="/admin/siftbox.php">Siftbox</a></p>
	</div>
<? } ?>

</div>
