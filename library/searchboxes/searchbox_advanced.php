<? $kb_page_info = $objects->Database->getStructure('kb_pages'); ?>

<div id="rnd_container_advanced">
			<b class="rnd_top"><b class="rnd_b1"></b><b class="rnd_b2"></b><b class="rnd_b3"></b><b class="rnd_b4"></b></b>
			<div class="rnd_content_advanced"> 
		<a href="/"  title="EBSCO Support Site" id="ebsco-logo">EBSCO Support Site</a>
		<div class="right-element_search_advanced">
				
			<div class="center_table">
		<form id="search" action="<?= $_SERVER['PHP_SELF']; ?>" method="get">
			<table cellpadding="10" cellspacing="0" border="0">
				
				<tr>
					<td><strong>Keyword</strong></td>
					<td><input class="textbox" type="text" name="keyword" size="43" maxlength="50" value="<?= $keyword ?>" /></td>

					<td><strong>Language</strong></td>
					<td>
						<select name="language_id">
							<?
							try {
								print_option($language_id, '', 'All Languages');
								$languages = $language_controller->listLanguages('name_asc');
								foreach($languages as $id => $language) {
									print_option($language_id, $id, $language->getName());
								}
							} catch (Exception $e) {}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><strong>Document Type</strong></td>
					<td>
						<select name="document_type">
							<? 
							
							print_option($document_type, '', 'All Document Types');
							foreach ($kb_page_info['document_type']['valid_values'] as $valid_doc_type) {
								print_option($document_type, $valid_doc_type, $valid_doc_type);
							}
							
							?>
						</select>
					</td>
			
					<td><strong>Topic</strong></td>
					<td>
						<select id="topic" name="topic">
							<? 
							try {
								print_option($kbt_id_filter, '', 'All Topics');
								$kb_topics = $kb_controller->listKbTopics('list_order_asc');
								foreach($kb_topics as $kb_topic_id => $kb_topic) {
									print_option($kbt_id_filter, $kb_topic_id, $kb_topic->getName());
								}
							} catch (Exception $e) {}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><strong>Service</strong></td>
					<td>
						<select id="interface_id" name="interface_id">
							<?
							try {
								print_option($kb_interface_id, '', 'All Services');
								$kb_interfaces = $kb_controller->listKbInterfaces('name_asc', 'live');
								foreach($kb_interfaces as $kb_interface_id => $kb_interface) {
									print_option($kb_interface, $kb_interface_id, $kb_interface->getName());
								}
							} catch (Exception $e) {}
							?>
						</select>					
					</td>
					</td>
					<td><strong>Database</strong></td>
					<td>
						<select name="ebsco_database_id">
							<?
							try {
								print_option($ebsco_database_id, '', 'All Databases');
								$ebsco_databases = $ebsco_database_controller->listEbscoDatabases('name_asc', 'active');
								foreach($ebsco_databases as $id => $ebsco_database) {
									print_option($ebsco_database_id, $id, $ebsco_database->getName());
								}
							} catch (Exception $e) {}
							?>
						</select>
					</td>
					<td>
					
			<input type="hidden" name="page_function" value="search" />
			<input type="submit" value="Search" class="greenbtn" />
		
					</td>
				</tr>
				
			</table>
	
		
			<script type="text/javascript">
				document.getElementById('interface_id').value = "<?php echo $_GET['interface_id'];?>";
			</script>
			
			<script type="text/javascript">
						document.getElementById('topic').value = "<?php echo $_GET['topic'];?>";
			</script>
		
	
	</div>
	</div>
		</div>
			<b class="rnd_bottom"><b class="rnd_b4"></b><b class="rnd_b3"></b><b class="rnd_b2"></b><b class="rnd_b1"></b></b>
		</div>
		
	</form>