<?
/* --------------------------------------------------------------------- */
/* @author  Jeff Turcotte [jt] <jeff@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$page_function = page_function(
	array( "services", "topics", "select_service", "show_list" ), request_value('page_function')
);

$template->setStyle('site');
$template->setColumn("left", "knowledge.php");
$template->setHtmlTitle('Knowledge Base: Services');
$template->printHeader();
include($_SERVER['DOCUMENT_ROOT'] . "/library/searchboxes/searchbox.php");

$kb_interface_id   = request_value('sid');
$kb_topic_id       = request_value('topic');
$page              = request_value('page', 'integer', 1);
$document_type     = urldecode(request_value('document_type'));
$kb_status_filter  = array('public', 'private');

$error = '';
$message = '';

// Show List
//---------------
if ($page_function == "show_list") { 	
	try {
		$kb_interface = new KbInterface($kb_interface_id);
		if ($kb_interface->getStatus() != 'live') {
			throw new Exception();
		}
		$kb_topic    = new KbTopic($kb_topic_id);
		$kb_page_ids = $kb_controller->findKbPages(NULL, NULL, $kb_interface_id, $kb_topic_id, NULL, $kb_status_filter, $document_type);

		// implement page walker
		$total_per_page = 20;
		$total_kb_page_ids = count($kb_page_ids);
		$print_page_walker = ($total_kb_page_ids > $total_per_page) ? TRUE : FALSE;
				
		$paginator   = new Paginator($total_kb_page_ids, $page, $total_per_page);
		
		$first_item = (($page*$total_per_page)-$total_per_page)+1;
		$last_item = (($page*$total_per_page) > $total_kb_page_ids) ? $total_kb_page_ids : $page * $total_per_page;
		
		$kb_page_ids = array_slice($kb_page_ids, $first_item-1, $total_per_page); 
		
		$page_display = "Displaying <strong>${first_item} - ${last_item}</strong> of <strong>${total_kb_page_ids}</strong>";
		?>
		
		<div id="page_title"><?= $kb_interface->getName() ?>: <?= $kb_topic->getName() ?></div>
		<br />
	<div id="detail">	
		<?= $page_display ?>
		
		<?
		foreach($kb_page_ids as $kb_page_id) {
			$kb_page = new KbPage($kb_page_id);
		
			$short_description = ($kb_page->getContent()) ? substr(strip_tags($kb_page->getContent()), 0, 250) . "..." : '';
			
			$link = '#';
			if ($kb_page->getContent()) {
				$link = "/knowledge_base/detail.php?topic=${kb_topic_id}&amp;id=${kb_page_id}&amp;page=" . $page;				
			} else if ($kb_page->getFile() && file_exists($_SERVER['DOCUMENT_ROOT'] . $kb_page->getFile())) {
				$link = $kb_page->getFile(TRUE);
			}


			
			?>
			<hr class="clear_floats" />
			<div class="newsblock">
				<strong><a href="<?= $link; ?>"><?= strip_tags($kb_page->getTitle()) ?></a></strong><br />
				<?= $short_description ?><a href="<?= $link; ?>" class="orange">Read More</a>
				<div class="detail_block"><strong>Last Updated:</strong> <?= $kb_page->getLastUpdated('F Y') ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
				<strong>Document Type:</strong> <?= $kb_page->getDocumentType() ?></div>
			</div>
			<?
		}
		?>
		<hr class="clear_floats" />
		
		<?
		if ($print_page_walker) {
			?>
			<div class="paginator">
				<? $paginator->printTemplate('page_walker'); ?>
			</div>
		</div>
			<?
		}
	} catch (NotFoundException $e) {
		$error = "There are no Knowledge Base articles available at this time.  Please check back soon.";
		$page_function = "topics";		
	} catch (Exception $e) {
		$error = "We're sorry, but we're unable to display the topic you requested.";
		$page_function = "topics";
	}
}



// Select Service
//---------------
if ($page_function == "select_service") {

	try {
		$kb_interface = new KbInterface($kb_interface_id);
		if ($kb_interface->getStatus() != 'live') {
			throw new Exception();
		}
		$page_function = "topics";
	} catch (Exception $e) {
		$error = "We're sorry, but there's been a problem finding the service you requested.";
		$page_function = "services";
	}
}


// Topics
//---------------
if ($page_function == "topics") {
	($error)   ? print_message($error, 'error')     : NULL;
	($message) ? print_message($message, 'message') : NULL;
	
	?>
	
	<div id="page_title"><?= $kb_interface->getName() ?></div>

<div id="detail">
	<img src="/images/icons/orangetri.gif" alt="" />
	<a class="services" href="<?= $_SERVER['PHP_SELF'] ?>?page_function=services">Back to main services list</a>
	<br /><br />

	<?
	try {
		$kb_topics = $kb_interface->createDistinctTopics();
		?>
	
		<table cellpadding="0" cellspacing="0" class="browse_layout_table">
			<? 
			$i = 0;
			foreach($kb_topics as $kb_topic_id => $kb_topic) {
				
				if ($i == 0) {
					echo "<tr>";
				}
				$i++;
				?>
				
				<td>
					<div class="browse_block">
						<div class="browse_header">
							<a href="<?= $_SERVER['PHP_SELF']; ?>?page_function=show_list&amp;sid=<?= $kb_interface->getPrimaryKey() ?>&amp;topic=<?= $kb_topic_id ?>">
								<strong><?= $kb_topic->getName() ?></strong>
							</a>
						</div>
						<div class="browse_body">
							<ul>
								<? 
								$docs_by_type = array();
								$kb_page_info = $objects->Database->getStructure('kb_pages'); 
								foreach ($kb_page_info['document_type']['valid_values'] as $doc_type) {
									try {
										$doc_ids = $kb_controller->findKbPages(NULL, NULL, $kb_interface_id, $kb_topic_id, NULL, $kb_status_filter, $doc_type);
									} catch (Exception $e) {
										$doc_ids = array();
									}
									$docs_by_type[$doc_type] = $doc_ids;
								}
								
								foreach($docs_by_type as $doc_type => $doc_ids) {
									$count = count($doc_ids);
									if ($count) {
										?>
										<li>
											<a href="<?= $_SERVER['PHP_SELF']; ?>?page_function=show_list&amp;sid=<?= $kb_interface_id; ?>&amp;topic=<?= $kb_topic_id; ?>&amp;document_type=<?= urlencode($doc_type); ?>">
												<?= $doc_type ?>
											</a>
											(<?= $count ?>)
										</li>
										<?
									}
								}
								?>
							</ul>
							<a href="<?= $_SERVER['PHP_SELF']; ?>?page_function=show_list&amp;sid=<?= $kb_interface_id ?>&amp;topic=<?= $kb_topic_id ?>" class="orange">
								<img src="/images/but_viewall.gif" class="graphic_button" alt="View All" />
							</a>
						</div>
					</div>
				</td>

				<? 
				if ($i == 3){
					echo "</tr>";
					$i = 0;
				}
			}
		
			//  Close out empty table cells.
			if ($i == 1) {
				echo "<td>&nbsp;</td> <td>&nbsp;</td> </tr>";
			} else if ($i == 2) {
				echo "<td>&nbsp;</td></tr>";
			}
			?>
	
		</table>
</div>	
	<?
	} catch (Exception $e) {
		$error = "There are no topics available at this time.  Please check back soon.";
		$page_function = "services";
	}
}

// Services
//---------------
if ($page_function == "services") {
	($error)   ? print_message($error, 'error')     : NULL;
	($message) ? print_message($message, 'message') : NULL;
	?>

	<div id="page_title">Knowledge Base: Services</div>
	<div class="service_margin">
		<!--<img src="/images/knowledgebase.gif" class="page_graphic" alt="EBSCO Knowledge Base" />-->

		<?
		try { 
			$kb_interfaces = $kb_controller->listKbInterfaces('name_asc', 'live');
		

			$count = count($kb_interfaces);
			$split = ceil($count / 2);
			$column_1_kb_interfaces = array();
			$column_2_kb_interfaces = array();
		
			$key = 1;
			$column = 'column_1_kb_interfaces';
			foreach($kb_interfaces as $kb_id => $kb_interface) {
				array_push($$column, $kb_interface);
				$key++;
				if ($key > $split) {
					$column = 'column_2_kb_interfaces';
				}
			}
			?>
	
			<table cellpadding="6" cellspacing="1" class="services_table">
				<?
				for($i=0; $i < $count; $i++) {
					$kb_interface_1 = (isset($column_1_kb_interfaces[$i])) ? $column_1_kb_interfaces[$i] : NULL;
					$kb_interface_2 = (isset($column_2_kb_interfaces[$i])) ? $column_2_kb_interfaces[$i] : NULL;
				
					if ($kb_interface_1 != NULL) {
						?>
						<tr>
							<td>
								<img src="/images/bullet_arrow.gif" alt="" /> 
								<strong>
									<a href="<?= $_SERVER['PHP_SELF'] ?>?page_function=select_service&amp;sid=<?= $kb_interface_1->getPrimaryKey() ?>">
										<?= $kb_interface_1->getName() ?>
									</a>
								</strong>
							</td>
							<td>
								<? 
								if ($kb_interface_2 != NULL) {
									?>
										<img src="/images/bullet_arrow.gif" alt="" /> 
										<strong>
											<a href="<?= $_SERVER['PHP_SELF'] ?>?page_function=select_service&amp;sid=<?= $kb_interface_2->getPrimaryKey() ?>">
												<?= $kb_interface_2->getName() ?>
											</a>
										</strong>
									<?
								}
								?>
							</td>
						</tr>	
					<?
					}
				}
				?>
			</table>
	
		<?
		} catch (Exception $e) {
			echo "There are no services available at this time.  Please check back soon.";
		}
		?>
		
	</div>
<?	
}

// Footer
//---------------
$template->printFooter();
?>
