<?php header("Content-type: text/html; charset=utf-8");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>EBSCO Support Admin: <?= $this->getData('title'); ?></title>
		<meta name="copyright" content="Design, programming, and hosting by iMarc. More info at http://imarc.net" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link href="/stylesheets/admin.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="/stylesheets/paginator.css" rel="stylesheet" type="text/css" media="screen" />
		<script type="text/javascript" src="/javascripts/mootools-release-1.11.js"></script>
		<script type="text/javascript" src="/javascripts/reorder.js"></script>
	</head>

	<body>
		
		<?
		$user_auth = NULL;
		if ($logged_in_user_id = Session::getLoggedInUserId()) {
			$user = new User($logged_in_user_id);
			$user_auth = $user->getAuthorizationLevel();
		}
		?>

		<div class="header">
			<a class="logo" href="/admin">
				<img src="/images/logo_support.gif" alt="EBSCO Support Admin Home" />
			</a>
			<ul class="secondary_navigation">
				<?= ($user_auth) ? "<li><a href=\"/admin/\">Admin Home</a></li>" : ''; ?>
				<li><a href="/">Website Home</a></li>
				<?= ($user_auth) ? "<li><a href=\"/login/?page_function=logout\">Log Out</a></li>" : ''; ?>
			</ul>
			<div style="clear:both;"></div>
		</div>
		
		<?
		$active_main_nav = $this->getData('main_nav');
		$active_sub_nav = $this->getData('sub_nav');
		$active  = 'class="active" ';
		?>
		
		<?
		if ($user_auth) { 
			?>
			<div class="main_navigation_spread">
				<ul class="main_navigation">
					
					<li><a <?= ($active_main_nav == 'home') ? $active : '' ?>href="/admin/">Home</a></li>
					<? if ($user->canEditHelp()) { ?>
						<li><a <?= ($active_main_nav == 'help') ? $active : '' ?>href="/admin/help_interfaces.php">Help</a></li>
					<? } ?>
					<? if ($user->canEditKnowledgeBase()) { ?>
						<li><a <?= ($active_main_nav == 'knowledge_base') ? $active : '' ?>href="/admin/kb_pages.php">Knowledge Base</a></li>
					<? } ?>
					<? if ($user->canEditDatabaseHelp()) { ?>
						<li><a <?= ($active_main_nav == 'database_help') ? $active : '' ?>href="/admin/database_help.php">Database Help</a></li>
					<? } ?>
					<? if ($user->canEditNews()) { ?>
						<li><a <?= ($active_main_nav == 'news') ? $active : '' ?>href="/admin/news.php">News</a></li>
					<? } ?>
					
					<? 
					if ($user_auth == 'system_admin') { 
						?>
						<li><a <?= ($active_main_nav == 'users') ? $active : '' ?>href="/admin/users.php">Users</a></li>
						<?
					}
					if ($user->canEditEbscoDatabases()) { ?>
						<li><a <?= ($active_main_nav == 'ebsco_databases') ? $active : '' ?>href="/admin/ebsco_databases.php">EBSCO Databases</a></li>
						<?
					}
					if ($user_auth == 'system_admin') { 
						?>
						<li><a <?= ($active_main_nav == 'languages') ? $active : '' ?>href="/admin/languages.php">Languages</a></li>
						<li><a <?= ($active_main_nav == 'change_log') ? $active : '' ?>href="/admin/change_log.php">Reports</a></li>
						<?
					} 
					
					
					?>
				</ul>
				<div style="clear:both;"></div>
			</div>
			<?
		} 
		?>

		<?
		if ($active_sub_nav) {
			?>
			<div class="sub_navigation_spread">
				<ul class="sub_navigation">
					<?
					if ($active_main_nav == 'help') { 
						?>
						<li><a <?= ($active_sub_nav == 'help_interfaces') ? $active : '' ?>href="/admin/help_interfaces.php">Help Interfaces</a></li>
						<li><a <?= ($active_sub_nav == 'help_pages') ? $active : '' ?>href="/admin/help_pages.php">Help Pages</a></li>
						<? if ($user->getAuthorizationLevel() == 'system_admin') { ?>
							<li><a <?= ($active_sub_nav == 'tocs') ? $active : '' ?>href="/admin/tocs.php">TOCs</a></li>
						<? } ?>
						<?
					} else if ($active_main_nav == 'knowledge_base') {
						?>
						<li><a <?= ($active_sub_nav == 'kb_pages') ? $active : '' ?>href="/admin/kb_pages.php"><acronym title="Knowledge Base">KB</acronym> Pages</a></li>
						<li><a <?= ($active_sub_nav == 'kb_interfaces') ? $active : '' ?>href="/admin/kb_interfaces.php"><acronym title="Knowledge Base">KB</acronym> Interfaces</a></li>
						<li><a <?= ($active_sub_nav == 'kb_topics') ? $active : '' ?>href="/admin/kb_topics.php"><acronym title="Knowledge Base">KB</acronym> Topics</a></li>
						<?
					}
					?>
				</ul>
				<div style="clear:both;"></div>
			</div>
			<?	
		}
		?>
		
		<div class="torso">