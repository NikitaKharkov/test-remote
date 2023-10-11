<?php 

/**
 * @author 	 Brendan Bates <brendan.bates@maine.edu> <bbates@ebscohost.com>
 * 
 * @desc	 EBSCOhost Integration Toolkit website menu bar.
 */

?>				
		<div id="leftnav_base">
			<ul>
				<li>
					<?php if( $menu == 'eds_api' ) {?>
					<div id="active"><a href="index.php">EDS API</a></div>
					<div id="leftnav_inner">
						<ul>
							<li>
								<a <?php if( $page == 'eds_api' ) echo 'style="font-weight: bold"'; ?> href="api.php">	Overview</a>
							</li>
						</ul>
					</div>
					<?php } else { ?>
						<a href="api.php">EDS API</a>
					<?php }?>	
				</li>
				<li>
					<?php if( $menu == 'web_service' ) {?>
						<div id="active"><a href="index.php">EBSCOhost API</a></div>
						<div id="leftnav_inner">
							<ul>
								<li><a <?php if( $page == 'ws' ) echo 'style="font-weight: bold"'; ?> href="ws.php">Overview</a></li>
								
							</ul>
						</div>
						<div class="spacer"></div>
					<?php } else { ?>
						<a href="ws.php">EBSCOhost API</a>
					<?php }?>
				</li>
				<li>
				
				
				<?php if( $menu == 'url_builder' ) {?>
						<div id="active"><a href="index.php">Direct URL Builder</a></div>
						<div id="leftnav_inner">
							<ul>
								<li><a <?php if( $page == 'urlb' ) 			echo 'style="font-weight: bold"'; ?> href="urlb.php">Build a Direct URL</a></li>
                                <li><a <?php if( $page == 'urlb_faq' ) 	echo 'style="font-weight: bold"'; ?> href="urlb_faq.php">FAQ</a></li>
							</ul>
						</div>
						<div class="spacer"></div>
					<?php } else { ?>
						<a href="urlb.php">Direct URL Builder</a>
					<?php } ?>
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
				
			</ul>
		</div>
		<div style="clear: both"></div>
	</div>
</div>
<div id="navseparator" class="content_separator"></div>
<div id="contentarea" class="content">