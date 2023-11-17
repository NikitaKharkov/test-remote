<? // Help navigation template ?>

<div id="help_navigation_holder">
	<div id="help_navigation">
		<?
        // see help/index.php
        /** @var array $help_topics */
		foreach ($help_topics as $ht_id => $help_topic) {
			$default_class   = ($ht_id == $help_topic_id) ? 'topic_current':'topic_off';
			$mouseover_class = ($ht_id == $help_topic_id) ? 'topic_current':'topic_on';
			?>
			<div class="topic_group">
				<div class="<?= $default_class ?>" onmouseout="this.className='<?= $default_class ?>';" onmouseover="this.className='<?= $mouseover_class ?>';">
					<a href="<?= $_SERVER['PHP_SELF'] ?>?help_topic_id=<?= $help_topic->getPrimaryKey() ?>"><strong><?= $help_topic->getName() ?></strong></a>
				
					<ul>
						<?
						try {
							$help_pages = $help_topic->createHelpPages();
							foreach ($help_pages as $hp_id => $help_page) {
								if (!in_array($help_page->getTocId(), $disabled_toc_ids) && $help_page->getStatus() == 'live') { 
									?>
									<li><a href="<?= $_SERVER['PHP_SELF'] ?>?help_id=<?= $help_page->getPrimaryKey() ?>"><?= $help_page->getTitle() ?></a></li>
									<? 
								}
							} 
						} catch (Exception $e) {}
						?>
					</ul>
				</div>
			</div>
			<?
		}
		
		if (count($database_help_pages)) {
			$default_class   = ('DB' == $help_topic_id) ? 'topic_current':'topic_off';
			$mouseover_class = ('DB' == $help_topic_id) ? 'topic_current':'topic_on';
			?>
			<div class="topic_group">
				<div class="<?= $default_class ?>" onmouseout="this.className='<?= $default_class ?>';" onmouseover="this.className='<?= $mouseover_class ?>';">
					<a href="<?= $_SERVER['PHP_SELF'] . '?help_topic_id=DB' ?>"><strong>Database Help</strong></a>
				
					<ul>
						<?
						foreach($database_help_pages as $dbhp_id => $dbhp) {
							?>
							<li><a href="<?= $_SERVER['PHP_SELF'] ?>?help_id=DB:<?= $dbhp_id ?>"><?= $dbhp->getName() ?></a></li>
							<?
						}
						?>
					</ul>
				</div>
			</div>
			<?
		}		
		?>
	</div>
</div>
