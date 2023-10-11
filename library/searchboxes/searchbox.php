<? $kb_page_info = $objects->Database->getStructure('kb_pages'); ?>

	<div id="rnd_container">
			<b class="rnd_top"><b class="rnd_b1"></b><b class="rnd_b2"></b><b class="rnd_b3"></b><b class="rnd_b4"></b></b>
			<div class="rnd_content"> 
			<a href="/"  title="EBSCO Support Site" id="ebsco-logo">EBSCO Support Site</a>
		
		<div class="right-element">
		
		<form id="search" action="/knowledge_base/search.php" method="get">		   
		<input class="textbox" type="text" name="keyword" size="35" maxlength="50" value="<?= $keyword ?>" />
		
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
			
			<select name="document_type">
							<? 
							
							print_option($document_type, '', 'All Document Types');
							foreach ($kb_page_info['document_type']['valid_values'] as $valid_doc_type) {
								print_option($document_type, $valid_doc_type, $valid_doc_type);
							}
							
							?>
						</select>
								
			 <input type="hidden" name="page_function" value="search" />
			 <input type="submit" class="greenbtn" value="Search" />

						
		</form>	
		
		</div>	
	
			<div class="browse">
				<a href="/knowledge_base/search.php">Advanced Search</a>&nbsp;&nbsp; | &nbsp;&nbsp;
				<a href="/knowledge_base/search_db.php">Search By Database</a>&nbsp;&nbsp; | &nbsp;&nbsp;
				<a href="/knowledge_base/index.php">Browse Services</a>
			</div>
			
			</div>
			<b class="rnd_bottom"><b class="rnd_b4"></b><b class="rnd_b3"></b><b class="rnd_b2"></b><b class="rnd_b1"></b></b>
		</div>
