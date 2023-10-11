<?php 

/**
 * @author 	 Brendan Bates <brendan.bates@maine.edu> <bbates@ebscohost.com>
 * 
 * @desc	 EBSCOhost Integration Toolkit website menu bar.
 */

?>				
		<div id="leftnav_base">
			<ul>
				<!--<li>
					<?php if( $menu == 'web_service' ) {?>
						<div id="active"><a href="index.php">Web Service</a></div>
						<div id="leftnav_inner">
							<ul>
								<li><a <?php if( $page == 'ws' ) echo 'style="font-weight: bold"'; ?> href="ws.php">Overview</a></li>
								<li><a <?php if( $page == 'ws_admin' ) echo 'style="font-weight: bold"'; ?> href="ws_admin.php">EBSCOadmin Setup</a></li>
								<li>API Methods
									<div id="leftnav_inner_sub">
										<ul>
											<li><a <?php if( $page == 'ws_info' ) 		echo 'style="font-weight: bold"'; ?> href="ws_api_info.php">Info</a></li>
											<li><a href="ws_api_search.php">Search</a>
											<?php if( $page == 'ws_search' ) { ?>
												<div id="leftnav_inner_sub">
													<ul>
														<li><a <?php if( $subpage == 'standard' ) echo 'style="font-weight: bold"'; ?> href="ws_api_search.php">Standard</a></li>														
														<li><a <?php if( $subpage == 'eds' ) echo 'style="font-weight: bold"'; ?> href="ws_api_search_eds.php">EDS</a></li>
														<li><a <?php if( $subpage == 'ehis' )echo 'style="font-weight: bold"'; ?> href="ws_api_search_ehis.php">EHIS</a></li>
													</ul>
												</div>
											<?php } ?>
											</li>
											<li><a <?php if( $page == 'ws_browse' ) 	echo 'style="font-weight: bold"'; ?> href="ws_api_browse.php">Browse</a></li>
											<li><a <?php if( $page == 'ws_authority' ) 	echo 'style="font-weight: bold"'; ?> href="ws_api_authority.php">AuthoritySearch</a></li>
											<li><a <?php if( $page == 'ws_clusters' ) 	echo 'style="font-weight: bold"'; ?> href="ws_api_clusters.php">GetClusters</a></li>
										</ul>
									</div>
								</li>
								
								<li><a <?php if( $page == 'ws_hl' )echo 'style="font-weight: bold"'; ?> href="ws_hl.php">Health Library</a></li>
								<li><a <?php if(  $page == 'ws_howto' && !isset( $subpage ) ) echo 'style="font-weight: bold"'; ?> href="ws_howto.php">How-To's</a>
								<?php if( $page == 'ws_howto' ) { ?>
									<div id="leftnav_inner_sub">
										<ul>
											<li><a <?php if( isset( $subpage ) && $subpage == 'queries' ) echo 'style="font-weight: bold"'; ?> href="ws_howto_queries.php">Search EBSCOhost</a></li>
											<li><a <?php if( isset( $subpage ) && $subpage == 'hl' ) echo 'style="font-weight: bold"'; ?> href="ws_howto_hl.php">Search Health Library</a></li>
											<li><a <?php if( isset( $subpage ) && $subpage == 'rest' )	echo 'style="font-weight: bold"'; ?> href="ws_rest.php">Making REST Requests</a></li>
											<li><a <?php if( isset( $subpage ) && $subpage == 'soap' ) 	echo 'style="font-weight: bold"'; ?> href="ws_soap.php">Making SOAP Requests</a></li>
										</ul>
									</div>
								<?php } ?>
								</li>
								<li><a <?php if( $page == 'ws_error' ) 	echo 'style="font-weight: bold"'; ?> href="ws_error.php">Error codes</a></li>
								<li><a <?php if( $page == 'ws_faq' )	echo 'style="font-weight: bold"'; ?> href="ws_faq.php">FAQs</a></li>
							</ul>
						</div>
						<div class="spacer"></div>
					<?php } else { ?>
						<a href="ws.php">Web Service</a>
					<?php }?>
				</li>
				<li>
				<?php if( $menu == 'search_box_builder' ) {?>
						<div id="active"><a href="index.php">Search Box Builder</a></div>
						<div id="leftnav_inner">
							<ul>
								<li><a <?php if( $page == 'sbb' ) 			echo 'style="font-weight: bold"'; ?> href="sbb.php">Build a Search Box</a></li>
								<li><a <?php if( $page == 'sbb_examples' ) 	echo 'style="font-weight: bold"'; ?> href="sbb_examples.php">Examples</a></li>
								<li><a <?php if( $page == 'sbb_faq' ) 	echo 'style="font-weight: bold"'; ?> href="sbb_faq.php">FAQ</a></li>
							</ul>
						</div>
						<div class="spacer"></div>
					<?php } else { ?>
						<a href="sbb.php">Search Box Builder</a>
					<?php } ?>
				</li>
				<li>
					<?php if( $menu == 'rss_feeds' ) {?>
						<div id="active"><a href="index.php">RSS Feeds</a></div>
						<div id="leftnav_inner">
							<ul>
								<li><a <?php if( $page == 'rss' ) 		echo 'style="font-weight: bold"'; ?> href="rss.php">Overview</a></li>
								<li><a href="rss.php#publication">How to: Publications</a></li>
								<li><a href="rss.php#search">How to: Searches</a></li>
								<li><a <?php if( $page == 'rss_faq' ) 	echo 'style="font-weight: bold"'; ?> href="rss_faq.php">FAQ</a></li>
							</ul>
						</div>
						<div class="spacer"></div>
					<?php } else { ?>
						<a href="rss.php">RSS Feeds</a>
					<?php } ?>
				</li>
				<li>
				<?php if( $menu == 'widgets' ) {?>
						<div id="active"><a href="index.php">Widgets</a></div>
						<div id="leftnav_inner">
							<ul>
								<li><a <?php if( $page == 'widgets' ) echo 'style="font-weight: bold"'; ?> href="widgets.php">Overview</a></li>
								<li><a <?php if( $page == 'widgets_branding' ) echo 'style="font-weight: bold"'; ?> href="widgets_branding.php">Branding</a></li>
								<li><a <?php if( $page == 'widgets_list' ) echo 'style="font-weight: bold"'; ?> href="widgets_list.php">Result List</a></li>
								<li><a <?php if( $page == 'widgets_record' ) echo 'style="font-weight: bold"'; ?> href="widgets_record.php">Detailed Record</a></li>
								<li><a <?php if( $page == 'widgets_faq' ) echo 'style="font-weight: bold"'; ?> href="widgets_faq.php">FAQ</a></li>
							</ul>
						</div>
						<div class="spacer"></div>
					<?php } else { ?>
						<a href="widgets.php">Widgets</a>
					<?php } ?>
				</li>
				<li>
					<?php if( $menu == 'persistent_links' ) {?>
						<div id="active"><a href="index.php">Persistent Links</a></div>
						<div id="leftnav_inner">
							<ul>
								<li><a <?php if( $page == 'pl' ) 		echo 'style="font-weight: bold"'; ?> href="pl.php">Overview</a></li>
								<li><a href="pl.php#search">How To: Link to a Search</a></li>
								<li><a href="pl.php#article">How To: Link to an Article</a></li>
								<li><a href="pl.php#publication">How To: Publication</a></li>
								<li><a <?php if( $page == 'pl_faq' )	echo 'style="font-weight: bold"'; ?> href="pl_faq.php">FAQ</a></li>
							</ul>
						</div>
						<div class="spacer"></div>
					<?php } else { ?>
						<a href="pl.php">Persistent Links</a>
					<?php } ?>
				</li>-->
				<li>
					<?php if( $menu == 'enterprise_search' ) { ?>
						<div id="active"><a href="esi.php">Enterprise Search Integration</a></div>
						<div id="leftnav_inner">
							<ul>
								<li><a <?php if( $page == 'esi' ) 		echo 'style="font-weight: bold"'; ?> href="esi.php">Overview</a></li>
								<li><a <?php if( $page == 'esi_ftp' ) 	echo 'style="font-weight: bold"'; ?> href="esi_ftp.php">FTP Retrieval</a></li>
								<li><a <?php if( $page == 'esi_xml' ) 	echo 'style="font-weight: bold"'; ?> href="esi_xml.php">XML Metadata</a></li>
								<li><a <?php if( $page == 'esi_faq' ) 	echo 'style="font-weight: bold"'; ?> href="esi_faq.php">FAQ</a></li>
							</ul>
						</div>
						<div class="spacer"></div>
					<?php } else { ?>
						<a href="esi.php">Enterprise Search Integration</a>
					<?php } ?>
				</li>
				<!--<li>
					<?php if( $menu == 'learning_management' ) { ?>
						<div id="active"><a href="index.php">Learning Management Systems</a></div>
						<div id="leftnav_inner">
							<ul>
								<li><a <?php if( $page == 'lms' ) 		echo 'style="font-weight: bold"'; ?> href="lms.php">Overview</a></li>
								<li><a <?php if( $page == 'lms_options' ) 		echo 'style="font-weight: bold"'; ?> href="lms_options.php">Integration Options</a></li>
								<li><a <?php if( $page == 'lms_faq' ) 	echo 'style="font-weight: bold"'; ?> href="lms_faq.php">FAQ</a></li>
							</ul>
						</div>
						<div class="spacer"></div>
					<?php } else { ?>
						<a href="lms.php">LMS</a>
					<?php } ?>
				</li>
				<li>
					<?php if( $menu == 'sharepoint' ) {?>
						<div id="active"><a href="index.php">SharePoint</a></div>
						<div id="leftnav_inner">
							<ul>
								<li><a <?php if( $page == 'sp' ) 		echo 'style="font-weight: bold"'; ?> href="sp.php">Overview</a>
								<li><a <?php if( $page == 'sp_options' )echo 'style="font-weight: bold"'; ?> href="sp_options.php">Integration Options</a>
								<li><a <?php if( $page == 'sp_faq' ) 	echo 'style="font-weight: bold"'; ?> href="sp_faq.php">FAQ</a></li>
							</ul>
						</div>
						<div class="spacer"></div>
					<?php } else { ?>
						<a href="sp.php">SharePoint</a>
					<?php } ?>
				</li>
				<li>
					<?php if( $menu == 'openurl' ) {?>
						<div id="active"><a href="index.php">OpenURL</a></div>
						<div id="leftnav_inner">
							<ul>
								<li><a style="font-weight: bold" href="ourl.php">FAQ</a></li>
							</ul>
						</div>
						<div class="spacer"></div>
					<?php } else { ?>
						<a href="ourl.php">OpenURL</a>
					<?php } ?>
				</li>
				<li>
					<?php if( $menu == 'z39.50' ) { ?>
						<div id="active"><a href="index.php">Z39.50</a></div>
						<div id="leftnav_inner">
							<ul>
								<li><a style="font-weight: bold;" href="z3950_connect_info.php">Connection Info</a></li>
							</ul>
							<ul>
								<li><a style="font-weight: bold;" href="z3950.php">FAQ</a></li>
							</ul>
						</div>
						<div class="spacer"></div>
					<?php } else { ?>
						<a href="z3950.php">Z39.50</a>
					<?php } ?>
				</li>-->
			</ul>
		</div>
		<div style="clear: both"></div>
	</div>
</div>
<div id="navseparator" class="content_separator"></div>
<div id="contentarea" class="content">