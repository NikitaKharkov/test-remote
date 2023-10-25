<? $kb_page_info = $objects->Database->getStructure('kb_pages'); ?>

	<div id="rnd_container">
			<b class="rnd_top"><b class="rnd_b1"></b><b class="rnd_b2"></b><b class="rnd_b3"></b><b class="rnd_b4"></b></b>
			<div class="rnd_content"> 
		<a href="/"  title="EBSCO Support Site" id="ebsco-logo">EBSCO Support Site</a>
		<div class="right-element_search">
		
		<form id="search" action="/knowledge_base/search.php" method="get" name="search">		   
		<input class="textbox" type="text" name="keyword" size="35" maxlength="50" value="<?= $keyword ?>" />
		
						<select id="interface_id" name="interface_id">
							<?
							try {
								print_option($kb_interface_id, '', 'All Services');
								$kb_interfaces = $kb_controller->listKbInterfaces('name_asc', 'live');
								foreach($kb_interfaces as $kb_id => $kb_interface) {
									print_option($kb_interface_id, $kb_id, $kb_interface->getName());
								}
							} catch (Exception $e) {}
							?>
						</select>	
				
				<script type="text/javascript">
					document.getElementById('interface_id').value = "<?php echo $_GET['interface_id'];?>";
				</script>		
					
			 <input type="hidden" name="page_function" value="search" />
			 <input type="submit" class="greenbtn" value="Search" />
		
			
		</div>	
	
			<div class="browse_results">
				<a href="/knowledge_base/search.php">Advanced Search</a>&nbsp;&nbsp; | &nbsp;&nbsp;
				<a href="/knowledge_base/search_db.php">Search By Database</a>&nbsp;&nbsp; | &nbsp;&nbsp;
				<a href="/knowledge_base/index.php">Browse Services</a>
			</div>
			
			</div>
			<b class="rnd_bottom"><b class="rnd_b4"></b><b class="rnd_b3"></b><b class="rnd_b2"></b><b class="rnd_b1"></b></b>
		</div>
		
