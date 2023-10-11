<?php 

$head = '<link href="styles/style_sbb.css" rel="stylesheet" type="text/css">
<link href="styles/style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/site.js"></script>
<script type="text/javascript" src="js/builder.js"></script>';
include( 'includes/header.php' );

echo '<script type="text/javascript">
	$(document).ready(function(){load();});
</script>';

$menu = 'search_box_builder';
$page = 'sbb';
include( 'includes/navbar.php' );


?>

		<h2>Search Box Builder</h2>
		<p>Choose your search parameters and customize your search box<br />size and style to fit your site.</p>

		<form id="form1" name="form1" onsubmit="createSearchBox();return false;">
		<div class="leftcolumn"></div>
			<div class="leftblock_parent">
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;">
						<h3><font color="#144679">STEP 1</font> &nbsp;Set Search Parameters</h3>

					</div>
				</div>

<!-- Interface Selection Dropdown -->
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="txtInterface">Interface:</label>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="margin-top:4px;">
							<select name="txtInterface" id="txtInterface" onchange="selectInterface(this.value);" style="width:305px;">
							<option value="brc-live">Biography Reference Center</option>
							<option value="bbs-live">Business Book Summaries</option>
							<option value="bsi-live_bth">Business Searching Interface</option>
							<option value="chc-live">Consumer Health Complete</option>
							<option value="eds-live">EBSCO Discovery Service</option>
							<option value="ell-live">English Language Learner Reference Center</option>
							<option value="ehost-live" selected="selected">EBSCOhost Research Databases</option>
							<option value="hrc-live">History Reference Center</option>
							<option value="hcrc-live">Hobbies and Crafts Reference Center</option>
							<option value="hirc-live">Home Improvement Reference Center</option>
							<option value="srck5-live">Kids Search</option>
							<option value="lirc-live">Legal Information Reference Center</option>
							<option value="lrc-live">Literary Reference Center</option>
							<option value="novelist-live">NoveList</option>
							<option value="nrc-live">Nursing Reference Center</option>
							<option value="perc-live">Patient Education Reference Center</option>
							<option value="pov-live">Points of View Reference Center</option>
							<option value="rrc-live">Rehabilitation Reference Center</option>
							<option value="scirc-live">Science Reference Center</option>
							<option value="sas-live">Searchasaurus</option>
							<option value="sbrc-live">Small Business Reference Center</option>
							<option value="serrc-live">Small Engine Repair Reference Center</option>
							<option value="slrc-live">Spanish Language Reference Center</option>
							<option value="src-live">Student Research Center</option>
							<option value="swi-live">Sustainability Watch</option>
							</select>
						</div>
					</div>
				</div>

<!-- Database Groups or Specify Databases option for Ehost Interface -->
				<div style="float:left;margin:0;padding:0;width:100%;" id="step1search">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="txtInterface">Choose:</label>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="float:left;"><p><label for="raddb"><input id="raddb" name="radSearch" type="radio" value="db" onclick="displayBlock('searchdatabases',0);displayBlock('searchsubjects',1);displayBlock('searchehisdatabases',0);displayBlock('profileCredentials',1);updateChooseDatabases();" checked="checked" />Databases</label></p></div>
						<div class="labeltext" style="float:left;padding-left:14px;"><p><label for="raddbgroup"><input id="raddbgroup" name="radSearch" type="radio" value="dbgroup" onclick="displayBlock('searchsubjects',0);displayBlock('searchdatabases',1);displayBlock('searchehisdatabases',1);displayBlock('profileCredentials',1);updateChooseDatabases();" />Database Groups</label></p></div>
						<div class="labeltext" style="float:left;padding-left:14px;"><p><label for="raddbprofile"><input id="raddbprofile" name="radSearch" type="radio" value="dbprofile" onclick="displayBlock('profileCredentials',0);displayBlock('searchsubjects',1);displayBlock('searchdatabases',1);displayBlock('searchehisdatabases',1);updateChooseDatabases();" />Profiles</label></p></div>
					</div>
				</div>
				<div style="float:left;margin:0;padding:0;width:100%;" id="step1main">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="txtInterface">Choose:</label>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="float:left;"><p><label for="raddbmain"><input id="raddbmain" name="radSearchMain" type="radio" value="db" onclick="showCurrentDbs();" checked="checked" />Databases</label></p></div>
						<div class="labeltext" style="float:left;padding-left:14px;"><p><label for="raddbprofilemain"><input id="raddbprofilemain" name="radSearchMain" type="radio" value="dbprofile" onclick="hideCurrentDbs();" />Profiles</label></p></div>
					</div>
				</div>
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						&nbsp;
					</div>

<!-- Start of Databases per Interface Section -->

				<div style="float:left;margin:0;padding:0;margin-top:2px;">
					<!-- BRC -->
					<div class="labeltext" id="brc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="brc-live_b6h"><input type="radio" id="brc-live_b6h" name="txtDb_brc-live" value="b6h" checked="checked" />Biography Reference Center <span style="color:#999999">(b6h)</span></label></li>
							</ul>
					</div>
					<!-- BBS -->
					<div class="labeltext" id="bbs-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="bbs-live_qbh"><input type="radio" id="bbs-live_qbh" name="txtDb_bbs-live" value="qbh" checked="checked" />Business Book Summaries <span style="color:#999999">(qbh)</span></label></li>
							</ul>
					</div>
					<!-- BSI Databases -->
						<div class="labeltext" id="bsi-live" style="display:none;">

							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="bsi-live_bth"><input type="radio" id="bsi-live_bth" name="txtDb_bsi-live" value="bth" onchange="selectInterface('bsi-live_bth');" checked="checked" />Business Source Complete <span style="color:#999999">(bth)</span></label></li>
							<li><label for="bsi-live_bch"><input type="radio" id="bsi-live_bch" name="txtDb_bsi-live" value="bch" onchange="selectInterface('bsi-live_bch');" />Business Source Corporate <span style="color:#999999">(bch)</span></label></li>
							<li><label for="bsi-live_buh"><input type="radio" id="bsi-live_buh" name="txtDb_bsi-live" value="buh" onchange="selectInterface('bsi-live_buh');" />Business Source Premier <span style="color:#999999">(buh)</span></label></li>
							<li style="padding-bottom:5px;"><label for="bsi-live_bah"><input type="radio" id="bsi-live_bah" name="txtDb_bsi-live" value="bah" onchange="selectInterface('bsi-live_bah');" />Business Source Premier: Alumni Edition <span style="color:#999999">(bah)</span></label></li>

							<li style="border-top: 1px solid #CCCCCC;padding-top:4px;"><label for="bsi-live_lmh"><input type="checkbox" id="bsi-live_lmh" name="txtDb_bsi-live-a" value="lmh" />Blackwell Encyclopedia of Management <span style="color:#999999">(lmh)</span></label></li>
							<li><label for="bsi-live_ecn"><input type="checkbox" id="bsi-live_ecn" name="txtDb_bsi-live-a" value="ecn" />EconLit <span style="color:#999999">(ecn)</span></label></li>
							<li><label for="bsi-live_eoh"><input type="checkbox" id="bsi-live_eoh" name="txtDb_bsi-live-a" value="eoh" />EconLit with Full Text <span style="color:#999999">(eoh)</span></label></li>
							<li><label for="bsi-live_hoh"><input type="checkbox" id="bsi-live_hoh" name="txtDb_bsi-live-a" value="hoh" />Hospitality and Tourism Index <span style="color:#999999">(hoh)</span></label></li>
							<li><label for="bsi-live_hjh"><input type="checkbox" id="bsi-live_hjh" name="txtDb_bsi-live-a" value="hjh" />Hospitality &amp; Tourism Complete <span style="color:#999999">(hjh)</span></label></li>

							<li><label for="bsi-live_iph"><input type="checkbox" id="bsi-live_iph" name="txtDb_bsi-live-a" value="iph" />Insurance Periodicals Index <span style="color:#999999">(iph)</span></label></li>
							<li><label for="bsi-live_krh"><input type="checkbox" id="bsi-live_krh" name="txtDb_bsi-live-a" value="krh" />McClatchy-Tribune Collection <span style="color:#999999">(krh)</span></label></li>
							<li><label for="bsi-live_bwh"><input type="checkbox" id="bsi-live_bwh" name="txtDb_bsi-live-a" value="bwh" />Regional Business News <span style="color:#999999">(bwh)</span></label></li>
							</ul>
						</div>
					<!-- CHI -->
						<div class="labeltext" id="chc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="chc-live_cmh"><input type="checkbox" id="chc-live_cmh" name="txtDb_chc-live" value="cmh" checked="checked" />Consumer Health Complete <span style="color:#999999">(cmh)</span></label></li>
							</ul>
						</div>
					<!-- EDS -->
						<div class="labeltext" id="eds-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="eds-live_eda"><input type="radio" id="eds-live_eda" name="txtDb_eds-live" value="eda" checked="checked" />EBSCO Discovery Service</label></li>
							</ul>
						</div>
					<!-- ELL -->
						<div class="labeltext" id="ell-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="ell-live_elr"><input type="radio" id="ell-live_elr" name="txtDb_ell-live" value="elr" checked="checked" />English Language Learner Reference Center <span style="color:#999999">(elr)</span></label></li>
							</ul>
						</div>
					<!-- HRC -->
						<div class="labeltext" id="hrc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="hrc-live_khh"><input type="radio" id="hrc-live_khh" name="txtDb_hrc-live" value="khh" checked="checked" />History Reference Center <span style="color:#999999">(khh)</span></label></li>
							</ul>
						</div>
					<!-- HCRC -->
						<div class="labeltext" id="hcrc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="hcrc-live_cfh"><input type="checkbox" id="hcrc-live_cfh" name="txtDb_hcrc-live" value="cfh" checked="checked" />Hobbies and Crafts Reference Center <span style="color:#999999">(cfh)</span></label></li>
							</ul>
						</div>
					<!-- HIRC -->
						<div class="labeltext" id="hirc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="hirc-live_h4h"><input type="checkbox" id="hirc-live_h4h" name="txtDb_hirc-live" value="h4h" checked="checked" />Home Improvement Reference Center <span style="color:#999999">(h4h)</span></label></li>
							</ul>
						</div>
<!-- Databases for SRC K-5 Interface -->
						<div class="labeltext" id="srck5-live" style="display:none;">

							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="srck5-live_afh"><input type="checkbox" id="srck5-live_afh" name="txtDb_srck5-live" value="afh" />Academic Search Elite <span style="color:#999999">(afh)</span></label></li>
							<li><label for="srck5-live_aph"><input type="checkbox" id="srck5-live_aph" name="txtDb_srck5-live" value="aph" />Academic Search Premier <span style="color:#999999">(aph)</span></label></li>
							<li><label for="srck5-live_aqh"><input type="checkbox" id="srck5-live_aqh" name="txtDb_srck5-live" value="aqh" />Advanced Placement Source <span style="color:#999999">(aqh)</span></label></li>
							<li><label for="srck5-live_dch"><input type="checkbox" id="srck5-live_dch" name="txtDb_srck5-live" value="dch" />American Heritage Dictionary <span style="color:#999999">(dch)</span></label></li>

							<li><label for="srck5-live_ndh"><input type="checkbox" id="srck5-live_ndh" name="txtDb_srck5-live" value="ndh" />Book Collection: NonFiction <span style="color:#999999">(ndh)</span></label></li>
							<li><label for="srck5-live_ani"><input type="checkbox" id="srck5-live_ani" name="txtDb_srck5-live" value="ani" />EBSCO Animals <span style="color:#999999">(ani)</span></label></li>
							<li><label for="srck5-live_eric"><input type="checkbox" id="srck5-live_eric" name="txtDb_srck5-live" value="eric" />ERIC <span style="color:#999999">(eric)</span></label></li>
							<li><label for="srck5-live_funk"><input type="checkbox" id="srck5-live_funk" name="txtDb_srck5-live" value="funk" />Funk &amp; Wagnalls New World Encyclopedia <span style="color:#999999">(funk)</span></label></li>

							<li><label for="srck5-live_khh"><input type="checkbox" id="srck5-live_khh" name="txtDb_srck5-live" value="khh" />History Reference Center <span style="color:#999999">(khh)</span></label></li>
							<li><label for="srck5-live_mih"><input type="checkbox" id="srck5-live_mih" name="txtDb_srck5-live" value="mih" />Middle Search Plus <span style="color:#999999">(mih)</span></label></li>
							<li><label for="srck5-live_nfh"><input type="checkbox" id="srck5-live_nfh" name="txtDb_srck5-live" value="nfh" />Newspaper Source <span style="color:#999999">(nfh)</span></label></li>
							<li><label for="srck5-live_prh"><input type="checkbox" id="srck5-live_prh" name="txtDb_srck5-live" value="prh" />Primary Search <span style="color:#999999">(prh)</span></label></li>
							<li><label for="srck5-live_tfh"><input type="checkbox" id="srck5-live_tfh" name="txtDb_srck5-live" value="tfh" />Professional Development Collection <span style="color:#999999">(tfh)</span></label></li>

							<li><label for="srck5-live_sch"><input type="checkbox" id="srck5-live_sch" name="txtDb_srck5-live" value="sch" />Science Reference Center <span style="color:#999999">(sch)</span></label></li>
							<li><label for="srck5-live_tth"><input type="checkbox" id="srck5-live_tth" name="txtDb_srck5-live" value="tth" />TOPICsearch <span style="color:#999999">(tth)</span></label></li>
							</ul>
						</div>
					<!-- LIRC -->
						<div class="labeltext" id="lirc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="lirc-live_lir"><input type="radio" id="lirc-live_lir" name="txtDb_lirc-live" value="lir" checked="checked" />Legal Information Reference Center <span style="color:#999999">(lir)</span></label></li>
							</ul>
						</div>
<!-- Databases for LRC Interface -->
						<div class="labeltext" id="lrc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">

							<li style="padding-bottom:5px;"><label for="lrc-live_lfh"><input type="checkbox" id="lrc-live_lfh" name="txtDb_lrc-live" value="lfh" checked="checked" />Literary Reference Center <span style="color:#999999">(lfh)</span></label></li>
							<li style="border-top: 1px solid #CCCCCC;padding-top:4px;"><label for="lrc-live_cjh"><input type="checkbox" id="lrc-live_cjh" name="txtDb_lrc-live" value="cjh" />Canadian Literary Centre <span style="color:#999999">(cjh)</span></label></li>
							<li><label for="lrc-live_jgh"><input type="checkbox" id="lrc-live_jgh" name="txtDb_lrc-live" value="jgh" />Columbia Grangers Poetry Database <span style="color:#999999">(jgh)</span></label></li>
							<li><label for="lrc-live_pgh"><input type="checkbox" id="lrc-live_pgh" name="txtDb_lrc-live" value="pgh" />Columbia Grangers Poetry Database: School Edition <span style="color:#999999">(pgh)</span></label></li>
							<li><label for="lrc-live_mzh"><input type="checkbox" id="lrc-live_mzh" name="txtDb_lrc-live" value="mzh" />MLA International Bibliography <span style="color:#999999">(mzh)</span></label></li>

							</ul>
						</div>
<!-- Databases for Novelist Interfaces -->
						<div class="labeltext" id="novelist-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="novelist-live_noh"><input type="radio" id="novelist-live_noh" name="txtDb_novelist-live" value="noh" onchange="selectInterface('novelist-live');" checked="checked" />NoveList <span style="color:#999999">(noh)</span></label></li>
							<li><label for="novp-live_neh"><input type="radio" id="novp-live_neh" name="txtDb_novelist-live" value="neh" onchange="selectInterface('novp-live');" />NoveList Plus <span style="color:#999999">(neh)</span></label></li>

							<li><label for="novelistk8-live_nnh"><input type="radio" id="txtDb_novelistk8-live" name="txtDb_novelist-live" value="nnh" onchange="selectInterface('novelistk8-live');" />NoveList K-8 <span style="color:#999999">(nnh)</span></label></li>
							<li><label for="novpk8-live_njh"><input type="radio" id="txtDb_novpk8-live" name="txtDb_novelist-live" value="njh" onchange="selectInterface('novpk8-live');" />NoveList K-8 Plus <span style="color:#999999">(njh)</span></label></li>
							</ul>
						</div>
<!-- Databases for NRC interface -->
						<div class="labeltext" id="nrc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">

							<li style="padding-bottom:5px;"><label for="nrc-live_nrc"><input type="checkbox" id="nrc-live_nrc" name="txtDb_nrc-live" value="nrc" checked="checked" />Nursing Reference Center <span style="color:#999999">(nrc)</span></label></li>
							<li style="border-top: 1px solid #CCCCCC;padding-top:4px;"><label for="nrc-live_cin20"><input type="checkbox" id="nrc-live_cin20" name="txtDb_nrc-live" value="cin20" />CINAHL <span style="color:#999999">(cin20)</span></label></li>
							<li><label for="nrc-live_jlh"><input type="checkbox" id="nrc-live_jlh" name="txtDb_nrc-live" value="jlh" />CINAHL Plus <span style="color:#999999">(jlh)</span></label></li>
							<li><label for="nrc-live_c8h"><input type="checkbox" id="nrc-live_c8h" name="txtDb_nrc-live" value="c8h" />CINAHL with Full Text <span style="color:#999999">(c8h)</span></label></li>
							<li><label for="nrc-live_rzh"><input type="checkbox" id="nrc-live_rzh" name="txtDb_nrc-live" value="rzh" />CINAHL Plus with Full Text <span style="color:#999999">(rzh)</span></label></li>

							<li><label for="nrc-live_cmedm"><input type="checkbox" id="nrc-live_cmedm" name="txtDb_nrc-live" value="cmedm" />MEDLINE <span style="color:#999999">(cmedm)</span></label></li>
							<li><label for="nrc-live_mnh"><input type="checkbox" id="nrc-live_mnh" name="txtDb_nrc-live" value="mnh" />MEDLINE with Full Text <span style="color:#999999">(mnh)</span></label></li>
							</ul>
						</div>
					<!-- PERC -->
						<div class="labeltext" id="perc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">

							<li style="padding-bottom:5px;"><label for="perc-live_perc"><input type="checkbox" id="perc-live_perc" name="txtDb_perc-live" value="perc" checked="checked" />Patient Education Reference Center <span style="color:#999999">(perc)</span></label></li>
							<li style="border-top: 1px solid #CCCCCC;padding-top:4px;"><label for="perc-live_perc&amp;db=nrcn"><input type="checkbox" id="perc-live_perc&amp;db=nrcn" name="txtDb_perc-live" value="nrcn" />Health News <span style="color:#999999">(nrcn)</span></label></li>
							</ul>
						</div>
					<!-- POV -->
						<div class="labeltext" id="pov-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">

							<li><label for="pov-live_pwh"><input type="checkbox" id="pov-live_pwh" name="txtDb_pov-live" value="pwh" checked="checked" />Points of View Reference Center <span style="color:#999999">(pwh)</span></label></li>
							</ul>
						</div>
<!-- Rehab Ref Center databases -->
						<div class="labeltext" id="rrc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">

							<li style="padding-bottom:5px;"><label for="rrc-live_rrc"><input type="checkbox" id="rrc-live_rrc" name="txtDb_rrc-live" value="rrc" checked="checked" />Rehabilitation Reference Center <span style="color:#999999">(rrc)</span></label></li>
							<li style="padding-bottom:5px;"><label for="rrc-live_nrcn"><input type="checkbox" id="rrc-live_nrcn" name="txtDb_rrc-live" value="nrcn" checked="checked" />Health News <span style="color:#999999">(rrc)</span></label></li>
							<li style="border-top: 1px solid #CCCCCC;padding-top:4px;"><label for="rrc-live_"><input type="checkbox" id="rrc-live_cin20" name="txtDb_nrc-live" value="cin20" />CINAHL <span style="color:#999999">(cin20)</span></label></li>
							<li><label for="rrc-live_jlh"><input type="checkbox" id="rrc-live_jlh" name="txtDb_rrc-live" value="jlh" />CINAHL Plus <span style="color:#999999">(jlh)</span></label></li>
							<li><label for="rrc-live_c8h"><input type="checkbox" id="rrc-live_c8h" name="txtDb_rrc-live" value="c8h" />CINAHL with Full Text <span style="color:#999999">(c8h)</span></label></li>
							<li><label for="rrc-live_rzh"><input type="checkbox" id="rrc-live_rzh" name="txtDb_rrc-live" value="rzh" />CINAHL Plus with Full Text <span style="color:#999999">(rzh)</span></label></li>

							<li><label for="rrc-live_cmedm"><input type="checkbox" id="rrc-live_cmedm" name="txtDb_rrc-live" value="cmedm" />MEDLINE <span style="color:#999999">(cmedm)</span></label></li>
							<li><label for="rrc-live_mnh"><input type="checkbox" id="rrc-live_mnh" name="txtDb_rrc-live" value="mnh" />MEDLINE with Full Text <span style="color:#999999">(mnh)</span></label></li>
							<li><label for="rrc-live_sph"><input type="checkbox" id="rrc-live_sph" name="txtDb_rrc-live" value="sph" />SportDISCUS <span style="color:#999999">(sph)</span></label></li>
							<li><label for="rrc-live_s3h"><input type="checkbox" id="rrc-live_s3h" name="txtDb_rrc-live" value="s3h" />SportDISCUS with Full Text <span style="color:#999999">(s3h)</span></label></li>
							<li><label for="rrc-live_rss"><input type="checkbox" id="rrc-live_rss" name="txtDb_rrc-live" value="rss" />Rehabilitation &amp; Sports Medicine Source <span style="color:#999999">(rss)</span></label></li>
							</ul>
						</div>
						
					<!-- SCIRC (Science Reference Center) -->
						<div class="labeltext" id="scirc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="scirc-live_sch"><input type="radio" id="scirc-live_sch" name="txtDb_scirc-live" value="sch" checked="checked" />Science Reference Center <span style="color:#999999">(sch)</span></label></li>
							</ul>
						</div>
						
<!-- Databases for SAS Interface -->
						<div class="labeltext" id="sas-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="sas-live_afh"><input type="checkbox" id="sas-live_afh" name="txtDb_sas-live" value="afh" />Academic Search Elite <span style="color:#999999">(afh)</span></label></li>

							<li><label for="sas-live_aph"><input type="checkbox" id="sas-live_aph" name="txtDb_sas-live" value="aph" />Academic Search Premier <span style="color:#999999">(aph)</span></label></li>
							<li><label for="sas-live_dch"><input type="checkbox" id="sas-live_dch" name="txtDb_sas-live" value="dch" />American Heritage Children's Dictionary <span style="color:#999999">(dch)</span></label></li>
							<li><label for="sas-live_ndh"><input type="checkbox" id="sas-live_ndh" name="txtDb_sas-live" value="ndh" />Book Collection: Nonfiction <span style="color:#999999">(ndh)</span></label></li>
							<li><label for="sas-live_ehh"><input type="checkbox" id="sas-live_ehh" name="txtDb_sas-live" value="ehh" />Education Research Complete <span style="color:#999999">(ehh)</span></label></li>
							<li><label for="sas-live_eric"><input type="checkbox" id="sas-live_eric" name="txtDb_sas-live" value="eric" />ERIC <span style="color:#999999">(eric)</span></label></li>

							<li><label for="sas-live_funk"><input type="checkbox" id="sas-live_funk" name="txtDb_sas-live" value="funk" />Funk &amp; Wagnalls New World Encyclopedia <span style="color:#999999">(funk)</span></label></li>
							<li><label for="sas-live_mih"><input type="checkbox" id="sas-live_mih" name="txtDb_sas-live" value="mih" />Middle Search Plus <span style="color:#999999">(mih)</span></label></li>
							<li><label for="sas-live_nfh"><input type="checkbox" id="sas-live_nfh" name="txtDb_sas-live" value="nfh" />Newspaper Source <span style="color:#999999">(nfh)</span></label></li>
							<li><label for="sas-live_prh"><input type="checkbox" id="sas-live_prh" name="txtDb_sas-live" value="prh" />Primary Search <span style="color:#999999">(prh)</span></label></li>

							<li><label for="sas-live_tfh"><input type="checkbox" id="sas-live_tfh" name="txtDb_sas-live" value="tfh" />Professional Development Collection <span style="color:#999999">(tfh)</span></label></li>
							</ul>
						</div>
						
					<!-- SBRC (Small Business Reference Center) -->
						<div class="labeltext" id="sbrc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="sbrc-live_b9h"><input type="radio" id="sbrc-live_b9h" name="txtDb_sbrc-live" value="b9h" checked="checked" />Small Business Reference Center  <span style="color:#999999">(b9h)</span></label></li>
							</ul>
						</div>
						
					<!-- SERRC (Small Enginge Repair Reference Center) -->
						<div class="labeltext" id="serrc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="serrc-live_s9h"><input type="checkbox" id="serrc-live_s9h" name="txtDb_serrc-live" value="s9h" checked="checked" />Small Engine Repair Reference Center <span style="color:#999999">(s9h)</span></label></li>

							</ul>
						</div>
					
					<!-- SLRC (Spanish Language Reference Center) -->
						<div class="labeltext" id="slrc-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="slrc-live_zah"><input type="radio" id="slrc-live_zah" name="txtDb_slrc-live" value="zah" checked="checked" />Spanish Language Reference Center <span style="color:#999999">(zah)</span></label></li>
							</ul>
						</div>
	
<!-- Databases Listed for SRC Interface -->

						<div class="labeltext" id="src-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="src-live_aqh"><input type="checkbox" id="src-live_aqh" name="txtDb_src-live" value="aqh" />Advanced Placement Source <span style="color:#999999">(aqh)</span></label></li>
							<li><label for="src-live_afh"><input type="checkbox" id="src-live_afh" name="txtDb_src-live" value="afh" />Academic Search Elite <span style="color:#999999">(afh)</span></label></li>

							<li><label for="src-live_aph"><input type="checkbox" id="src-live_aph" name="txtDb_src-live" value="aph" />Academic Search Premier <span style="color:#999999">(aph)</span></label></li>
							<li><label for="src-live_dch"><input type="checkbox" id="src-live_dch" name="txtDb_src-live" value="dch" />American Heritage Dictionary <span style="color:#999999">(dch)</span></label></li>
							<li><label for="src-live_anh"><input type="checkbox" id="src-live_anh" name="txtDb_src-live" value="anh" />Australia/New Zealand Reference Centre <span style="color:#999999">(anh)</span></label></li>
							<li><label for="src-live_b5h"><input type="checkbox" id="src-live_b5h" name="txtDb_src-live" value="b5h" />Biography Collection Complete <span style="color:#999999">(b5h)</span></label></li>
							<li><label for="src-live_ndh"><input type="checkbox" id="src-live_ndh" name="txtDb_src-live" value="ndh" />Book Collection: Nonfiction <span style="color:#999999">(ndh)</span></label></li>

							<li><label for="src-live_umh"><input type="checkbox" id="src-live_umh" name="txtDb_src-live" value="umh" />Columbia Encyclopedia <span style="color:#999999">(umh)</span></label></li>
							<li><label for="src-live_pgh"><input type="checkbox" id="src-live_pgh" name="txtDb_src-live" value="pgh" />Columbia Granger's Poetry Database: School Edition <span style="color:#999999">(pgh)</span></label></li>
							<li><label for="src-live_eric"><input type="checkbox" id="src-live_eric" name="txtDb_src-live" value="eric" />ERIC <span style="color:#999999">(eric)</span></label></li>
							<li><label for="src-live_gsh"><input type="checkbox" id="src-live_gsh" name="txtDb_src-live" value="gsh" />General Science Collection <span style="color:#999999">(gsh)</span></label></li>
							<li><label for="src-live_hxh"><input type="checkbox" id="src-live_hxh" name="txtDb_src-live" value="hxh" />Health Source - Consumer Edition <span style="color:#999999">(hxh)</span></label></li>

							<li><label for="src-live_khh"><input type="checkbox" id="src-live_khh" name="txtDb_src-live" value="khh" />History Reference Center <span style="color:#999999">(khh)</span></label></li>
							<li><label for="src-live_mjh"><input type="checkbox" id="src-live_mjh" name="txtDb_src-live" value="mjh" />MagillOnLiteraturePlus <span style="color:#999999">(mjh)</span></label></li>
							<li><label for="src-live_ulh"><input type="checkbox" id="src-live_ulh" name="txtDb_src-live" value="ulh" />MAS Ultra - School Edition <span style="color:#999999">(ulh)</span></label></li>
							<li><label for="src-live_mih"><input type="checkbox" id="src-live_mih" name="txtDb_src-live" value="mih" />Middle Search Plus <span style="color:#999999">(mih)</span></label></li>
							<li><label for="src-live_nfh"><input type="checkbox" id="src-live_nfh" name="txtDb_src-live" value="nfh" />Newspaper Source <span style="color:#999999">(nfh)</span></label></li>

							<li><label for="src-live_tfh"><input type="checkbox" id="src-live_tfh" name="txtDb_src-live" value="tfh" />Professional Development Collection <span style="color:#999999">(tfh)</span></label></li>
							<li><label for="src-live_sch"><input type="checkbox" id="src-live_sch" name="txtDb_src-live" value="sch" />Science Reference Center <span style="color:#999999">(sch)</span></label></li>
							<li><label for="src-live_tth"><input type="checkbox" id="src-live_tth" name="txtDb_src-live" value="tth" />TOPICSearch <span style="color:#999999">(tth)</span></label></li>
							<li><label for="src-live_ukh"><input type="checkbox" id="src-live_ukh" name="txtDb_src-live" value="ukh" />UK/EIRE Reference Centre <span style="color:#999999">(ukh)</span></label></li>
							<li><label for="src-live_voh"><input type="checkbox" id="src-live_voh" name="txtDb_src-live" value="voh" />Vocational and Career Collection <span style="color:#999999">(voh)</span></label></li>

							</ul>
						</div>
						
					<!-- SWI (Sustainability Watch) -->
						<div class="labeltext" id="swi-live" style="display:none;">
							<ul class="multiselect" style="margin:0;padding:0;">
							<li><label for="swi-live_suw"><input type="radio" id="swi-live_suw" name="txtDb_swi-live" value="suw" checked="checked" />Sustainability Watch <span style="color:#999999">(suw)</span></label></li>
							</ul>
						</div>
						
<!-- Databases listed for Ehost Interface -->
						<div id="searchdatabases">
							<div class="labeltext" id="ehost-live" style="display:none;">
									<ul class="multiselect" style="margin:0;padding:0;" id="ehost-live-databases">
										<!-- To add more databases for Ehost, add a list item below with the same format, just add the db code & label where applicable -->
										<li><label for='a1h'><input type='checkbox' id='a1h' name='txtDatabases' onclick='updateChooseDatabases();' value='a1h' />ABC-CLIO Biographies<span style='color:#999999'>(a1h)</span></label></li>
										<li><label for='27h'><input type='checkbox' id='27h' name='txtDatabases' onclick='updateChooseDatabases();' value='27h' />Abstracts in Social Gerontology<span style='color:#999999'>(27h)</span></label></li>
										<li><label for='wch'><input type='checkbox' id='wch' name='txtDatabases' onclick='updateChooseDatabases();' value='wch' />Abstracts of Articles by Wharton Faculty<span style='color:#999999'>(wch)</span></label></li>
										<li><label for='auh'><input type='checkbox' id='auh' name='txtDatabases' onclick='updateChooseDatabases();' value='auh' />Academic Abstracts FullTEXT Ultra<span style='color:#999999'>(auh)</span></label></li>
										<li><label for='a2h'><input type='checkbox' id='a2h' name='txtDatabases' onclick='updateChooseDatabases();' value='a2h' />Academic Search Alumni Edition<span style='color:#999999'>(a2h)</span></label></li>
										<li><label for='a9h'><input type='checkbox' id='a9h' name='txtDatabases' onclick='updateChooseDatabases();' value='a9h' />Academic Search Complete<span style='color:#999999'>(a9h)</span></label></li>
										<li><label for='afh'><input type='checkbox' id='afh' name='txtDatabases' onclick='updateChooseDatabases();' value='afh' />Academic Search Elite<span style='color:#999999'>(afh)</span></label></li>
										<li><label for='asm'><input type='checkbox' id='asm' name='txtDatabases' onclick='updateChooseDatabases();' value='asm' />Academic Search Main Edition<span style='color:#999999'>(asm)</span></label></li>
										<li><label for='aph'><input type='checkbox' id='aph' name='txtDatabases' onclick='updateChooseDatabases();' value='aph' />Academic Search Premier<span style='color:#999999'>(aph)</span></label></li>
										<li><label for='asr'><input type='checkbox' id='asr' name='txtDatabases' onclick='updateChooseDatabases();' value='asr' />Academic Search Research & Development<span style='color:#999999'>(asr)</span></label></li>
										<li><label for='s8h'><input type='checkbox' id='s8h' name='txtDatabases' onclick='updateChooseDatabases();' value='s8h' />Academic Source Complete<span style='color:#999999'>(s8h)</span></label></li>
										<li><label for='a3h'><input type='checkbox' id='a3h' name='txtDatabases' onclick='updateChooseDatabases();' value='a3h' />Academic Source Premier<span style='color:#999999'>(a3h)</span></label></li>
										<li><label for='l3r'><input type='checkbox' id='l3r' name='txtDatabases' onclick='updateChooseDatabases();' value='l3r' />Accounting & Finance Learning Center<span style='color:#999999'>(l3r)</span></label></li>
										<li><label for='aqh'><input type='checkbox' id='aqh' name='txtDatabases' onclick='updateChooseDatabases();' value='aqh' />Advanced Placement Source<span style='color:#999999'>(aqh)</span></label></li>
										<li><label for='apv'><input type='checkbox' id='apv' name='txtDatabases' onclick='updateChooseDatabases();' value='apv' />Advanstar Communications Collection<span style='color:#999999'>(apv)</span></label></li>
										<li><label for='awn'><input type='checkbox' id='awn' name='txtDatabases' onclick='updateChooseDatabases();' value='awn' />Africa-Wide Information<span style='color:#999999'>(awn)</span></label></li>
										<li><label for='fnu'><input type='checkbox' id='fnu' name='txtDatabases' onclick='updateChooseDatabases();' value='fnu' />African American Archives<span style='color:#999999'>(fnu)</span></label></li>
										<li><label for='gnh'><input type='checkbox' id='gnh' name='txtDatabases' onclick='updateChooseDatabases();' value='gnh' />AgeLine<span style='color:#999999'>(gnh)</span></label></li>
										<li><label for='agr'><input type='checkbox' id='agr' name='txtDatabases' onclick='updateChooseDatabases();' value='agr' />Agricola<span style='color:#999999'>(agr)</span></label></li>
										<li><label for='edsast'><input type='checkbox' id='edsast' name='txtDatabases' onclick='updateChooseDatabases();' value='edsast' />Alexander Street Press<span style='color:#999999'>(edsast)</span></label></li>
										<li><label for='awh'><input type='checkbox' id='awh' name='txtDatabases' onclick='updateChooseDatabases();' value='awh' />Alt HealthWatch<span style='color:#999999'>(awh)</span></label></li>
										<li><label for='apn'><input type='checkbox' id='apn' name='txtDatabases' onclick='updateChooseDatabases();' value='apn' />Alternative Press Index<span style='color:#999999'>(apn)</span></label></li>
										<li><label for='veh'><input type='checkbox' id='veh' name='txtDatabases' onclick='updateChooseDatabases();' value='veh' />AMA Archive<span style='color:#999999'>(veh)</span></label></li>
										<li><label for='amed'><input type='checkbox' id='amed' name='txtDatabases' onclick='updateChooseDatabases();' value='amed' />AMED (Alternative Medicine)<span style='color:#999999'>(amed)</span></label></li>
										<li><label for='ahl'><input type='checkbox' id='ahl' name='txtDatabases' onclick='updateChooseDatabases();' value='ahl' />America: History & Life<span style='color:#999999'>(ahl)</span></label></li>
										<li><label for='31h'><input type='checkbox' id='31h' name='txtDatabases' onclick='updateChooseDatabases();' value='31h' />America: History and Life with Full Text<span style='color:#999999'>(31h)</span></label></li>
										<li><label for='h9h'><input type='checkbox' id='h9h' name='txtDatabases' onclick='updateChooseDatabases();' value='h9h' />American Antiquarian Society (AAS) Historical Periodicals Collection: Series 1<span style='color:#999999'>(h9h)</span></label></li>
										<li><label for='h9i'><input type='checkbox' id='h9i' name='txtDatabases' onclick='updateChooseDatabases();' value='h9i' />American Antiquarian Society (AAS) Historical Periodicals Collection: Series 2<span style='color:#999999'>(h9i)</span></label></li>
										<li><label for='sbh'><input type='checkbox' id='sbh' name='txtDatabases' onclick='updateChooseDatabases();' value='sbh' />American Bibliography of Slavic and East European Studies<span style='color:#999999'>(sbh)</span></label></li>
										<li><label for='dch'><input type='checkbox' id='dch' name='txtDatabases' onclick='updateChooseDatabases();' value='dch' />American Heritage Children's Dictionary<span style='color:#999999'>(dch)</span></label></li>
										<li><label for='hhh'><input type='checkbox' id='hhh' name='txtDatabases' onclick='updateChooseDatabases();' value='hhh' />American Humanities Index<span style='color:#999999'>(hhh)</span></label></li>
										<li><label for='fnv'><input type='checkbox' id='fnv' name='txtDatabases' onclick='updateChooseDatabases();' value='fnv' />American Revolution Archives<span style='color:#999999'>(fnv)</span></label></li>
										<li><label for='h7h'><input type='checkbox' id='h7h' name='txtDatabases' onclick='updateChooseDatabases();' value='h7h' />American Theological Library Association (ATLA) Historical Monographs  Collection: Series 1<span style='color:#999999'>(h7h)</span></label></li>
										<li><label for='h8h'><input type='checkbox' id='h8h' name='txtDatabases' onclick='updateChooseDatabases();' value='h8h' />American Theological Library Association (ATLA) Historical Monographs Collection: Series 2<span style='color:#999999'>(h8h)</span></label></li>
										<li><label for='vfh'><input type='checkbox' id='vfh' name='txtDatabases' onclick='updateChooseDatabases();' value='vfh' />AOM Archive<span style='color:#999999'>(vfh)</span></label></li>
										<li><label for='axh'><input type='checkbox' id='axh' name='txtDatabases' onclick='updateChooseDatabases();' value='axh' />Applied Science & Technology Abstracts (H.W. Wilson)<span style='color:#999999'>(axh)</span></label></li>
										<li><label for='fih'><input type='checkbox' id='fih' name='txtDatabases' onclick='updateChooseDatabases();' value='fih' />Arctic & Antarctic Regions<span style='color:#999999'>(fih)</span></label></li>
										<li><label for='vth'><input type='checkbox' id='vth' name='txtDatabases' onclick='updateChooseDatabases();' value='vth' />Art & Architecture Complete<span style='color:#999999'>(vth)</span></label></li>
										<li><label for='0ah'><input type='checkbox' id='0ah' name='txtDatabases' onclick='updateChooseDatabases();' value='0ah' />Art & Architecture Index<span style='color:#999999'>(0ah)</span></label></li>
										<li><label for='ach'><input type='checkbox' id='ach' name='txtDatabases' onclick='updateChooseDatabases();' value='ach' />Art Abstracts (H.W. Wilson)<span style='color:#999999'>(ach)</span></label></li>
										<li><label for='ajh'><input type='checkbox' id='ajh' name='txtDatabases' onclick='updateChooseDatabases();' value='ajh' />Art Index Retrospective: 1929 - 1984 (H.W. Wilson)<span style='color:#999999'>(ajh)</span></label></li>
										<li><label for='h6a'><input type='checkbox' id='h6a' name='txtDatabases' onclick='updateChooseDatabases();' value='h6a' />Arte Público Hispanic Historical Collection: Series 1<span style='color:#999999'>(h6a)</span></label></li>
										<li><label for='wah'><input type='checkbox' id='wah' name='txtDatabases' onclick='updateChooseDatabases();' value='wah' />Articles by Wharton Faculty<span style='color:#999999'>(wah)</span></label></li>
										<li><label for='oih'><input type='checkbox' id='oih' name='txtDatabases' onclick='updateChooseDatabases();' value='oih' />Associates Programs Source<span style='color:#999999'>(oih)</span></label></li>
										<li><label for='p6h'><input type='checkbox' id='p6h' name='txtDatabases' onclick='updateChooseDatabases();' value='p6h' />Associates Programs Source Plus<span style='color:#999999'>(p6h)</span></label></li>
										<li><label for='reh'><input type='checkbox' id='reh' name='txtDatabases' onclick='updateChooseDatabases();' value='reh' />ATLA Religion Database<span style='color:#999999'>(reh)</span></label></li>
										<li><label for='rfh'><input type='checkbox' id='rfh' name='txtDatabases' onclick='updateChooseDatabases();' value='rfh' />ATLA Religion Database with ATLASerials<span style='color:#999999'>(rfh)</span></label></li>
										<li><label for='a6h'><input type='checkbox' id='a6h' name='txtDatabases' onclick='updateChooseDatabases();' value='a6h' />ATLASerials, Religion Collection<span style='color:#999999'>(a6h)</span></label></li>
										<li><label for='bvh'><input type='checkbox' id='bvh' name='txtDatabases' onclick='updateChooseDatabases();' value='bvh' />Avery Index to Architectural Periodicals<span style='color:#999999'>(bvh)</span></label></li>
										<li><label for='fph'><input type='checkbox' id='fph' name='txtDatabases' onclick='updateChooseDatabases();' value='fph' />Bibliography of Native North Americans<span style='color:#999999'>(fph)</span></label></li>
										<li><label for='b4h'><input type='checkbox' id='b4h' name='txtDatabases' onclick='updateChooseDatabases();' value='b4h' />Biography Collection<span style='color:#999999'>(b4h)</span></label></li>
										<li><label for='b5h'><input type='checkbox' id='b5h' name='txtDatabases' onclick='updateChooseDatabases();' value='b5h' />Biography Collection Complete<span style='color:#999999'>(b5h)</span></label></li>
										<li><label for='b6h'><input type='checkbox' id='b6h' name='txtDatabases' onclick='updateChooseDatabases();' value='b6h' />Biography Reference Center<span style='color:#999999'>(b6h)</span></label></li>
										<li><label for='bjh'><input type='checkbox' id='bjh' name='txtDatabases' onclick='updateChooseDatabases();' value='bjh' />Biological & Agricultural Index (H.W. Wilson)<span style='color:#999999'>(bjh)</span></label></li>
										<li><label for='bxh'><input type='checkbox' id='bxh' name='txtDatabases' onclick='updateChooseDatabases();' value='bxh' />Biological Abstracts<span style='color:#999999'>(bxh)</span></label></li>
										<li><label for='boh'><input type='checkbox' id='boh' name='txtDatabases' onclick='updateChooseDatabases();' value='boh' />Biological Abstracts 1969 - Present<span style='color:#999999'>(boh)</span></label></li>
										<li><label for='bmh'><input type='checkbox' id='bmh' name='txtDatabases' onclick='updateChooseDatabases();' value='bmh' />Biomedical Reference Collection: Basic<span style='color:#999999'>(bmh)</span></label></li>
										<li><label for='byh'><input type='checkbox' id='byh' name='txtDatabases' onclick='updateChooseDatabases();' value='byh' />Biomedical Reference Collection: Comprehensive<span style='color:#999999'>(byh)</span></label></li>
										<li><label for='cxh'><input type='checkbox' id='cxh' name='txtDatabases' onclick='updateChooseDatabases();' value='cxh' />Biomedical Reference Collection: Corporate<span style='color:#999999'>(cxh)</span></label></li>
										<li><label for='beh'><input type='checkbox' id='beh' name='txtDatabases' onclick='updateChooseDatabases();' value='beh' />Biomedical Reference Collection: Expanded<span style='color:#999999'>(beh)</span></label></li>
										<li><label for='kfh'><input type='checkbox' id='kfh' name='txtDatabases' onclick='updateChooseDatabases();' value='kfh' />BIR Entertainment<span style='color:#999999'>(kfh)</span></label></li>
										<li><label for='n4h'><input type='checkbox' id='n4h' name='txtDatabases' onclick='updateChooseDatabases();' value='n4h' />Book Collection Nonfiction: Elementary School Edition<span style='color:#999999'>(n4h)</span></label></li>
										<li><label for='n9h'><input type='checkbox' id='n9h' name='txtDatabases' onclick='updateChooseDatabases();' value='n9h' />Book Collection Nonfiction: High School Edition<span style='color:#999999'>(n9h)</span></label></li>
										<li><label for='n8h'><input type='checkbox' id='n8h' name='txtDatabases' onclick='updateChooseDatabases();' value='n8h' />Book Collection Nonfiction: Middle School Edition<span style='color:#999999'>(n8h)</span></label></li>
										<li><label for='ndh'><input type='checkbox' id='ndh' name='txtDatabases' onclick='updateChooseDatabases();' value='ndh' />Book Collection: Nonfiction<span style='color:#999999'>(ndh)</span></label></li>
										<li><label for='kdh'><input type='checkbox' id='kdh' name='txtDatabases' onclick='updateChooseDatabases();' value='kdh' />Book Index with Reviews<span style='color:#999999'>(kdh)</span></label></li>
										<li><label for='bqh'><input type='checkbox' id='bqh' name='txtDatabases' onclick='updateChooseDatabases();' value='bqh' />Book Review Digest (H.W. Wilson)<span style='color:#999999'>(bqh)</span></label></li>
										<li><label for='irubourne'><input type='checkbox' id='irubourne' name='txtDatabases' onclick='updateChooseDatabases();' value='irubourne' />Bournemouth University Research Online (BURO)<span style='color:#999999'>(irubourne)</span></label></li>
										<li><label for='qoh'><input type='checkbox' id='qoh' name='txtDatabases' onclick='updateChooseDatabases();' value='qoh' />Britannica Online Collection<span style='color:#999999'>(qoh)</span></label></li>
										<li><label for='qph'><input type='checkbox' id='qph' name='txtDatabases' onclick='updateChooseDatabases();' value='qph' />Britannica.com Premium Collection<span style='color:#999999'>(qph)</span></label></li>
										<li><label for='edsbl'><input type='checkbox' id='edsbl' name='txtDatabases' onclick='updateChooseDatabases();' value='edsbl' />British Library Document Supply Centre Inside Serials & Conference Proceedings<span style='color:#999999'>(edsbl)</span></label></li>
										<li><label for='bnh'><input type='checkbox' id='bnh' name='txtDatabases' onclick='updateChooseDatabases();' value='bnh' />British Nursing Index<span style='color:#999999'>(bnh)</span></label></li>
										<li><label for='qbh'><input type='checkbox' id='qbh' name='txtDatabases' onclick='updateChooseDatabases();' value='qbh' />Business Book Summaries<span style='color:#999999'>(qbh)</span></label></li>
										<li><label for='bcr'><input type='checkbox' id='bcr' name='txtDatabases' onclick='updateChooseDatabases();' value='bcr' />Business Continuity & Disaster Recovery Reference Center<span style='color:#999999'>(bcr)</span></label></li>
										<li><label for='bah'><input type='checkbox' id='bah' name='txtDatabases' onclick='updateChooseDatabases();' value='bah' />Business Source Alumni Edition<span style='color:#999999'>(bah)</span></label></li>
										<li><label for='bag'><input type='checkbox' id='bag' name='txtDatabases' onclick='updateChooseDatabases();' value='bag' />Business Source Alumni Edition: Government Edition<span style='color:#999999'>(bag)</span></label></li>
										<li><label for='bth'><input type='checkbox' id='bth' name='txtDatabases' onclick='updateChooseDatabases();' value='bth' />Business Source Complete<span style='color:#999999'>(bth)</span></label></li>
										<li><label for='bcg'><input type='checkbox' id='bcg' name='txtDatabases' onclick='updateChooseDatabases();' value='bcg' />Business Source Complete: Government Edition<span style='color:#999999'>(bcg)</span></label></li>
										<li><label for='bch'><input type='checkbox' id='bch' name='txtDatabases' onclick='updateChooseDatabases();' value='bch' />Business Source Corporate<span style='color:#999999'>(bch)</span></label></li>
										<li><label for='bcw'><input type='checkbox' id='bcw' name='txtDatabases' onclick='updateChooseDatabases();' value='bcw' />Business Source Corporate (Select Edition)<span style='color:#999999'>(bcw)</span></label></li>
										<li><label for='bsh'><input type='checkbox' id='bsh' name='txtDatabases' onclick='updateChooseDatabases();' value='bsh' />Business Source Elite<span style='color:#999999'>(bsh)</span></label></li>
										<li><label for='beg'><input type='checkbox' id='beg' name='txtDatabases' onclick='updateChooseDatabases();' value='beg' />Business Source Elite: Government Edition<span style='color:#999999'>(beg)</span></label></li>
										<li><label for='bme'><input type='checkbox' id='bme' name='txtDatabases' onclick='updateChooseDatabases();' value='bme' />Business Source Main Edition<span style='color:#999999'>(bme)</span></label></li>
										<li><label for='buh'><input type='checkbox' id='buh' name='txtDatabases' onclick='updateChooseDatabases();' value='buh' />Business Source Premier<span style='color:#999999'>(buh)</span></label></li>
										<li><label for='bpg'><input type='checkbox' id='bpg' name='txtDatabases' onclick='updateChooseDatabases();' value='bpg' />Business Source Premier: Government Edition<span style='color:#999999'>(bpg)</span></label></li>
										<li><label for='dgh'><input type='checkbox' id='dgh' name='txtDatabases' onclick='updateChooseDatabases();' value='dgh' />Business Source Select<span style='color:#999999'>(dgh)</span></label></li>
										<li><label for='lah'><input type='checkbox' id='lah' name='txtDatabases' onclick='updateChooseDatabases();' value='lah' />CAB Abstracts<span style='color:#999999'>(lah)</span></label></li>
										<li><label for='lbh'><input type='checkbox' id='lbh' name='txtDatabases' onclick='updateChooseDatabases();' value='lbh' />CAB Abstracts 1990-Present<span style='color:#999999'>(lbh)</span></label></li>
										<li><label for='ldh'><input type='checkbox' id='ldh' name='txtDatabases' onclick='updateChooseDatabases();' value='ldh' />CAB Abstracts Archive<span style='color:#999999'>(ldh)</span></label></li>
										<li><label for='cup'><input type='checkbox' id='cup' name='txtDatabases' onclick='updateChooseDatabases();' value='cup' />Cambridge University Biographies<span style='color:#999999'>(cup)</span></label></li>
										<li><label for='cjh'><input type='checkbox' id='cjh' name='txtDatabases' onclick='updateChooseDatabases();' value='cjh' />Canadian Literary Centre<span style='color:#999999'>(cjh)</span></label></li>
										<li><label for='c0h'><input type='checkbox' id='c0h' name='txtDatabases' onclick='updateChooseDatabases();' value='c0h' />Canadian Nurses Association Collection<span style='color:#999999'>(c0h)</span></label></li>
										<li><label for='rch'><input type='checkbox' id='rch' name='txtDatabases' onclick='updateChooseDatabases();' value='rch' />Canadian Reference Centre<span style='color:#999999'>(rch)</span></label></li>
										<li><label for='crm'><input type='checkbox' id='crm' name='txtDatabases' onclick='updateChooseDatabases();' value='crm' />Canadian Reference Centre Main Edition<span style='color:#999999'>(crm)</span></label></li>
										<li><label for='2ch'><input type='checkbox' id='2ch' name='txtDatabases' onclick='updateChooseDatabases();' value='2ch' />Canadian Sport Database<span style='color:#999999'>(2ch)</span></label></li>
										<li><label for='b7h'><input type='checkbox' id='b7h' name='txtDatabases' onclick='updateChooseDatabases();' value='b7h' />Caribbean Search<span style='color:#999999'>(b7h)</span></label></li>
										<li><label for='vah'><input type='checkbox' id='vah' name='txtDatabases' onclick='updateChooseDatabases();' value='vah' />Catholic Periodical and Literature Index<span style='color:#999999'>(vah)</span></label></li>
										<li><label for='e5h'><input type='checkbox' id='e5h' name='txtDatabases' onclick='updateChooseDatabases();' value='e5h' />Central & Eastern European Academic Source<span style='color:#999999'>(e5h)</span></label></li>
										<li><label for='fgh'><input type='checkbox' id='fgh' name='txtDatabases' onclick='updateChooseDatabases();' value='fgh' />Child Development & Adolescent Studies<span style='color:#999999'>(fgh)</span></label></li>
										<li><label for='33h'><input type='checkbox' id='33h' name='txtDatabases' onclick='updateChooseDatabases();' value='33h' />Christian Periodical Index<span style='color:#999999'>(33h)</span></label></li>
										<li><label for='cin20'><input type='checkbox' id='cin20' name='txtDatabases' onclick='updateChooseDatabases();' value='cin20' />CINAHL<span style='color:#999999'>(cin20)</span></label></li>
										<li><label for='01h'><input type='checkbox' id='01h' name='txtDatabases' onclick='updateChooseDatabases();' value='01h' />Cinahl Nursing Guide<span style='color:#999999'>(01h)</span></label></li>
										<li><label for='jlh'><input type='checkbox' id='jlh' name='txtDatabases' onclick='updateChooseDatabases();' value='jlh' />CINAHL Plus<span style='color:#999999'>(jlh)</span></label></li>
										<li><label for='rzh'><input type='checkbox' id='rzh' name='txtDatabases' onclick='updateChooseDatabases();' value='rzh' />CINAHL Plus with Full Text<span style='color:#999999'>(rzh)</span></label></li>
										<li><label for='c8h'><input type='checkbox' id='c8h' name='txtDatabases' onclick='updateChooseDatabases();' value='c8h' />CINAHL with Full Text<span style='color:#999999'>(c8h)</span></label></li>
										<li><label for='cks'><input type='checkbox' id='cks' name='txtDatabases' onclick='updateChooseDatabases();' value='cks' />Clinical Knowledge Summaries<span style='color:#999999'>(cks)</span></label></li>
										<li><label for='prs'><input type='checkbox' id='prs' name='txtDatabases' onclick='updateChooseDatabases();' value='prs' />Clinical Reference Systems<span style='color:#999999'>(prs)</span></label></li>
										<li><label for='cgh'><input type='checkbox' id='cgh' name='txtDatabases' onclick='updateChooseDatabases();' value='cgh' />Cochrane Central Register of Controlled Trials<span style='color:#999999'>(cgh)</span></label></li>
										<li><label for='chh'><input type='checkbox' id='chh' name='txtDatabases' onclick='updateChooseDatabases();' value='chh' />Cochrane Database of Systematic Reviews<span style='color:#999999'>(chh)</span></label></li>
										<li><label for='cmr'><input type='checkbox' id='cmr' name='txtDatabases' onclick='updateChooseDatabases();' value='cmr' />Cochrane Methodology Register<span style='color:#999999'>(cmr)</span></label></li>
										<li><label for='umh'><input type='checkbox' id='umh' name='txtDatabases' onclick='updateChooseDatabases();' value='umh' />Columbia Encyclopedia<span style='color:#999999'>(umh)</span></label></li>
										<li><label for='jgh'><input type='checkbox' id='jgh' name='txtDatabases' onclick='updateChooseDatabases();' value='jgh' />Columbia Granger's Poetry Database<span style='color:#999999'>(jgh)</span></label></li>
										<li><label for='pgh'><input type='checkbox' id='pgh' name='txtDatabases' onclick='updateChooseDatabases();' value='pgh' />Columbia Granger's Poetry Database: School Edition<span style='color:#999999'>(pgh)</span></label></li>
										<li><label for='ufh'><input type='checkbox' id='ufh' name='txtDatabases' onclick='updateChooseDatabases();' value='ufh' />Communication & Mass Media Complete<span style='color:#999999'>(ufh)</span></label></li>
										<li><label for='ugh'><input type='checkbox' id='ugh' name='txtDatabases' onclick='updateChooseDatabases();' value='ugh' />Communication & Mass Media Index<span style='color:#999999'>(ugh)</span></label></li>
										<li><label for='cax'><input type='checkbox' id='cax' name='txtDatabases' onclick='updateChooseDatabases();' value='cax' />Communication Abstracts<span style='color:#999999'>(cax)</span></label></li>
										<li><label for='iah'><input type='checkbox' id='iah' name='txtDatabases' onclick='updateChooseDatabases();' value='iah' />Comprehensive Subject Index<span style='color:#999999'>(iah)</span></label></li>
										<li><label for='ckh'><input type='checkbox' id='ckh' name='txtDatabases' onclick='updateChooseDatabases();' value='ckh' />Computer Science Index<span style='color:#999999'>(ckh)</span></label></li>
										<li><label for='cph'><input type='checkbox' id='cph' name='txtDatabases' onclick='updateChooseDatabases();' value='cph' />Computer Source<span style='color:#999999'>(cph)</span></label></li>
										<li><label for='iih'><input type='checkbox' id='iih' name='txtDatabases' onclick='updateChooseDatabases();' value='iih' />Computers & Applied Sciences Complete<span style='color:#999999'>(iih)</span></label></li>
										<li><label for='cmh'><input type='checkbox' id='cmh' name='txtDatabases' onclick='updateChooseDatabases();' value='cmh' />Consumer Health Complete<span style='color:#999999'>(cmh)</span></label></li>
										<li><label for='c9h'><input type='checkbox' id='c9h' name='txtDatabases' onclick='updateChooseDatabases();' value='c9h' />Consumer Health Complete - EBSCOhost<span style='color:#999999'>(c9h)</span></label></li>
										<li><label for='chm'><input type='checkbox' id='chm' name='txtDatabases' onclick='updateChooseDatabases();' value='chm' />Consumer Health Main Edition<span style='color:#999999'>(chm)</span></label></li>
										<li><label for='z0h'><input type='checkbox' id='z0h' name='txtDatabases' onclick='updateChooseDatabases();' value='z0h' />ContentSelect Research Navigator<span style='color:#999999'>(z0h)</span></label></li>
										<li><label for='clw'><input type='checkbox' id='clw' name='txtDatabases' onclick='updateChooseDatabases();' value='clw' />Corporate Learning Watch<span style='color:#999999'>(clw)</span></label></li>
										<li><label for='crh'><input type='checkbox' id='crh' name='txtDatabases' onclick='updateChooseDatabases();' value='crh' />Corporate ResourceNet<span style='color:#999999'>(crh)</span></label></li>
										<li><label for='cja'><input type='checkbox' id='cja' name='txtDatabases' onclick='updateChooseDatabases();' value='cja' />Criminal Justice Abstracts<span style='color:#999999'>(cja)</span></label></li>
										<li><label for='srh'><input type='checkbox' id='srh' name='txtDatabases' onclick='updateChooseDatabases();' value='srh' />CrossRef<span style='color:#999999'>(srh)</span></label></li>
										<li><label for='cuh'><input type='checkbox' id='cuh' name='txtDatabases' onclick='updateChooseDatabases();' value='cuh' />Current Abstracts<span style='color:#999999'>(cuh)</span></label></li>
										<li><label for='cqh'><input type='checkbox' id='cqh' name='txtDatabases' onclick='updateChooseDatabases();' value='cqh' />Current Biography Illustrated (H.W. Wilson)<span style='color:#999999'>(cqh)</span></label></li>
										<li><label for='dah'><input type='checkbox' id='dah' name='txtDatabases' onclick='updateChooseDatabases();' value='dah' />Database of Abstracts of Reviews of Effects<span style='color:#999999'>(dah)</span></label></li>
										<li><label for='ddh'><input type='checkbox' id='ddh' name='txtDatabases' onclick='updateChooseDatabases();' value='ddh' />Dentistry & Oral Sciences Source<span style='color:#999999'>(ddh)</span></label></li>
										<li><label for='irdrake'><input type='checkbox' id='irdrake' name='txtDatabases' onclick='updateChooseDatabases();' value='irdrake' />Drake E-Scholarshare<span style='color:#999999'>(irdrake)</span></label></li>
										<li><label for='dme'><input type='checkbox' id='dme' name='txtDatabases' onclick='updateChooseDatabases();' value='dme' />Dynamed<span style='color:#999999'>(dme)</span></label></li>
										<li><label for='dnh'><input type='checkbox' id='dnh' name='txtDatabases' onclick='updateChooseDatabases();' value='dnh' />DynaMed<span style='color:#999999'>(dnh)</span></label></li>
										<li><label for='dxh'><input type='checkbox' id='dxh' name='txtDatabases' onclick='updateChooseDatabases();' value='dxh' />Dynamed Test<span style='color:#999999'>(dxh)</span></label></li>
										<li><label for='eoah'><input type='checkbox' id='eoah' name='txtDatabases' onclick='updateChooseDatabases();' value='eoah' />E-Journals<span style='color:#999999'>(eoah)</span></label></li>
										<li><label for='efb'><input type='checkbox' id='efb' name='txtDatabases' onclick='updateChooseDatabases();' value='efb' />E-Journals - MFS Beta<span style='color:#999999'>(efb)</span></label></li>
										<li><label for='ejb'><input type='checkbox' id='ejb' name='txtDatabases' onclick='updateChooseDatabases();' value='ejb' />E-Journals -- Remote<span style='color:#999999'>(ejb)</span></label></li>
										<li><label for='edsnl'><input type='checkbox' id='edsnl' name='txtDatabases' onclick='updateChooseDatabases();' value='edsnl' />eBook file<span style='color:#999999'>(edsnl)</span></label></li>
										<li><label for='bub'><input type='checkbox' id='bub' name='txtDatabases' onclick='updateChooseDatabases();' value='bub' />EBSCO Business Basics<span style='color:#999999'>(bub)</span></label></li>
										<li><label for='edn'><input type='checkbox' id='edn' name='txtDatabases' onclick='updateChooseDatabases();' value='edn' />EBSCO Discovery News<span style='color:#999999'>(edn)</span></label></li>
										<li><label for='edx'><input type='checkbox' id='edx' name='txtDatabases' onclick='updateChooseDatabases();' value='edx' />EBSCO Discovery Service apptest<span style='color:#999999'>(edx)</span></label></li>
										<li><label for='edf'><input type='checkbox' id='edf' name='txtDatabases' onclick='updateChooseDatabases();' value='edf' />EBSCO Discovery Service Full Text<span style='color:#999999'>(edf)</span></label></li>
										<li><label for='keh'><input type='checkbox' id='keh' name='txtDatabases' onclick='updateChooseDatabases();' value='keh' />EBSCO MegaFILE<span style='color:#999999'>(keh)</span></label></li>
										<li><label for='xxh'><input type='checkbox' id='xxh' name='txtDatabases' onclick='updateChooseDatabases();' value='xxh' />EBSCOhost Connection<span style='color:#999999'>(xxh)</span></label></li>
										<li><label for='xhh'><input type='checkbox' id='xhh' name='txtDatabases' onclick='updateChooseDatabases();' value='xhh' />EBSCOhost Connection - Two<span style='color:#999999'>(xhh)</span></label></li>
										<li><label for='e1h'><input type='checkbox' id='e1h' name='txtDatabases' onclick='updateChooseDatabases();' value='e1h' />ECA Full Text Collection<span style='color:#999999'>(e1h)</span></label></li>
										<li><label for='irtxssu'><input type='checkbox' id='irtxssu' name='txtDatabases' onclick='updateChooseDatabases();' value='irtxssu' />eCommons@TXState (Texas State Repository)<span style='color:#999999'>(irtxssu)</span></label></li>
										<li><label for='ecn'><input type='checkbox' id='ecn' name='txtDatabases' onclick='updateChooseDatabases();' value='ecn' />EconLit<span style='color:#999999'>(ecn)</span></label></li>
										<li><label for='eoh'><input type='checkbox' id='eoh' name='txtDatabases' onclick='updateChooseDatabases();' value='eoh' />EconLit with Full Text<span style='color:#999999'>(eoh)</span></label></li>
										<li><label for='agh'><input type='checkbox' id='agh' name='txtDatabases' onclick='updateChooseDatabases();' value='agh' />Economía y Negocios<span style='color:#999999'>(agh)</span></label></li>
										<li><label for='qeh'><input type='checkbox' id='qeh' name='txtDatabases' onclick='updateChooseDatabases();' value='qeh' />Education Abstracts (H.W. Wilson)<span style='color:#999999'>(qeh)</span></label></li>
										<li><label for='ehh'><input type='checkbox' id='ehh' name='txtDatabases' onclick='updateChooseDatabases();' value='ehh' />Education Research Complete<span style='color:#999999'>(ehh)</span></label></li>
										<li><label for='20h'><input type='checkbox' id='20h' name='txtDatabases' onclick='updateChooseDatabases();' value='20h' />Educational Administration Abstracts<span style='color:#999999'>(20h)</span></label></li>
										<li><label for='eba'><input type='checkbox' id='eba' name='txtDatabases' onclick='updateChooseDatabases();' value='eba' />EMBASE<span style='color:#999999'>(eba)</span></label></li>
										<li><label for='enr'><input type='checkbox' id='enr' name='txtDatabases' onclick='updateChooseDatabases();' value='enr' />Energy & Power Source<span style='color:#999999'>(enr)</span></label></li>
										<li><label for='nre'><input type='checkbox' id='nre' name='txtDatabases' onclick='updateChooseDatabases();' value='nre' />Enfermería al Día<span style='color:#999999'>(nre)</span></label></li>
										<li><label for='elr'><input type='checkbox' id='elr' name='txtDatabases' onclick='updateChooseDatabases();' value='elr' />English Language Learner Reference Center<span style='color:#999999'>(elr)</span></label></li>
										<li><label for='pen'><input type='checkbox' id='pen' name='txtDatabases' onclick='updateChooseDatabases();' value='pen' />English Patient Education<span style='color:#999999'>(pen)</span></label></li>
										<li><label for='ent'><input type='checkbox' id='ent' name='txtDatabases' onclick='updateChooseDatabases();' value='ent' />Entrepreneurial Studies Source<span style='color:#999999'>(ent)</span></label></li>
										<li><label for='eih'><input type='checkbox' id='eih' name='txtDatabases' onclick='updateChooseDatabases();' value='eih' />Environment Complete<span style='color:#999999'>(eih)</span></label></li>
										<li><label for='egh'><input type='checkbox' id='egh' name='txtDatabases' onclick='updateChooseDatabases();' value='egh' />Environment Index<span style='color:#999999'>(egh)</span></label></li>
										<li><label for='eric'><input type='checkbox' id='eric' name='txtDatabases' onclick='updateChooseDatabases();' value='eric' />ERIC<span style='color:#999999'>(eric)</span></label></li>
										<li><label for='gjh'><input type='checkbox' id='gjh' name='txtDatabases' onclick='updateChooseDatabases();' value='gjh' />Essay & General Literature Index (H.W. Wilson)<span style='color:#999999'>(gjh)</span></label></li>
										<li><label for='hev'><input type='checkbox' id='hev' name='txtDatabases' onclick='updateChooseDatabases();' value='hev' />European Views of the Americas: 1493 to 1750<span style='color:#999999'>(hev)</span></label></li>
										<li><label for='wjh'><input type='checkbox' id='wjh' name='txtDatabases' onclick='updateChooseDatabases();' value='wjh' />Evidence Based Complementary Medicine<span style='color:#999999'>(wjh)</span></label></li>
										<li><label for='l9r'><input type='checkbox' id='l9r' name='txtDatabases' onclick='updateChooseDatabases();' value='l9r' />Facilities Management Learning Center<span style='color:#999999'>(l9r)</span></label></li>
										<li><label for='flh'><input type='checkbox' id='flh' name='txtDatabases' onclick='updateChooseDatabases();' value='flh' />Family & Society Studies Worldwide<span style='color:#999999'>(flh)</span></label></li>
										<li><label for='26h'><input type='checkbox' id='26h' name='txtDatabases' onclick='updateChooseDatabases();' value='26h' />Family Studies Abstracts<span style='color:#999999'>(26h)</span></label></li>
										<li><label for='fed'><input type='checkbox' id='fed' name='txtDatabases' onclick='updateChooseDatabases();' value='fed' />Federal Research in Progress<span style='color:#999999'>(fed)</span></label></li>
										<li><label for='fah'><input type='checkbox' id='fah' name='txtDatabases' onclick='updateChooseDatabases();' value='fah' />Film & Television Literature Index<span style='color:#999999'>(fah)</span></label></li>
										<li><label for='f3h'><input type='checkbox' id='f3h' name='txtDatabases' onclick='updateChooseDatabases();' value='f3h' />Film & Television Literature Index with Full Text<span style='color:#999999'>(f3h)</span></label></li>
										<li><label for='fit'><input type='checkbox' id='fit' name='txtDatabases' onclick='updateChooseDatabases();' value='fit' />Financial Times<span style='color:#999999'>(fit)</span></label></li>
										<li><label for='ffw'><input type='checkbox' id='ffw' name='txtDatabases' onclick='updateChooseDatabases();' value='ffw' />Fish, Fisheries & Aquatic Biodiversity Worldwide<span style='color:#999999'>(ffw)</span></label></li>
										<li><label for='foh'><input type='checkbox' id='foh' name='txtDatabases' onclick='updateChooseDatabases();' value='foh' />Fonte Acadêmica<span style='color:#999999'>(foh)</span></label></li>
										<li><label for='fiw'><input type='checkbox' id='fiw' name='txtDatabases' onclick='updateChooseDatabases();' value='fiw' />Food Industry Watch<span style='color:#999999'>(fiw)</span></label></li>
										<li><label for='fsr'><input type='checkbox' id='fsr' name='txtDatabases' onclick='updateChooseDatabases();' value='fsr' />Food Science Source<span style='color:#999999'>(fsr)</span></label></li>
										<li><label for='fns'><input type='checkbox' id='fns' name='txtDatabases' onclick='updateChooseDatabases();' value='fns' />Footnote&#x2122; History and Genealogy Archives<span style='color:#999999'>(fns)</span></label></li>
										<li><label for='fdh'><input type='checkbox' id='fdh' name='txtDatabases' onclick='updateChooseDatabases();' value='fdh' />Franchise Index<span style='color:#999999'>(fdh)</span></label></li>
										<li><label for='fcs'><input type='checkbox' id='fcs' name='txtDatabases' onclick='updateChooseDatabases();' value='fcs' />FRANCIS<span style='color:#999999'>(fcs)</span></label></li>
										<li><label for='ffh'><input type='checkbox' id='ffh' name='txtDatabases' onclick='updateChooseDatabases();' value='ffh' />FSTA - Food Science and Technology Abstracts<span style='color:#999999'>(ffh)</span></label></li>
										<li><label for='zbh'><input type='checkbox' id='zbh' name='txtDatabases' onclick='updateChooseDatabases();' value='zbh' />Fuente Académica<span style='color:#999999'>(zbh)</span></label></li>
										<li><label for='fua'><input type='checkbox' id='fua' name='txtDatabases' onclick='updateChooseDatabases();' value='fua' />Fuente Académica Premier<span style='color:#999999'>(fua)</span></label></li>
										<li><label for='funk'><input type='checkbox' id='funk' name='txtDatabases' onclick='updateChooseDatabases();' value='funk' />Funk & Wagnalls New World Encyclopedia<span style='color:#999999'>(funk)</span></label></li>
										<li><label for='glw'><input type='checkbox' id='glw' name='txtDatabases' onclick='updateChooseDatabases();' value='glw' />GalleryWatch CRS Reports<span style='color:#999999'>(glw)</span></label></li>
										<li><label for='puh'><input type='checkbox' id='puh' name='txtDatabases' onclick='updateChooseDatabases();' value='puh' />Garden, Landscape & Horticulture Index<span style='color:#999999'>(puh)</span></label></li>
										<li><label for='fmh'><input type='checkbox' id='fmh' name='txtDatabases' onclick='updateChooseDatabases();' value='fmh' />Gender Studies Database<span style='color:#999999'>(fmh)</span></label></li>
										<li><label for='nrh'><input type='checkbox' id='nrh' name='txtDatabases' onclick='updateChooseDatabases();' value='nrh' />General Science Abstracts (H.W. Wilson)<span style='color:#999999'>(nrh)</span></label></li>
										<li><label for='gsh'><input type='checkbox' id='gsh' name='txtDatabases' onclick='updateChooseDatabases();' value='gsh' />General Science Collection<span style='color:#999999'>(gsh)</span></label></li>
										<li><label for='geh'><input type='checkbox' id='geh' name='txtDatabases' onclick='updateChooseDatabases();' value='geh' />GeoRef<span style='color:#999999'>(geh)</span></label></li>
										<li><label for='guh'><input type='checkbox' id='guh' name='txtDatabases' onclick='updateChooseDatabases();' value='guh' />GeoRef In Process<span style='color:#999999'>(guh)</span></label></li>
										<li><label for='lhh'><input type='checkbox' id='lhh' name='txtDatabases' onclick='updateChooseDatabases();' value='lhh' />Global Health<span style='color:#999999'>(lhh)</span></label></li>
										<li><label for='gha'><input type='checkbox' id='gha' name='txtDatabases' onclick='updateChooseDatabases();' value='gha' />Global Health Archive<span style='color:#999999'>(gha)</span></label></li>
										<li><label for='grh'><input type='checkbox' id='grh' name='txtDatabases' onclick='updateChooseDatabases();' value='grh' />GRASP<span style='color:#999999'>(grh)</span></label></li>
										<li><label for='8gh'><input type='checkbox' id='8gh' name='txtDatabases' onclick='updateChooseDatabases();' value='8gh' />GreenFILE<span style='color:#999999'>(8gh)</span></label></li>
										<li><label for='glh'><input type='checkbox' id='glh' name='txtDatabases' onclick='updateChooseDatabases();' value='glh' />Grolier - Host<span style='color:#999999'>(glh)</span></label></li>
										<li><label for='gkh'><input type='checkbox' id='gkh' name='txtDatabases' onclick='updateChooseDatabases();' value='gkh' />Grolier NBK - host<span style='color:#999999'>(gkh)</span></label></li>
										<li><label for='hpi'><input type='checkbox' id='hpi' name='txtDatabases' onclick='updateChooseDatabases();' value='hpi' />Health and Psychosocial Instruments<span style='color:#999999'>(hpi)</span></label></li>
										<li><label for='hbh'><input type='checkbox' id='hbh' name='txtDatabases' onclick='updateChooseDatabases();' value='hbh' />Health Business FullTEXT<span style='color:#999999'>(hbh)</span></label></li>
										<li><label for='heh'><input type='checkbox' id='heh' name='txtDatabases' onclick='updateChooseDatabases();' value='heh' />Health Business Fulltext Elite<span style='color:#999999'>(heh)</span></label></li>
										<li><label for='nrcn'><input type='checkbox' id='nrcn' name='txtDatabases' onclick='updateChooseDatabases();' value='nrcn' />Health News<span style='color:#999999'>(nrcn)</span></label></li>
										<li><label for='hns'><input type='checkbox' id='hns' name='txtDatabases' onclick='updateChooseDatabases();' value='hns' />Health News (Spanish)<span style='color:#999999'>(hns)</span></label></li>
										<li><label for='her'><input type='checkbox' id='her' name='txtDatabases' onclick='updateChooseDatabases();' value='her' />Health Policy Reference Center<span style='color:#999999'>(her)</span></label></li>
										<li><label for='hxh'><input type='checkbox' id='hxh' name='txtDatabases' onclick='updateChooseDatabases();' value='hxh' />Health Source - Consumer Edition<span style='color:#999999'>(hxh)</span></label></li>
										<li><label for='hch'><input type='checkbox' id='hch' name='txtDatabases' onclick='updateChooseDatabases();' value='hch' />Health Source: Nursing/Academic Edition<span style='color:#999999'>(hch)</span></label></li>
										<li><label for='hta'><input type='checkbox' id='hta' name='txtDatabases' onclick='updateChooseDatabases();' value='hta' />Health Technology Assessments<span style='color:#999999'>(hta)</span></label></li>
										<li><label for='hia'><input type='checkbox' id='hia' name='txtDatabases' onclick='updateChooseDatabases();' value='hia' />Historical Abstracts<span style='color:#999999'>(hia)</span></label></li>
										<li><label for='30h'><input type='checkbox' id='30h' name='txtDatabases' onclick='updateChooseDatabases();' value='30h' />Historical Abstracts with Full Text<span style='color:#999999'>(30h)</span></label></li>
										<li><label for='khh'><input type='checkbox' id='khh' name='txtDatabases' onclick='updateChooseDatabases();' value='khh' />History Reference Center<span style='color:#999999'>(khh)</span></label></li>
										<li><label for='cfh'><input type='checkbox' id='cfh' name='txtDatabases' onclick='updateChooseDatabases();' value='cfh' />Hobbies & Crafts Reference Center<span style='color:#999999'>(cfh)</span></label></li>
										<li><label for='fnr'><input type='checkbox' id='fnr' name='txtDatabases' onclick='updateChooseDatabases();' value='fnr' />Holocaust Archives<span style='color:#999999'>(fnr)</span></label></li>
										<li><label for='h4h'><input type='checkbox' id='h4h' name='txtDatabases' onclick='updateChooseDatabases();' value='h4h' />Home Improvement Reference Center<span style='color:#999999'>(h4h)</span></label></li>
										<li><label for='hjh'><input type='checkbox' id='hjh' name='txtDatabases' onclick='updateChooseDatabases();' value='hjh' />Hospitality & Tourism Complete<span style='color:#999999'>(hjh)</span></label></li>
										<li><label for='hoh'><input type='checkbox' id='hoh' name='txtDatabases' onclick='updateChooseDatabases();' value='hoh' />Hospitality & Tourism Index<span style='color:#999999'>(hoh)</span></label></li>
										<li><label for='22h'><input type='checkbox' id='22h' name='txtDatabases' onclick='updateChooseDatabases();' value='22h' />Human Resources Abstracts<span style='color:#999999'>(22h)</span></label></li>
										<li><label for='l0r'><input type='checkbox' id='l0r' name='txtDatabases' onclick='updateChooseDatabases();' value='l0r' />Human Resources Learning Center<span style='color:#999999'>(l0r)</span></label></li>
										<li><label for='qhs'><input type='checkbox' id='qhs' name='txtDatabases' onclick='updateChooseDatabases();' value='qhs' />Humanities Abstracts (H.W. Wilson)<span style='color:#999999'>(qhs)</span></label></li>
										<li><label for='hlh'><input type='checkbox' id='hlh' name='txtDatabases' onclick='updateChooseDatabases();' value='hlh' />Humanities International Complete<span style='color:#999999'>(hlh)</span></label></li>
										<li><label for='hgh'><input type='checkbox' id='hgh' name='txtDatabases' onclick='updateChooseDatabases();' value='hgh' />Humanities International Index<span style='color:#999999'>(hgh)</span></label></li>
										<li><label for='qxth'><input type='checkbox' id='qxth' name='txtDatabases' onclick='updateChooseDatabases();' value='qxth' />Image Quick View Parent Records<span style='color:#999999'>(qxth)</span></label></li>
										<li><label for='ich'><input type='checkbox' id='ich' name='txtDatabases' onclick='updateChooseDatabases();' value='ich' />Index Islamicus<span style='color:#999999'>(ich)</span></label></li>
										<li><label for='jph'><input type='checkbox' id='jph' name='txtDatabases' onclick='updateChooseDatabases();' value='jph' />Index to Jewish Periodicals<span style='color:#999999'>(jph)</span></label></li>
										<li><label for='ilh'><input type='checkbox' id='ilh' name='txtDatabases' onclick='updateChooseDatabases();' value='ilh' />Index to Legal Periodicals & Books (H.W. Wilson)<span style='color:#999999'>(ilh)</span></label></li>
										<li><label for='ipm'><input type='checkbox' id='ipm' name='txtDatabases' onclick='updateChooseDatabases();' value='ipm' />Index to Printed Music<span style='color:#999999'>(ipm)</span></label></li>
										<li><label for='iuir'><input type='checkbox' id='iuir' name='txtDatabases' onclick='updateChooseDatabases();' value='iuir' />Indiana University Institutional Repository Test<span style='color:#999999'>(iuir)</span></label></li>
										<li><label for='izh'><input type='checkbox' id='izh' name='txtDatabases' onclick='updateChooseDatabases();' value='izh' />Information Science & Technology Abstracts (ISTA)<span style='color:#999999'>(izh)</span></label></li>
										<li><label for='l4r'><input type='checkbox' id='l4r' name='txtDatabases' onclick='updateChooseDatabases();' value='l4r' />Information Technology Learning Center<span style='color:#999999'>(l4r)</span></label></li>
										<li><label for='inh'><input type='checkbox' id='inh' name='txtDatabases' onclick='updateChooseDatabases();' value='inh' />Inspec<span style='color:#999999'>(inh)</span></label></li>
										<li><label for='ieh'><input type='checkbox' id='ieh' name='txtDatabases' onclick='updateChooseDatabases();' value='ieh' />Inspec Archive - Science Abstracts 1898-1968<span style='color:#999999'>(ieh)</span></label></li>
										<li><label for='inha'><input type='checkbox' id='inha' name='txtDatabases' onclick='updateChooseDatabases();' value='inha' />Inspec Clone<span style='color:#999999'>(inha)</span></label></li>
										<li><label for='iph'><input type='checkbox' id='iph' name='txtDatabases' onclick='updateChooseDatabases();' value='iph' />Insurance Periodicals Index<span style='color:#999999'>(iph)</span></label></li>
										<li><label for='i4h'><input type='checkbox' id='i4h' name='txtDatabases' onclick='updateChooseDatabases();' value='i4h' />Internal AHL References<span style='color:#999999'>(i4h)</span></label></li>
										<li><label for='s4h'><input type='checkbox' id='s4h' name='txtDatabases' onclick='updateChooseDatabases();' value='s4h' />Internal FT -  SportDiscus<span style='color:#999999'>(s4h)</span></label></li>
										<li><label for='rnh'><input type='checkbox' id='rnh' name='txtDatabases' onclick='updateChooseDatabases();' value='rnh' />Internal FT - CINAHL<span style='color:#999999'>(rnh)</span></label></li>
										<li><label for='ioh'><input type='checkbox' id='ioh' name='txtDatabases' onclick='updateChooseDatabases();' value='ioh' />International Bibliography of the Social Sciences<span style='color:#999999'>(ioh)</span></label></li>
										<li><label for='ibh'><input type='checkbox' id='ibh' name='txtDatabases' onclick='updateChooseDatabases();' value='ibh' />International Bibliography of Theatre & Dance with Full Text<span style='color:#999999'>(ibh)</span></label></li>
										<li><label for='ipa'><input type='checkbox' id='ipa' name='txtDatabases' onclick='updateChooseDatabases();' value='ipa' />International Pharmaceutical Abstracts<span style='color:#999999'>(ipa)</span></label></li>
										<li><label for='ijh'><input type='checkbox' id='ijh' name='txtDatabases' onclick='updateChooseDatabases();' value='ijh' />International Political Science Abstracts<span style='color:#999999'>(ijh)</span></label></li>
										<li><label for='tsh'><input type='checkbox' id='tsh' name='txtDatabases' onclick='updateChooseDatabases();' value='tsh' />International Security & Counter Terrorism Reference Center<span style='color:#999999'>(tsh)</span></label></li>
										<li><label for='iqh'><input type='checkbox' id='iqh' name='txtDatabases' onclick='updateChooseDatabases();' value='iqh' />Internet and Personal Computing Abstracts<span style='color:#999999'>(iqh)</span></label></li>
										<li><label for='cat00008b'><input type='checkbox' id='cat00008b' name='txtDatabases' onclick='updateChooseDatabases();' value='cat00008b' />Korea University Library - KORMARC<span style='color:#999999'>(cat00008b)</span></label></li>
										<li><label for='l2r'><input type='checkbox' id='l2r' name='txtDatabases' onclick='updateChooseDatabases();' value='l2r' />Leadership & Management Learning Center<span style='color:#999999'>(l2r)</span></label></li>
										<li><label for='fqh'><input type='checkbox' id='fqh' name='txtDatabases' onclick='updateChooseDatabases();' value='fqh' />Left Index<span style='color:#999999'>(fqh)</span></label></li>
										<li><label for='lgh'><input type='checkbox' id='lgh' name='txtDatabases' onclick='updateChooseDatabases();' value='lgh' />Legal Collection<span style='color:#999999'>(lgh)</span></label></li>
										<li><label for='l0h'><input type='checkbox' id='l0h' name='txtDatabases' onclick='updateChooseDatabases();' value='l0h' />Lexi-PALS Drug Guide<span style='color:#999999'>(l0h)</span></label></li>
										<li><label for='edslns'><input type='checkbox' id='edslns' name='txtDatabases' onclick='updateChooseDatabases();' value='edslns' />LexisNexis U.S. Serial Set Digital Collection<span style='color:#999999'>(edslns)</span></label></li>
										<li><label for='qrh'><input type='checkbox' id='qrh' name='txtDatabases' onclick='updateChooseDatabases();' value='qrh' />LGBT Life<span style='color:#999999'>(qrh)</span></label></li>
										<li><label for='qth'><input type='checkbox' id='qth' name='txtDatabases' onclick='updateChooseDatabases();' value='qth' />LGBT Life with Full Text<span style='color:#999999'>(qth)</span></label></li>
										<li><label for='ljh'><input type='checkbox' id='ljh' name='txtDatabases' onclick='updateChooseDatabases();' value='ljh' />Library Journal Collection<span style='color:#999999'>(ljh)</span></label></li>
										<li><label for='llh'><input type='checkbox' id='llh' name='txtDatabases' onclick='updateChooseDatabases();' value='llh' />Library Literature & Information Science (H.W. Wilson)<span style='color:#999999'>(llh)</span></label></li>
										<li><label for='lrh'><input type='checkbox' id='lrh' name='txtDatabases' onclick='updateChooseDatabases();' value='lrh' />Library Reference Center<span style='color:#999999'>(lrh)</span></label></li>
										<li><label for='lxh'><input type='checkbox' id='lxh' name='txtDatabases' onclick='updateChooseDatabases();' value='lxh' />Library, Information Science & Technology Abstracts<span style='color:#999999'>(lxh)</span></label></li>
										<li><label for='lih'><input type='checkbox' id='lih' name='txtDatabases' onclick='updateChooseDatabases();' value='lih' />Library, Information Science & Technology Abstracts with Full Text<span style='color:#999999'>(lih)</span></label></li>
										<li><label for='vlh'><input type='checkbox' id='vlh' name='txtDatabases' onclick='updateChooseDatabases();' value='vlh' />Libros en Venta en América Latina y España<span style='color:#999999'>(vlh)</span></label></li>
										<li><label for='lfh'><input type='checkbox' id='lfh' name='txtDatabases' onclick='updateChooseDatabases();' value='lfh' />Literary Reference Center<span style='color:#999999'>(lfh)</span></label></li>
										<li><label for='lrm'><input type='checkbox' id='lrm' name='txtDatabases' onclick='updateChooseDatabases();' value='lrm' />Literary Reference Center Main Edition<span style='color:#999999'>(lrm)</span></label></li>
										<li><label for='lkh'><input type='checkbox' id='lkh' name='txtDatabases' onclick='updateChooseDatabases();' value='lkh' />Literary Reference Center Plus<span style='color:#999999'>(lkh)</span></label></li>
										<li><label for='mxh'><input type='checkbox' id='mxh' name='txtDatabases' onclick='updateChooseDatabases();' value='mxh' />Magazine Express<span style='color:#999999'>(mxh)</span></label></li>
										<li><label for='gih'><input type='checkbox' id='gih' name='txtDatabases' onclick='updateChooseDatabases();' value='gih' />MagillOnAuthors<span style='color:#999999'>(gih)</span></label></li>
										<li><label for='mjh'><input type='checkbox' id='mjh' name='txtDatabases' onclick='updateChooseDatabases();' value='mjh' />MagillOnLiterature Plus<span style='color:#999999'>(mjh)</span></label></li>
										<li><label for='mfi'><input type='checkbox' id='mfi' name='txtDatabases' onclick='updateChooseDatabases();' value='mfi' />MainFile<span style='color:#999999'>(mfi)</span></label></li>
										<li><label for='kch'><input type='checkbox' id='kch' name='txtDatabases' onclick='updateChooseDatabases();' value='kch' />Marshall Cavendish Multicultural Reference Center<span style='color:#999999'>(kch)</span></label></li>
										<li><label for='ksh'><input type='checkbox' id='ksh' name='txtDatabases' onclick='updateChooseDatabases();' value='ksh' />Marshall Cavendish Science Reference Center<span style='color:#999999'>(ksh)</span></label></li>
										<li><label for='kxh'><input type='checkbox' id='kxh' name='txtDatabases' onclick='updateChooseDatabases();' value='kxh' />Marshall Cavendish Wildlife Reference Center<span style='color:#999999'>(kxh)</span></label></li>
										<li><label for='mat'><input type='checkbox' id='mat' name='txtDatabases' onclick='updateChooseDatabases();' value='mat' />MAS Complete<span style='color:#999999'>(mat)</span></label></li>
										<li><label for='mae'><input type='checkbox' id='mae' name='txtDatabases' onclick='updateChooseDatabases();' value='mae' />MAS High Search Main Edition<span style='color:#999999'>(mae)</span></label></li>
										<li><label for='mqh'><input type='checkbox' id='mqh' name='txtDatabases' onclick='updateChooseDatabases();' value='mqh' />MAS Online<span style='color:#999999'>(mqh)</span></label></li>
										<li><label for='mkh'><input type='checkbox' id='mkh' name='txtDatabases' onclick='updateChooseDatabases();' value='mkh' />MAS Online Plus<span style='color:#999999'>(mkh)</span></label></li>
										<li><label for='ulh'><input type='checkbox' id='ulh' name='txtDatabases' onclick='updateChooseDatabases();' value='ulh' />MAS Ultra - School Edition<span style='color:#999999'>(ulh)</span></label></li>
										<li><label for='muh'><input type='checkbox' id='muh' name='txtDatabases' onclick='updateChooseDatabases();' value='muh' />MAS Ultra--Public Library Edition<span style='color:#999999'>(muh)</span></label></li>
										<li><label for='f6h'><input type='checkbox' id='f6h' name='txtDatabases' onclick='updateChooseDatabases();' value='f6h' />MasterFILE Complete<span style='color:#999999'>(f6h)</span></label></li>
										<li><label for='fth'><input type='checkbox' id='fth' name='txtDatabases' onclick='updateChooseDatabases();' value='fth' />MasterFILE Elite<span style='color:#999999'>(fth)</span></label></li>
										<li><label for='mfm'><input type='checkbox' id='mfm' name='txtDatabases' onclick='updateChooseDatabases();' value='mfm' />MasterFILE Main Edition<span style='color:#999999'>(mfm)</span></label></li>
										<li><label for='f5h'><input type='checkbox' id='f5h' name='txtDatabases' onclick='updateChooseDatabases();' value='f5h' />MasterFILE Premier<span style='color:#999999'>(f5h)</span></label></li>
										<li><label for='mfh'><input type='checkbox' id='mfh' name='txtDatabases' onclick='updateChooseDatabases();' value='mfh' />MasterFILE Select<span style='color:#999999'>(mfh)</span></label></li>
										<li><label for='krh'><input type='checkbox' id='krh' name='txtDatabases' onclick='updateChooseDatabases();' value='krh' />McClatchy-Tribune Collection<span style='color:#999999'>(krh)</span></label></li>
										<li><label for='lth'><input type='checkbox' id='lth' name='txtDatabases' onclick='updateChooseDatabases();' value='lth' />MedicLatina<span style='color:#999999'>(lth)</span></label></li>
										<li><label for='lthml'><input type='checkbox' id='lthml' name='txtDatabases' onclick='updateChooseDatabases();' value='lthml' />MedicLatina ML<span style='color:#999999'>(lthml)</span></label></li>
										<li><label for='lthstd'><input type='checkbox' id='lthstd' name='txtDatabases' onclick='updateChooseDatabases();' value='lthstd' />MedicLatina Standard<span style='color:#999999'>(lthstd)</span></label></li>
										<li><label for='cmedm'><input type='checkbox' id='cmedm' name='txtDatabases' onclick='updateChooseDatabases();' value='cmedm' />MEDLINE<span style='color:#999999'>(cmedm)</span></label></li>
										<li><label for='owh'><input type='checkbox' id='owh' name='txtDatabases' onclick='updateChooseDatabases();' value='owh' />Medline Linking Database<span style='color:#999999'>(owh)</span></label></li>
										<li><label for='oyh'><input type='checkbox' id='oyh' name='txtDatabases' onclick='updateChooseDatabases();' value='oyh' />Medline Select<span style='color:#999999'>(oyh)</span></label></li>
										<li><label for='mnh'><input type='checkbox' id='mnh' name='txtDatabases' onclick='updateChooseDatabases();' value='mnh' />MEDLINE with Full Text<span style='color:#999999'>(mnh)</span></label></li>
										<li><label for='loh'><input type='checkbox' id='loh' name='txtDatabases' onclick='updateChooseDatabases();' value='loh' />Mental Measurements Yearbook<span style='color:#999999'>(loh)</span></label></li>
										<li><label for='fxh'><input type='checkbox' id='fxh' name='txtDatabases' onclick='updateChooseDatabases();' value='fxh' />Middle Eastern & Central Asian Studies<span style='color:#999999'>(fxh)</span></label></li>
										<li><label for='mme'><input type='checkbox' id='mme' name='txtDatabases' onclick='updateChooseDatabases();' value='mme' />Middle Search Main Edition<span style='color:#999999'>(mme)</span></label></li>
										<li><label for='mih'><input type='checkbox' id='mih' name='txtDatabases' onclick='updateChooseDatabases();' value='mih' />Middle Search Plus<span style='color:#999999'>(mih)</span></label></li>
										<li><label for='mth'><input type='checkbox' id='mth' name='txtDatabases' onclick='updateChooseDatabases();' value='mth' />Military & Government Collection<span style='color:#999999'>(mth)</span></label></li>
										<li><label for='kah'><input type='checkbox' id='kah' name='txtDatabases' onclick='updateChooseDatabases();' value='kah' />MLA Directory of Periodicals<span style='color:#999999'>(kah)</span></label></li>
										<li><label for='mzh'><input type='checkbox' id='mzh' name='txtDatabases' onclick='updateChooseDatabases();' value='mzh' />MLA International Bibliography<span style='color:#999999'>(mzh)</span></label></li>
										<li><label for='mcg'><input type='checkbox' id='mcg' name='txtDatabases' onclick='updateChooseDatabases();' value='mcg' />Music Catalog - - Library of Congress<span style='color:#999999'>(mcg)</span></label></li>
										<li><label for='mah'><input type='checkbox' id='mah' name='txtDatabases' onclick='updateChooseDatabases();' value='mah' />Music Index<span style='color:#999999'>(mah)</span></label></li>
										<li><label for='ncj'><input type='checkbox' id='ncj' name='txtDatabases' onclick='updateChooseDatabases();' value='ncj' />National Criminal Justice Reference Service  Abstracts<span style='color:#999999'>(ncj)</span></label></li>
										<li><label for='fnw'><input type='checkbox' id='fnw' name='txtDatabases' onclick='updateChooseDatabases();' value='fnw' />Native American Archives<span style='color:#999999'>(fnw)</span></label></li>
										<li><label for='wfh'><input type='checkbox' id='wfh' name='txtDatabases' onclick='updateChooseDatabases();' value='wfh' />Natural & Alternative Treatments<span style='color:#999999'>(wfh)</span></label></li>
										<li><label for='ueh'><input type='checkbox' id='ueh' name='txtDatabases' onclick='updateChooseDatabases();' value='ueh' />NCA Collection<span style='color:#999999'>(ueh)</span></label></li>
										<li><label for='iruncg'><input type='checkbox' id='iruncg' name='txtDatabases' onclick='updateChooseDatabases();' value='iruncg' />NCDOCKS -- North Carolina Digital Online Collection of Knowledge and Scholarship<span style='color:#999999'>(iruncg)</span></label></li>
										<li><label for='n2h'><input type='checkbox' id='n2h' name='txtDatabases' onclick='updateChooseDatabases();' value='n2h' />New Scientist Archive<span style='color:#999999'>(n2h)</span></label></li>
										<li><label for='rvh'><input type='checkbox' id='rvh' name='txtDatabases' onclick='updateChooseDatabases();' value='rvh' />New Testament Abstracts<span style='color:#999999'>(rvh)</span></label></li>
										<li><label for='edsnbk'><input type='checkbox' id='edsnbk' name='txtDatabases' onclick='updateChooseDatabases();' value='edsnbk' />NewsBank<span style='color:#999999'>(edsnbk)</span></label></li>
										<li><label for='nbk'><input type='checkbox' id='nbk' name='txtDatabases' onclick='updateChooseDatabases();' value='nbk' />Newsbank<span style='color:#999999'>(nbk)</span></label></li>
										<li><label for='nbx'><input type='checkbox' id='nbx' name='txtDatabases' onclick='updateChooseDatabases();' value='nbx' />NewsBank Newspaper Archive<span style='color:#999999'>(nbx)</span></label></li>
										<li><label for='nfh'><input type='checkbox' id='nfh' name='txtDatabases' onclick='updateChooseDatabases();' value='nfh' />Newspaper Source<span style='color:#999999'>(nfh)</span></label></li>
										<li><label for='n5h'><input type='checkbox' id='n5h' name='txtDatabases' onclick='updateChooseDatabases();' value='n5h' />Newspaper Source Plus<span style='color:#999999'>(n5h)</span></label></li>
										<li><label for='nss'><input type='checkbox' id='nss' name='txtDatabases' onclick='updateChooseDatabases();' value='nss' />Newspaper Source Select<span style='color:#999999'>(nss)</span></label></li>
										<li><label for='eed'><input type='checkbox' id='eed' name='txtDatabases' onclick='updateChooseDatabases();' value='eed' />NHS Economic Evaluation Database<span style='color:#999999'>(eed)</span></label></li>
										<li><label for='nor'><input type='checkbox' id='nor' name='txtDatabases' onclick='updateChooseDatabases();' value='nor' />Nonprofit Organization Reference Center<span style='color:#999999'>(nor)</span></label></li>
										<li><label for='nts'><input type='checkbox' id='nts' name='txtDatabases' onclick='updateChooseDatabases();' value='nts' />NTIS<span style='color:#999999'>(nts)</span></label></li>
										<li><label for='nyh'><input type='checkbox' id='nyh' name='txtDatabases' onclick='updateChooseDatabases();' value='nyh' />Nursing & Allied Health Collection: Comprehensive<span style='color:#999999'>(nyh)</span></label></li>
										<li><label for='nhh'><input type='checkbox' id='nhh' name='txtDatabases' onclick='updateChooseDatabases();' value='nhh' />Nursing and Allied Health Collection: Basic<span style='color:#999999'>(nhh)</span></label></li>
										<li><label for='nxh'><input type='checkbox' id='nxh' name='txtDatabases' onclick='updateChooseDatabases();' value='nxh' />Nursing and Allied Health Collection: Expanded<span style='color:#999999'>(nxh)</span></label></li>
										<li><label for='nrc'><input type='checkbox' id='nrc' name='txtDatabases' onclick='updateChooseDatabases();' value='nrc' />Nursing Reference Center<span style='color:#999999'>(nrc)</span></label></li>
										<li><label for='oah'><input type='checkbox' id='oah' name='txtDatabases' onclick='updateChooseDatabases();' value='oah' />Old Testament Abstracts<span style='color:#999999'>(oah)</span></label></li>
										<li><label for='pcl'><input type='checkbox' id='pcl' name='txtDatabases' onclick='updateChooseDatabases();' value='pcl' />PASCAL<span style='color:#999999'>(pcl)</span></label></li>
										<li><label for='tpd'><input type='checkbox' id='tpd' name='txtDatabases' onclick='updateChooseDatabases();' value='tpd' />PCMS-DME<span style='color:#999999'>(tpd)</span></label></li>
										<li><label for='24h'><input type='checkbox' id='24h' name='txtDatabases' onclick='updateChooseDatabases();' value='24h' />Peace Research Abstracts<span style='color:#999999'>(24h)</span></label></li>
										<li><label for='pph'><input type='checkbox' id='pph' name='txtDatabases' onclick='updateChooseDatabases();' value='pph' />PEP Archive<span style='color:#999999'>(pph)</span></label></li>
										<li><label for='pta'><input type='checkbox' id='pta' name='txtDatabases' onclick='updateChooseDatabases();' value='pta' />Petroleum Abstracts TULSA® Database<span style='color:#999999'>(pta)</span></label></li>
										<li><label for='phl'><input type='checkbox' id='phl' name='txtDatabases' onclick='updateChooseDatabases();' value='phl' />Philosopher's Index<span style='color:#999999'>(phl)</span></label></li>
										<li><label for='pwh'><input type='checkbox' id='pwh' name='txtDatabases' onclick='updateChooseDatabases();' value='pwh' />Points of View Reference Center<span style='color:#999999'>(pwh)</span></label></li>
										<li><label for='poh'><input type='checkbox' id='poh' name='txtDatabases' onclick='updateChooseDatabases();' value='poh' />Political Science Complete<span style='color:#999999'>(poh)</span></label></li>
										<li><label for='ply'><input type='checkbox' id='ply' name='txtDatabases' onclick='updateChooseDatabases();' value='ply' />Polymer Library<span style='color:#999999'>(ply)</span></label></li>
										<li><label for='dzh'><input type='checkbox' id='dzh' name='txtDatabases' onclick='updateChooseDatabases();' value='dzh' />Pre-Release Publications<span style='color:#999999'>(dzh)</span></label></li>
										<li><label for='prh'><input type='checkbox' id='prh' name='txtDatabases' onclick='updateChooseDatabases();' value='prh' />Primary Search<span style='color:#999999'>(prh)</span></label></li>
										<li><label for='pme'><input type='checkbox' id='pme' name='txtDatabases' onclick='updateChooseDatabases();' value='pme' />Primary Search Main Edition<span style='color:#999999'>(pme)</span></label></li>
										<li><label for='l8r'><input type='checkbox' id='l8r' name='txtDatabases' onclick='updateChooseDatabases();' value='l8r' />Product Management Learning Center<span style='color:#999999'>(l8r)</span></label></li>
										<li><label for='pacat'><input type='checkbox' id='pacat' name='txtDatabases' onclick='updateChooseDatabases();' value='pacat' />Production Automation Test Catalogs<span style='color:#999999'>(pacat)</span></label></li>
										<li><label for='tfh'><input type='checkbox' id='tfh' name='txtDatabases' onclick='updateChooseDatabases();' value='tfh' />Professional Development Collection<span style='color:#999999'>(tfh)</span></label></li>
										<li><label for='pde'><input type='checkbox' id='pde' name='txtDatabases' onclick='updateChooseDatabases();' value='pde' />Professional Development Collection Main Edition<span style='color:#999999'>(pde)</span></label></li>
										<li><label for='l7r'><input type='checkbox' id='l7r' name='txtDatabases' onclick='updateChooseDatabases();' value='l7r' />Project Management Learning Center<span style='color:#999999'>(l7r)</span></label></li>
										<li><label for='pdh'><input type='checkbox' id='pdh' name='txtDatabases' onclick='updateChooseDatabases();' value='pdh' />PsycARTICLES<span style='color:#999999'>(pdh)</span></label></li>
										<li><label for='pzh'><input type='checkbox' id='pzh' name='txtDatabases' onclick='updateChooseDatabases();' value='pzh' />PsycBOOKS<span style='color:#999999'>(pzh)</span></label></li>
										<li><label for='pvh'><input type='checkbox' id='pvh' name='txtDatabases' onclick='updateChooseDatabases();' value='pvh' />PsycCRITIQUES<span style='color:#999999'>(pvh)</span></label></li>
										<li><label for='pxh'><input type='checkbox' id='pxh' name='txtDatabases' onclick='updateChooseDatabases();' value='pxh' />PsycEXTRA<span style='color:#999999'>(pxh)</span></label></li>
										<li><label for='pbh'><input type='checkbox' id='pbh' name='txtDatabases' onclick='updateChooseDatabases();' value='pbh' />Psychology and Behavioral Sciences Collection<span style='color:#999999'>(pbh)</span></label></li>
										<li><label for='psyh'><input type='checkbox' id='psyh' name='txtDatabases' onclick='updateChooseDatabases();' value='psyh' />PsycINFO<span style='color:#999999'>(psyh)</span></label></li>
										<li><label for='pdx'><input type='checkbox' id='pdx' name='txtDatabases' onclick='updateChooseDatabases();' value='pdx' />PSYNDEX: Literature and Audiovisual Media with PSYNDEX Tests<span style='color:#999999'>(pdx)</span></label></li>
										<li><label for='21h'><input type='checkbox' id='21h' name='txtDatabases' onclick='updateChooseDatabases();' value='21h' />Public Administration  Abstracts<span style='color:#999999'>(21h)</span></label></li>
										<li><label for='p4h'><input type='checkbox' id='p4h' name='txtDatabases' onclick='updateChooseDatabases();' value='p4h' />Public Affairs Index<span style='color:#999999'>(p4h)</span></label></li>
										<li><label for='pub'><input type='checkbox' id='pub' name='txtDatabases' onclick='updateChooseDatabases();' value='pub' />Publishing Opportunities Database<span style='color:#999999'>(pub)</span></label></li>
										<li><label for='25h'><input type='checkbox' id='25h' name='txtDatabases' onclick='updateChooseDatabases();' value='25h' />Race Relations Abstracts<span style='color:#999999'>(25h)</span></label></li>
										<li><label for='rth'><input type='checkbox' id='rth' name='txtDatabases' onclick='updateChooseDatabases();' value='rth' />RCA Collection<span style='color:#999999'>(rth)</span></label></li>
										<li><label for='rxh'><input type='checkbox' id='rxh' name='txtDatabases' onclick='updateChooseDatabases();' value='rxh' />Readers Guide Abstracts (H.W. Wilson)<span style='color:#999999'>(rxh)</span></label></li>
										<li><label for='zah'><input type='checkbox' id='zah' name='txtDatabases' onclick='updateChooseDatabases();' value='zah' />Referencia Latina<span style='color:#999999'>(zah)</span></label></li>
										<li><label for='bwh'><input type='checkbox' id='bwh' name='txtDatabases' onclick='updateChooseDatabases();' value='bwh' />Regional Business News<span style='color:#999999'>(bwh)</span></label></li>
										<li><label for='rss'><input type='checkbox' id='rss' name='txtDatabases' onclick='updateChooseDatabases();' value='rss' />Rehabilitation & Sports Medicine Source<span style='color:#999999'>(rss)</span></label></li>
										<li><label for='rlh'><input type='checkbox' id='rlh' name='txtDatabases' onclick='updateChooseDatabases();' value='rlh' />Religion and Philosophy Collection<span style='color:#999999'>(rlh)</span></label></li>
										<li><label for='e6h'><input type='checkbox' id='e6h' name='txtDatabases' onclick='updateChooseDatabases();' value='e6h' />Research Starters - Business<span style='color:#999999'>(e6h)</span></label></li>
										<li><label for='e0h'><input type='checkbox' id='e0h' name='txtDatabases' onclick='updateChooseDatabases();' value='e0h' />Research Starters - Education<span style='color:#999999'>(e0h)</span></label></li>
										<li><label for='rst'><input type='checkbox' id='rst' name='txtDatabases' onclick='updateChooseDatabases();' value='rst' />Research Starters - Sociology<span style='color:#999999'>(rst)</span></label></li>
										<li><label for='rih'><input type='checkbox' id='rih' name='txtDatabases' onclick='updateChooseDatabases();' value='rih' />RILM  Abstracts of Music Literature<span style='color:#999999'>(rih)</span></label></li>
										<li><label for='rph'><input type='checkbox' id='rph' name='txtDatabases' onclick='updateChooseDatabases();' value='rph' />RIPM - Retrospective Index to Music Periodicals<span style='color:#999999'>(rph)</span></label></li>
										<li><label for='l5r'><input type='checkbox' id='l5r' name='txtDatabases' onclick='updateChooseDatabases();' value='l5r' />Risk Management Learning Center<span style='color:#999999'>(l5r)</span></label></li>
										<li><label for='rkh'><input type='checkbox' id='rkh' name='txtDatabases' onclick='updateChooseDatabases();' value='rkh' />Risk Management Reference Center<span style='color:#999999'>(rkh)</span></label></li>
										<li><label for='rsm'><input type='checkbox' id='rsm' name='txtDatabases' onclick='updateChooseDatabases();' value='rsm' />RISM Series A/II: Music Manuscripts after 1600<span style='color:#999999'>(rsm)</span></label></li>
										<li><label for='l1r'><input type='checkbox' id='l1r' name='txtDatabases' onclick='updateChooseDatabases();' value='l1r' />Sales & Marketing Learning Center<span style='color:#999999'>(l1r)</span></label></li>
										<li><label for='h3h'><input type='checkbox' id='h3h' name='txtDatabases' onclick='updateChooseDatabases();' value='h3h' />Salud en Espanol<span style='color:#999999'>(h3h)</span></label></li>
										<li><label for='ish'><input type='checkbox' id='ish' name='txtDatabases' onclick='updateChooseDatabases();' value='ish' />Salud para todos<span style='color:#999999'>(ish)</span></label></li>
										<li><label for='syh'><input type='checkbox' id='syh' name='txtDatabases' onclick='updateChooseDatabases();' value='syh' />Science & Technology Collection<span style='color:#999999'>(syh)</span></label></li>
										<li><label for='sch'><input type='checkbox' id='sch' name='txtDatabases' onclick='updateChooseDatabases();' value='sch' />Science Reference Center<span style='color:#999999'>(sch)</span></label></li>
										<li><label for='sme'><input type='checkbox' id='sme' name='txtDatabases' onclick='updateChooseDatabases();' value='sme' />Science Reference Center Main Edition<span style='color:#999999'>(sme)</span></label></li>
										<li><label for='qs8h'><input type='checkbox' id='qs8h' name='txtDatabases' onclick='updateChooseDatabases();' value='qs8h' />SFB Academic Source Complete<span style='color:#999999'>(qs8h)</span></label></li>
										<li><label for='qecn'><input type='checkbox' id='qecn' name='txtDatabases' onclick='updateChooseDatabases();' value='qecn' />SFB EconLit<span style='color:#999999'>(qecn)</span></label></li>
										<li><label for='qeoh'><input type='checkbox' id='qeoh' name='txtDatabases' onclick='updateChooseDatabases();' value='qeoh' />SFB EconLit with Full Text<span style='color:#999999'>(qeoh)</span></label></li>
										<li><label for='29h'><input type='checkbox' id='29h' name='txtDatabases' onclick='updateChooseDatabases();' value='29h' />Shock & Vibration Digest<span style='color:#999999'>(29h)</span></label></li>
										<li><label for='shh'><input type='checkbox' id='shh' name='txtDatabases' onclick='updateChooseDatabases();' value='shh' />Short Story Index (H.W. Wilson)<span style='color:#999999'>(shh)</span></label></li>
										<li><label for='qsh'><input type='checkbox' id='qsh' name='txtDatabases' onclick='updateChooseDatabases();' value='qsh' />Social Sciences Abstracts (H.W. Wilson)<span style='color:#999999'>(qsh)</span></label></li>
										<li><label for='swh'><input type='checkbox' id='swh' name='txtDatabases' onclick='updateChooseDatabases();' value='swh' />Social Work Abstracts<span style='color:#999999'>(swh)</span></label></li>
										<li><label for='smf'><input type='checkbox' id='smf' name='txtDatabases' onclick='updateChooseDatabases();' value='smf' />Society for Military History Full Text Collection<span style='color:#999999'>(smf)</span></label></li>
										<li><label for='snh'><input type='checkbox' id='snh' name='txtDatabases' onclick='updateChooseDatabases();' value='snh' />SocINDEX<span style='color:#999999'>(snh)</span></label></li>
										<li><label for='sih'><input type='checkbox' id='sih' name='txtDatabases' onclick='updateChooseDatabases();' value='sih' />SocINDEX with Full Text<span style='color:#999999'>(sih)</span></label></li>
										<li><label for='slh'><input type='checkbox' id='slh' name='txtDatabases' onclick='updateChooseDatabases();' value='slh' />Sociological Collection<span style='color:#999999'>(slh)</span></label></li>
										<li><label for='pes'><input type='checkbox' id='pes' name='txtDatabases' onclick='updateChooseDatabases();' value='pes' />Spanish Patient Education<span style='color:#999999'>(pes)</span></label></li>
										<li><label for='spin'><input type='checkbox' id='spin' name='txtDatabases' onclick='updateChooseDatabases();' value='spin' />SPIN<span style='color:#999999'>(spin)</span></label></li>
										<li><label for='sph'><input type='checkbox' id='sph' name='txtDatabases' onclick='updateChooseDatabases();' value='sph' />SPORTDiscus<span style='color:#999999'>(sph)</span></label></li>
										<li><label for='s3h'><input type='checkbox' id='s3h' name='txtDatabases' onclick='updateChooseDatabases();' value='s3h' />SPORTDiscus with Full Text<span style='color:#999999'>(s3h)</span></label></li>
										<li><label for='tmh'><input type='checkbox' id='tmh' name='txtDatabases' onclick='updateChooseDatabases();' value='tmh' />STM Abstracts<span style='color:#999999'>(tmh)</span></label></li>
										<li><label for='sad'><input type='checkbox' id='sad' name='txtDatabases' onclick='updateChooseDatabases();' value='sad' />Super Aggregated Database<span style='color:#999999'>(sad)</span></label></li>
										<li><label for='l6r'><input type='checkbox' id='l6r' name='txtDatabases' onclick='updateChooseDatabases();' value='l6r' />Supply Chain Management Learning Center<span style='color:#999999'>(l6r)</span></label></li>
										<li><label for='sur'><input type='checkbox' id='sur' name='txtDatabases' onclick='updateChooseDatabases();' value='sur' />Sustainability Reference Center<span style='color:#999999'>(sur)</span></label></li>
										<li><label for='trh'><input type='checkbox' id='trh' name='txtDatabases' onclick='updateChooseDatabases();' value='trh' />Teacher Reference Center<span style='color:#999999'>(trh)</span></label></li>
										<li><label for='fbh'><input type='checkbox' id='fbh' name='txtDatabases' onclick='updateChooseDatabases();' value='fbh' />Test Updateable Index<span style='color:#999999'>(fbh)</span></label></li>
										<li><label for='lph'><input type='checkbox' id='lph' name='txtDatabases' onclick='updateChooseDatabases();' value='lph' />Tests in Print<span style='color:#999999'>(lph)</span></label></li>
										<li><label for='tih'><input type='checkbox' id='tih' name='txtDatabases' onclick='updateChooseDatabases();' value='tih' />Texas Reference Center<span style='color:#999999'>(tih)</span></label></li>
										<li><label for='teh'><input type='checkbox' id='teh' name='txtDatabases' onclick='updateChooseDatabases();' value='teh' />Textile Technology Complete<span style='color:#999999'>(teh)</span></label></li>
										<li><label for='tdh'><input type='checkbox' id='tdh' name='txtDatabases' onclick='updateChooseDatabases();' value='tdh' />Textile Technology Index<span style='color:#999999'>(tdh)</span></label></li>
										<li><label for='nih'><input type='checkbox' id='nih' name='txtDatabases' onclick='updateChooseDatabases();' value='nih' />The Nation Archive<span style='color:#999999'>(nih)</span></label></li>
										<li><label for='n0h'><input type='checkbox' id='n0h' name='txtDatabases' onclick='updateChooseDatabases();' value='n0h' />The Nation Archive Premium Edition<span style='color:#999999'>(n0h)</span></label></li>
										<li><label for='nch'><input type='checkbox' id='nch' name='txtDatabases' onclick='updateChooseDatabases();' value='nch' />The National Review Archive<span style='color:#999999'>(nch)</span></label></li>
										<li><label for='fjh'><input type='checkbox' id='fjh' name='txtDatabases' onclick='updateChooseDatabases();' value='fjh' />The New Republic Archive<span style='color:#999999'>(fjh)</span></label></li>
										<li><label for='ser'><input type='checkbox' id='ser' name='txtDatabases' onclick='updateChooseDatabases();' value='ser' />The Serials Directory<span style='color:#999999'>(ser)</span></label></li>
										<li><label for='eda'><input type='checkbox' id='eda' name='txtDatabases' onclick='updateChooseDatabases();' value='eda' />TOC Plus<span style='color:#999999'>(eda)</span></label></li>
										<li><label for='tnh'><input type='checkbox' id='tnh' name='txtDatabases' onclick='updateChooseDatabases();' value='tnh' />TOC Premier<span style='color:#999999'>(tnh)</span></label></li>
										<li><label for='c1h'><input type='checkbox' id='c1h' name='txtDatabases' onclick='updateChooseDatabases();' value='c1h' />TOC Premier (old)<span style='color:#999999'>(c1h)</span></label></li>
										<li><label for='tth'><input type='checkbox' id='tth' name='txtDatabases' onclick='updateChooseDatabases();' value='tth' />TOPICsearch<span style='color:#999999'>(tth)</span></label></li>
										<li><label for='fnx'><input type='checkbox' id='fnx' name='txtDatabases' onclick='updateChooseDatabases();' value='fnx' />U.S. Bureau of Investigation Case Files Archives<span style='color:#999999'>(fnx)</span></label></li>
										<li><label for='ukh'><input type='checkbox' id='ukh' name='txtDatabases' onclick='updateChooseDatabases();' value='ukh' />UK/EIRE Reference Centre<span style='color:#999999'>(ukh)</span></label></li>
										<li><label for='uvt'><input type='checkbox' id='uvt' name='txtDatabases' onclick='updateChooseDatabases();' value='uvt' />ULAKBIM Ulusal Veri Tabanlari (UVT) - ULAKBIM Turkish National Databases<span style='color:#999999'>(uvt)</span></label></li>
										<li><label for='23h'><input type='checkbox' id='23h' name='txtDatabases' onclick='updateChooseDatabases();' value='23h' />Urban Studies Abstracts<span style='color:#999999'>(23h)</span></label></li>
										<li><label for='frh'><input type='checkbox' id='frh' name='txtDatabases' onclick='updateChooseDatabases();' value='frh' />Vente et Gestion<span style='color:#999999'>(frh)</span></label></li>
										<li><label for='28h'><input type='checkbox' id='28h' name='txtDatabases' onclick='updateChooseDatabases();' value='28h' />Violence & Abuse Abstracts<span style='color:#999999'>(28h)</span></label></li>
										<li><label for='voh'><input type='checkbox' id='voh' name='txtDatabases' onclick='updateChooseDatabases();' value='voh' />Vocational and Career Collection<span style='color:#999999'>(voh)</span></label></li>
										<li><label for='v1h'><input type='checkbox' id='v1h' name='txtDatabases' onclick='updateChooseDatabases();' value='v1h' />Vocational Studies Complete<span style='color:#999999'>(v1h)</span></label></li>
										<li><label for='vsh'><input type='checkbox' id='vsh' name='txtDatabases' onclick='updateChooseDatabases();' value='vsh' />Vocational Studies Premier<span style='color:#999999'>(vsh)</span></label></li>
										<li><label for='wrw'><input type='checkbox' id='wrw' name='txtDatabases' onclick='updateChooseDatabases();' value='wrw' />Waters & Oceans Worldwide<span style='color:#999999'>(wrw)</span></label></li>
										<li><label for='fzh'><input type='checkbox' id='fzh' name='txtDatabases' onclick='updateChooseDatabases();' value='fzh' />Wildlife & Ecology Studies Worldwide<span style='color:#999999'>(fzh)</span></label></li>
										<li><label for='wlh'><input type='checkbox' id='wlh' name='txtDatabases' onclick='updateChooseDatabases();' value='wlh' />Wilson Biographies Illustrated<span style='color:#999999'>(wlh)</span></label></li>
										<li><label for='fyh'><input type='checkbox' id='fyh' name='txtDatabases' onclick='updateChooseDatabases();' value='fyh' />Women's Studies International<span style='color:#999999'>(fyh)</span></label></li>
										<li><label for='wph'><input type='checkbox' id='wph' name='txtDatabases' onclick='updateChooseDatabases();' value='wph' />World Book Periodical Database<span style='color:#999999'>(wph)</span></label></li>
										<li><label for='wdh'><input type='checkbox' id='wdh' name='txtDatabases' onclick='updateChooseDatabases();' value='wdh' />World History Collection<span style='color:#999999'>(wdh)</span></label></li>
										<li><label for='a0h'><input type='checkbox' id='a0h' name='txtDatabases' onclick='updateChooseDatabases();' value='a0h' />World Magazine Bank<span style='color:#999999'>(a0h)</span></label></li>
										<li><label for='wta'><input type='checkbox' id='wta' name='txtDatabases' onclick='updateChooseDatabases();' value='wta' />World Textiles<span style='color:#999999'>(wta)</span></label></li>
										<li><label for='fny'><input type='checkbox' id='fny' name='txtDatabases' onclick='updateChooseDatabases();' value='fny' />World War II Archives<span style='color:#999999'>(fny)</span></label></li>

								
									</ul>
							</div>
						</div>

<!-- Database Subject Area -->

												<div id="searchsubjects" style="margin:0;padding:0;display:none;">
							<div style="margin:0;padding:0;margin-top:3px;">
								<div class="labeltext" style="margin:0;padding:0;"><p>Add database groups you created in EBSCOadmin.</p></div>

							</div>

							<div class="labeltext" style="padding-top:5px;margin-bottom:35px;">
								<div style="float:left;margin:0;padding:0;width:180px;">
									<div><input type="text" id="subjectdisplayname" style="width:170px" /></div>
									<div class="commenttext">Display Name</div>
								</div>
								<div style="float:left;margin:0;padding:0;width:70px;">
									<div><input type="text" maxlength="20" id="subjectcode" style="width:60px" /></div>

									<div class="commenttext">Code  <a href="#" onclick="return false;" class="tt"><img src="img/sbb/iconHoverSm.gif" width="10" height="13" style="vertical-align:bottom;" /><span class="tooltip"><img src="img/sbb/DbGroupCodeHover.gif" border="0" width="754" height="513" /></span></a></div>
								</div>
								<div style="float:left;margin:0;padding:0;width:63px;">
									<input type="button" value="Add" onclick="addSubject();" style="width:53px;text-align:center;font-weight:bold;margin-left:2px;color:#ffffff;background:#025DA2 url(http://imageserver.ebscohost.com/WebImages/Ehost/barBlue.gif) repeat-x 50%;vertical-align:middle;border:outset 2px #e0e0e0;padding-bottom:2px;padding-top:2px;" />
								</div>
								<div class="labeltext">
                                                                  <ul style="margin:0;padding:0;" class="multiselect" id="ehost-live-subjects"><li></li>

								</ul>
							</div>


							</div>


						</div>
						
<!-- Profile Credential Inputs -->
						<div id="profileCredentials" style="margin:0;padding:0;display:none;">							
							<div class="labeltext" style="padding-top:15px;margin-bottom:35px;">
								<div style="margin:0;padding:0;width:225px;">
									<div><input type="text" id="customerId" style="width:215px" /></div>
									<div class="commenttext">Customer ID</div>
								</div>
								<div style="margin:0;padding-top:15px;width:225px;">
									<div><input type="text" id="groupId" style="width:215px" /></div>
									<div class="commenttext">Group ID</div>
								</div>
								<div style="margin:0;padding-top:15px;width:225px;">
									<div><input type="text" id="profileId" style="width:215px" /></div>
									<div class="commenttext">Profile ID</div>
								</div>
							</div>
						</div>

<!-- Add EHIS Connector DIV (Set display to 0 in builder.js for any interface that supports EHIS -->
											<div id="searchehisdatabases" style="margin:0;padding:0;display:none;">
							<div style="margin:0;padding:0;margin-top:3px;">

								<div class="labeltext" style="margin:0;padding:0;"><p>Subscribe to EHIS? Add your third-party database.</p></div>
							</div>

							<div class="labeltext" style="padding-top:5px;margin-bottom:35px;">
								<div style="float:left;margin:0;padding:0;width:180px;">
									<div><input type="text" id="dbdisplayname" name="dbdisplayname" style="width:170px" /></div>
									<div class="commenttext">Display Name</div>
								</div>

								<div style="float:left;margin:0;padding:0;width:70px;">
									<div><input type="text" maxlength="20" id="dbcode" name="dbcode" style="width:60px" /></div>
									<div class="commenttext">Code  <a href="#" onclick="return false;" class="tt"><img src="img/sbb/iconHoverSm.gif" width="10" height="13" style="vertical-align:bottom;" /><span class="tooltip"><img src="img/sbb/DbCodeHover.gif" border="0" width="754" height="513" /></span></a></div>
								</div>
								<div style="float:left;margin:0;padding:0;width:63px;">
									<input type="button" value="Add" onclick="addDatabase();" style="width:53px;text-align:center;font-weight:bold;margin-left:2px;color:#ffffff;background:#025DA2 url(http://imageserver.ebscohost.com/WebImages/Ehost/barBlue.gif) repeat-x 50%;vertical-align:middle;border:outset 2px #e0e0e0;padding-bottom:2px;padding-top:2px;" />
								</div>
							</div>

				  </div>

				</div>

<!-- Search Mode Option -->
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="radSearchMode">Search:</label>
					</div>

					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext">
							<p>
								<input type="radio" name="radSearchMode" id="radSearchBoolean" value="+" checked="checked" /><label for="radSearchBoolean">&nbsp;Boolean/Phrase</label>
								<input type="radio" name="radSearchMode" id="radSearchAll" value="+AND+" /><label for="radSearchAll">&nbsp;All terms</label>
								<input type="radio" name="radSearchMode" id="radSearchAny" value="+OR+" /><label for="radSearchAny">&nbsp;Any terms</label>
							</p>
						</div>
					</div>

				</div>
<!-- EHOST Limiters -->
				<div style="display:none;float:left;margin:0;padding:0;width:100%;" id="ehost-liv_limiters">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						Limit results:
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext">
							<p>
								<input id="chkFullText_ehost" type="checkbox" name="chkFullText_ehost" onclick="SetFTOptions(this)"/><label for="chkFullText_ehost">Full Text</label>
							</p>
							<p>
								<input name="chkReferencesAvailable" id="chkReferencesAvailable" type="checkbox" /><label for="chkReferencesAvailable">References Available</label>
							</p>
							<p>
								<input name="chkPeerReviewed1" id="chkPeerReviewed1" type="checkbox" /><label for="chkPeerReviewed1">Scholarly (Peer Reviewed) Journals</label>
							</p>
						</div>
					</div>
				</div>
<!-- EDS Limiters -->
				<div style="display:none;float:left;margin:0;padding:0;width:100%;" id="eds-liv_limiters">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						Limit results:
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext">
						<p>
							<input id="chkFullText_eds" type="checkbox" name="chkFullText_eds" onclick="SetFTOptions(this)"/><label for="chkFullText_eds">Full Text</label>
						</p>
						<p><input name="chkAvailInLibCollection" id="chkAvailInLibCollection" type="checkbox" /><label for="chkAvailInLibCollection">Available in Library Collection</label></p>
						<p><input name="chkPeerReviewed" id="chkPeerReviewed" type="checkbox" /><label for="chkPeerReviewed">Scholarly (Peer Reviewed) Journals</label></p>
						</div>
					</div>
				</div>
				<input type="hidden" id="useFTLimiter" name="useFTLimiter" value="0"/>

<!-- Keyword Box -->
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="txtKeywords">Keywords:</label>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="margin-top:2px;"><input name="txtKeywords" type="text" id="txtKeywords" value="" size="38" style="width:297px;" /></div>
						<div class="commenttext">Keywords will be combined with user search box input.</div>
					</div>
				</div>
			</div>
<!-- Authentication Parameters -->
			<div>&nbsp;</div>
			<div class="leftblock">
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;">
						<h3><font color="#144679">STEP 2</font> &nbsp;Select Authentication Parameters</h3>
					</div>
				</div>

				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="txtProxyPrefix">Proxy prefix:</label>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="margin-top:2px;"><input name="txtProxyPrefix" type="text" id="txtProxyPrefix" value="" size="38" onkeyup="updateChooseDatabases();" style="width:297px;" /></div>
						<div class="commenttext">i.e. http://proxy.institution.edu/login?url=</div>
					</div>

				</div>
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;width:90px;">
						&nbsp;
					</div>
					<div style="float:left;margin:0;padding:0;">
						<fieldset class="labeltext" style="width:286px;padding:7px;">
						<legend style="font-size:11px;">Methods</legend>

						<div style="float:left;margin:0;padding:0;width:100%;">
							<div style="float:left;margin:0;padding:0;width:50%;"><p><label for="chkCookie"><input name="chkCookie" id="chkCookie" value="cookie" type="checkbox" onclick="updateChooseDatabases();" />Cookie</label></p></div>
							<div style="float:left;margin:0;padding:0;width:50%;"><p><label for="chkIp"><input name="chkIp" id="chkIp" value="ip" type="checkbox" onclick="updateChooseDatabases();" />IP Address</label></p></div>
						</div>
						<div style="float:left;margin:0;padding:0;width:100%;">
							<div style="float:left;margin:0;padding:0;width:50%;"><p><label for="chkGuest"><input name="chkGuest" id="chkGuest" value="guest" type="checkbox" onclick="updateChooseDatabases();" />Guest Access</label></p></div>							
						</div>
						<div style="float:left;margin:0;padding:0;width:100%;">
							<div style="float:left;margin:0;padding:0;width:50%;"><p><label for="raduid"><input id="raduid" name="radAuthMethod" type="radio" value="uid" onclick="if(this.checked){displayBlock('CustIDField',1)}else{displayBlock('CustIDField',0)}updateChooseDatabases();" />User ID/Password</label></p></div>
							<div style="float:left;margin:0;padding:0;width:50%;"><p><label for="radurl"><input id="radurl" name="radAuthMethod" type="radio" value="url" onclick="if(this.checked){displayBlock('CustIDField',1)}else{displayBlock('CustIDField',0)}updateChooseDatabases();" />Referring URL</label></p></div>

						</div>
						<div style="float:left;margin:0;padding:0;width:100%;">
							<div style="float:left;margin:0;padding:0;width:50%;"><p><label for="radathens"><input id="radathens" name="radAuthMethod" type="radio" value="athens" onclick="if(this.checked){displayBlock('CustIDField',1)}else{displayBlock('CustIDField',0)}updateChooseDatabases();" />Athens</label></p></div>
							<div style="float:left;margin:0;padding:0;width:50%;"><p><label for="radshib"><input id="radshib" name="radAuthMethod" type="radio" value="shib" onclick="if(this.checked){displayBlock('CustIDField',1)}else{displayBlock('CustIDField',0)}updateChooseDatabases();" />Shibboleth</label></p></div>
						</div>
						<div style="float:left;margin:0;padding:0;width:100%;">
							<div style="float:left;margin:0;padding:0;width:50%;"><p><label for="radcustuid"><input id="radcustuid" name="radAuthMethod" type="radio" value="custuid" onclick="if(this.checked){displayBlock('CustIDField',0)}else{displayBlock('CustIDField',1)}updateChooseDatabases();" />Patron ID</label></p></div>

							<div style="float:left;margin:0;padding:0;width:50%;"><p><label for="radcpid"><input id="radcpid" name="radAuthMethod" type="radio" value="cpid" onclick="if(this.checked){displayBlock('CustIDField',0)}else{displayBlock('CustIDField',1)}updateChooseDatabases();" />Patterned ID</label></p></div>
						</div>
						</fieldset>
					</div>
					<div style="float:left;margin:0;padding:0;width:100%;display:none;" id="CustIDField" name="CustIDField">
						<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
							<label for="txtCustID">Cust ID:</label>
						</div>

						<div style="float:left;margin:0;padding:0;">
							<div class="labeltext" style="margin-top:2px;"><input name="txtCustID" type="text" id="txtCustID" value="" size="38" onkeyup="updateChooseDatabases();" style="width:297px;" /></div>
		        		   		<div class="commenttext">Please contact <a href="mailto:eptech@ebscohost.com">Tech Support</a> for help with your Cust ID.</div>
						</div>
					</div>
				</div>
				<div style="float:left;margin:0;padding:0;width:100%;">

					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						&nbsp;
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="margin-top:2px;"><p><input type="checkbox" name="chkSSL" id="chkSSL" value="https" onclick="updateChooseDatabases();" /><label for="chkSSL">&nbsp;Secure HTTPS authentication</label></p></div>
					</div>
				</div>
			</div>
<!-- Search Box Design area -->
			<div>&nbsp;</div>
			<div class="leftblock">
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;">
						<h3><font color="#144679">STEP 3</font> &nbsp;Choose a Search Box Design</h3>
					</div>
				</div>


<!-- Create Preview Images for STEP 3 on SBB (add interface images here for new interfaces) -->
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_brc-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_brc-live'); return false;" onfocus="selectStyle('s_brc-live');"><img name="s_brc-live" onhover="selectStyle('s_brc-live');" title="Small Search Box" border="0" src="http://support.ebsco.com/images/logos/BioRef100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_brc-live'); return false;" onfocus="selectStyle('m_brc-live');"><img name="m_brc-live" onhover="selectStyle('m_brc-live');" title="Standard Search Box" border="0" src="http://support.ebsco.com/images/logos/BioRef150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_brc-live'); return false;" onfocus="selectStyle('l_brc-live');"><img name="l_brc-live" onhover="selectStyle('l_brc-live');" title="Large Search Box" border="0" type="image" src="http://support.ebsco.com/images/logos/BioRef200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_bbs-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_bbs-live'); return false;" onfocus="selectStyle('s_bbs-live');"><img name="s_bbs-live" onhover="selectStyle('s_bbs-live');" title="Small Search Box" border="0" src="http://support.ebsco.com/images/logos/bbs_100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_bbs-live'); return false;" onfocus="selectStyle('m_bbs-live');"><img name="m_bbs-live" onhover="selectStyle('m_bbs-live');" title="Standard Search Box" border="0" src="http://support.ebsco.com/images/logos/bbs_150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_bbs-live'); return false;" onfocus="selectStyle('l_bbs-live');"><img name="l_bbs-live" onhover="selectStyle('l_bbs-live');" title="Large Search Box" border="0" type="image" src="http://support.ebsco.com/images/logos/bbs_200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_bsi-live_buh">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_bsi-live_buh'); return false;" onfocus="selectStyle('s_bsi-live_buh');"><img name="s_bsi-live_buh" onhover="selectStyle('s_bsi-live_buh');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/bspremier100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_bsi-live_buh'); return false;" onfocus="selectStyle('m_bsi-live_buh');"><img name="m_bsi-live_buh" onhover="selectStyle('m_bsi-live_buh');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/bspremier150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_bsi-live_buh'); return false;" onfocus="selectStyle('l_bsi-live_buh');"><img name="l_bsi-live_buh" onhover="selectStyle('l_bsi-live_buh');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/bspremier200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_bsi-live_bch">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_bsi-live_bch'); return false;" onfocus="selectStyle('s_bsi-live_bch');"><img name="s_bsi-live_bch" onhover="selectStyle('s_bsi-live_bch');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/bscorporate100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_bsi-live_bch'); return false;" onfocus="selectStyle('m_bsi-live_bch');"><img name="m_bsi-live_bch" onhover="selectStyle('m_bsi-live_bch');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/bscorporate150.gif" width="128" height="64"/></a></div>

						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_bsi-live_bch'); return false;" onfocus="selectStyle('l_bsi-live_bch');"><img name="l_bsi-live_bch" onhover="selectStyle('l_bsi-live_bch');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/bscorporate200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_bsi-live_bth">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_bsi-live_bth'); return false;" onfocus="selectStyle('s_bsi-live_bth');"><img name="s_bsi-live_bth" onhover="selectStyle('s_bsi-live_bth');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/bscomplete100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_bsi-live_bth'); return false;" onfocus="selectStyle('m_bsi-live_bth');"><img name="m_bsi-live_bth" onhover="selectStyle('m_bsi-live_bth');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/bscomplete150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_bsi-live_bth'); return false;" onfocus="selectStyle('l_bsi-live_bth');"><img name="l_bsi-live_bth" onhover="selectStyle('l_bsi-live_bth');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/bscomplete200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_chc-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_chc-live'); return false;" onfocus="selectStyle('s_chc-live');"><img name="s_chc-live" onhover="selectStyle('s_chc-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/consumerhealth100.gif" width="85" height="43"/></a></div>

						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_chc-live'); return false;" onfocus="selectStyle('m_chc-live');"><img name="m_chc-live" onhover="selectStyle('m_chc-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/consumerhealth150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_chc-live'); return false;" onfocus="selectStyle('l_chc-live');"><img name="l_chc-live" onhover="selectStyle('l_chc-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/consumerhealth200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_eds-live">

						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_eds-live'); return false;" onfocus="selectStyle('s_eds-live');"><img name="s_eds-live" onhover="selectStyle('s_eds-live');" title="Small Search Box" border="0" src="img/sbb/eds100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_eds-live'); return false;" onfocus="selectStyle('m_eds-live');"><img name="m_eds-live" onhover="selectStyle('m_eds-live');" title="Standard Search Box" border="0" src="img/sbb/eds150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_eds-live'); return false;" onfocus="selectStyle('l_eds-live');"><img name="l_eds-live" onhover="selectStyle('l_eds-live');" title="Large Search Box" border="0" type="image" src="img/sbb/eds200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_ehost-live">
					    	<div style="float:left;margin:0;padding:0 14px 0 0;"><a href="#" onclick="selectStyle('Oversized'); return false;" onfocus="selectStyle('Oversized');" onmouseover="swapImage('selectedStyle','','../images/PreviewOversized.gif',1)"><img id="Oversized" onhover="selectStyle('Oversized');" name="Oversized" title="Oversized Search Box" border="0" src="img/sbb/PreviewOversized.gif" class="defaultStyle"/></a></div>
					    	<div style="float:left;margin:0;padding:0 14px 0 0;"><a href="#" onclick="selectStyle('Large'); return false;" onfocus="selectStyle('Large');" onmouseover="swapImage('selectedStyle','','../images/PreviewLarge.gif',1)"><img id="Large" onhover="selectStyle('Large');" name="Large" title="Large Search Box" border="0" src="img/sbb/PreviewLarge.gif" class="defaultStyle"/></a></div>
					    	<div style="float:left;margin:0;padding:0 0 0 0;"><a href="#" onclick="selectStyle('Custom'); return false;" onfocus="selectStyle('Custom');" onmouseover="swapImage('selectedStyle','','../images/PreviewCustom.gif',1)"><img id="Custom" onhover="selectStyle('Custom');" name="Custom" title="Custom Search Box" border="0" type="image" src="img/sbb/PreviewCustom.gif" class="defaultStyle"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_ell-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_ell-live'); return false;" onfocus="selectStyle('s_ell-live');"><img name="s_ell-live" onhover="selectStyle('s_ell-live');" title="Small Search Box" border="0" src="http://support.ebsco.com/images/logos/ell100.gif" width="85" height="43"/></a></div>

						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_ell-live'); return false;" onfocus="selectStyle('m_ell-live');"><img name="m_ell-live" onhover="selectStyle('m_ell-live');" title="Standard Search Box" border="0" src="http://support.ebsco.com/images/logos/ell150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_ell-live'); return false;" onfocus="selectStyle('l_ell-live');"><img name="l_ell-live" onhover="selectStyle('l_ell-live');" title="Large Search Box" border="0" type="image" src="http://support.ebsco.com/images/logos/ell200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_hrc-live">

						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_hrc-live'); return false;" onfocus="selectStyle('s_hrc-live');"><img name="s_hrc-live" onhover="selectStyle('s_hrc-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/hrc100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_hrc-live'); return false;" onfocus="selectStyle('m_hrc-live');"><img name="m_hrc-live" onhover="selectStyle('m_hrc-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/hrc150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_hrc-live'); return false;" onfocus="selectStyle('l_hrc-live');"><img name="l_hrc-live" onhover="selectStyle('l_hrc-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/hrc200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_hcrc-live">

						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_hcrc-live'); return false;" onfocus="selectStyle('s_hcrc-live');"><img name="s_hcrc-live" onhover="selectStyle('s_hcrc-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/hcrc100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_hcrc-live'); return false;" onfocus="selectStyle('m_hcrc-live');"><img name="m_hcrc-live" onhover="selectStyle('m_hcrc-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/hcrc150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_hcrc-live'); return false;" onfocus="selectStyle('l_hcrc-live');"><img name="l_hcrc-live" onhover="selectStyle('l_hcrc-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/hcrc200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_hirc-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_hirc-live'); return false;" onfocus="selectStyle('s_hirc-live');"><img name="s_hirc-live" onhover="selectStyle('s_hirc-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/hirc100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_hirc-live'); return false;" onfocus="selectStyle('m_hirc-live');"><img name="m_hirc-live" onhover="selectStyle('m_hirc-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/hirc150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_hirc-live'); return false;" onfocus="selectStyle('l_hirc-live');"><img name="l_hirc-live" onhover="selectStyle('l_hirc-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/hirc200.gif" width="170" height="85"/></a></div>
					</div>

					<div style="float:left;margin:0;padding:0;display:none;" id="preview_srck5-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_srck5-live'); return false;" onfocus="selectStyle('s_srck5-live');"><img name="s_srck5-live" onhover="selectStyle('s_srck5-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/kidssearch100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_srck5-live'); return false;" onfocus="selectStyle('m_srck5-live');"><img name="m_srck5-live" onhover="selectStyle('m_srck5-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/kidssearch150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_srck5-live'); return false;" onfocus="selectStyle('l_srck5-live');"><img name="l_srck5-live" onhover="selectStyle('l_srck5-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/kidssearch200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_lirc-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_lirc-live'); return false;" onfocus="selectStyle('s_lirc-live');"><img name="s_lirc-live" onhover="selectStyle('s_lirc-live');" title="Small Search Box" border="0" src="http://support.ebsco.com/images/logos/legalreference_webbutton_100X50.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_lirc-live'); return false;" onfocus="selectStyle('m_lirc-live');"><img name="m_lirc-live" onhover="selectStyle('m_lirc-live');" title="Standard Search Box" border="0" src="http://support.ebsco.com/images/logos/legalreference_webbutton_150X75.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_lirc-live'); return false;" onfocus="selectStyle('l_lirc-live');"><img name="l_lirc-live" onhover="selectStyle('l_lirc-live');" title="Large Search Box" border="0" type="image" src="http://support.ebsco.com/images/logos/legalreference_webbutton_200X100.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_lrc-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_lrc-live'); return false;" onfocus="selectStyle('s_lrc-live');"><img name="s_lrc-live" onhover="selectStyle('s_lrc-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/litreference100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_lrc-live'); return false;" onfocus="selectStyle('m_lrc-live');"><img name="m_lrc-live" onhover="selectStyle('m_lrc-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/litreference150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_lrc-live'); return false;" onfocus="selectStyle('l_lrc-live');"><img name="l_lrc-live" onhover="selectStyle('l_lrc-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/litreference200.gif" width="170" height="85"/></a></div>

					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_novelist-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_novelist-live'); return false;" onfocus="selectStyle('s_novelist-live');"><img name="s_novelist-live" onhover="selectStyle('s_novelist-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/novelist100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_novelist-live'); return false;" onfocus="selectStyle('m_novelist-live');"><img name="m_novelist-live" onhover="selectStyle('m_novelist-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/novelist150.gif" width="128" height="64"/></a></div>
				 		<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_novelist-live'); return false;" onfocus="selectStyle('l_novelist-live');"><img name="l_novelist-live" onhover="selectStyle('l_novelist-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/novelist200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_novelistk8-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_novelistk8-live'); return false;" onfocus="selectStyle('s_novelistk8-live');"><img name="s_novelistk8-live" onhover="selectStyle('s_novelistk8-live');" title="Small Search Box" border="0" src="http://support.ebscohost.com/images/logos/novk8_100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_novelistk8-live'); return false;" onfocus="selectStyle('m_novelistk8-live');"><img name="m_novelistk8-live" onhover="selectStyle('m_novelistk8-live');" title="Standard Search Box" border="0" src="http://support.ebscohost.com/images/logos/novk8_150.gif" width="128" height="64"/></a></div>

						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_novelistk8-live'); return false;" onfocus="selectStyle('l_novelistk8-live');"><img name="l_novelistk8-live" onhover="selectStyle('l_novelistk8-live');" title="Large Search Box" border="0" type="image" src="http://support.ebscohost.com/images/logos/novk8_200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_novpk8-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_novpk8-live'); return false;" onfocus="selectStyle('s_novpk8-live');"><img name="s_novpk8-live" onhover="selectStyle('s_novpk8-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/novk8plus100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_novpk8-live'); return false;" onfocus="selectStyle('m_novpk8-live');"><img name="m_novpk8-live" onhover="selectStyle('m_novpk8-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/novk8plus150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_novpk8-live'); return false;" onfocus="selectStyle('l_novpk8-live');"><img name="l_novpk8-live" onhover="selectStyle('l_novpk8-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/novk8plus200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_novp-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_novp-live'); return false;" onfocus="selectStyle('s_novp-live');"><img name="s_novp-live" onhover="selectStyle('s_novp-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/novplus100.gif" width="85" height="43"/></a></div>

						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_novp-live'); return false;" onfocus="selectStyle('m_novp-live');"><img name="m_novp-live" onhover="selectStyle('m_novp-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/novplus150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_novp-live'); return false;" onfocus="selectStyle('l_novp-live');"><img name="l_novp-live" onhover="selectStyle('l_novp-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/novplus200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_nrc-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_nrc-live'); return false;" onfocus="selectStyle('s_nrc-live');"><img name="s_nrc-live" onhover="selectStyle('s_nrc-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/nrc100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_nrc-live'); return false;" onfocus="selectStyle('m_nrc-live');"><img name="m_nrc-live" onhover="selectStyle('m_nrc-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/nrc150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_nrc-live'); return false;" onfocus="selectStyle('l_nrc-live');"><img name="l_nrc-live" onhover="selectStyle('l_nrc-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/nrc200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_perc-live">

						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_perc-live'); return false;" onfocus="selectStyle('s_perc-live');"><img name="s_perc-live" onhover="selectStyle('s_perc-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/perc100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_perc-live'); return false;" onfocus="selectStyle('m_perc-live');"><img name="m_perc-live" onhover="selectStyle('m_perc-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/perc150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_perc-live'); return false;" onfocus="selectStyle('l_perc-live');"><img name="l_perc-live" onhover="selectStyle('l_perc-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/perc200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_pov-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_pov-live'); return false;" onfocus="selectStyle('s_pov-live');"><img name="s_pov-live" onhover="selectStyle('s_pov-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/pov100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_pov-live'); return false;" onfocus="selectStyle('m_pov-live');"><img name="m_pov-live" onhover="selectStyle('m_pov-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/pov150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_pov-live'); return false;" onfocus="selectStyle('l_pov-live');"><img name="l_pov-live" onhover="selectStyle('l_pov-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/pov200.gif" width="170" height="85"/></a></div>
					</div>

					<div style="float:left;margin:0;padding:0;display:none;" id="preview_rrc-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_rrc-live'); return false;" onfocus="selectStyle('s_rrc-live');"><img name="s_rrc-live" onhover="selectStyle('s_rrc-live');" title="Small Search Box" border="0" src="http://support.ebscohost.com/images/logos/rrc100_webbutton.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_rrc-live'); return false;" onfocus="selectStyle('m_rrc-live');"><img name="m_rrc-live" onhover="selectStyle('m_rrc-live');" title="Standard Search Box" border="0" src="http://support.ebscohost.com/images/logos/rrc150_webbutton.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_rrc-live'); return false;" onfocus="selectStyle('l_rrc-live');"><img name="l_rrc-live" onhover="selectStyle('l_rrc-live');" title="Large Search Box" border="0" type="image" src="http://support.ebscohost.com/images/logos/rrc200_webbutton.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_scirc-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_scirc-live'); return false;" onfocus="selectStyle('s_scirc-live');"><img name="s_scirc-live" onhover="selectStyle('s_scirc-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/scireference100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_scirc-live'); return false;" onfocus="selectStyle('m_scirc-live');"><img name="m_scirc-live" onhover="selectStyle('m_scirc-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/scireference150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_scirc-live'); return false;" onfocus="selectStyle('l_scirc-live');"><img name="l_scirc-live" onhover="selectStyle('l_scirc-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/scireference200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_sas-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_sas-live'); return false;" onfocus="selectStyle('s_sas-live');"><img name="s_sas-live" onhover="selectStyle('s_sas-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/searchasaurus100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_sas-live'); return false;" onfocus="selectStyle('m_sas-live');"><img name="m_sas-live" onhover="selectStyle('m_sas-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/searchasaurus150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_sas-live'); return false;" onfocus="selectStyle('l_sas-live');"><img name="l_sas-live" onhover="selectStyle('l_sas-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/searchasaurus200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_sbrc-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_sbrc-live'); return false;" onfocus="selectStyle('s_sbrc-live');"><img name="s_sbrc-live" onhover="selectStyle('s_sbrc-live');" title="Small Search Box" border="0" src="http://support.ebsco.com/images/logos/smallbusiness_webbutton_100X50.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_sbrc-live'); return false;" onfocus="selectStyle('m_sbrc-live');"><img name="m_sbrc-live" onhover="selectStyle('m_sbrc-live');" title="Standard Search Box" border="0" src="http://support.ebsco.com/images/logos/smallbusiness_webbutton_75X150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_sbrc-live'); return false;" onfocus="selectStyle('l_sbrc-live');"><img name="l_sbrc-live" onhover="selectStyle('l_sbrc-live');" title="Large Search Box" border="0" type="image" src="http://support.ebsco.com/images/logos/smallbusiness_webbutton_100X200.gif" width="170" height="85"/></a></div>
					</div>					
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_serrc-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_serrc-live'); return false;" onfocus="selectStyle('s_serrc-live');"><img name="s_serrc-live" onhover="selectStyle('s_serrc-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/serrc100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_serrc-live'); return false;" onfocus="selectStyle('m_serrc-live');"><img name="m_serrc-live" onhover="selectStyle('m_serrc-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/serrc150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_serrc-live'); return false;" onfocus="selectStyle('l_serrc-live');"><img name="l_serrc-live" onhover="selectStyle('l_serrc-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/serrc200.gif" width="170" height="85"/></a></div>

					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_slrc-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_slrc-live'); return false;" onfocus="selectStyle('s_slrc-live');"><img name="s_slrc-live" onhover="selectStyle('s_slrc-live');" title="Small Search Box" border="0" src="http://support.ebsco.com/images/logos/referencialatina_webbutton_50X100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_slrc-live'); return false;" onfocus="selectStyle('m_slrc-live');"><img name="m_slrc-live" onhover="selectStyle('m_slrc-live');" title="Standard Search Box" border="0" src="http://support.ebsco.com/images/logos/referencialatina_webbutton_75X150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_slrc-live'); return false;" onfocus="selectStyle('l_slrc-live');"><img name="l_slrc-live" onhover="selectStyle('l_slrc-live');" title="Large Search Box" border="0" type="image" src="http://support.ebsco.com/images/logos/referencialatina_webbutton_100X200.gif" width="170" height="85"/></a></div>
					</div>					
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_src-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_src-live'); return false;" onfocus="selectStyle('s_src-live');"><img name="s_src-live" onhover="selectStyle('s_src-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/studentresearch100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_src-live'); return false;" onfocus="selectStyle('m_src-live');"><img name="m_src-live" onhover="selectStyle('m_src-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/studentresearch150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_src-live'); return false;" onfocus="selectStyle('l_src-live');"><img name="l_src-live" onhover="selectStyle('l_src-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/studentresearch200.gif" width="170" height="85"/></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;display:none;" id="preview_swi-live">
						<div style="float:left;margin:0;padding:20px 6px 0 0;"><a href="#" onclick="selectStyle('s_swi-live'); return false;" onfocus="selectStyle('s_swi-live');"><img name="s_swi-live" onhover="selectStyle('s_swi-live');" title="Small Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/ehost100.gif" width="85" height="43"/></a></div>
						<div style="float:left;margin:0;padding:10px 6px 0 0;"><a href="#" onclick="selectStyle('m_swi-live'); return false;" onfocus="selectStyle('m_swi-live');"><img name="m_swi-live" onhover="selectStyle('m_swi-live');" title="Standard Search Box" border="0" src="http://www.ebscohost.com/customerSuccess/downloads/supports/ehost150.gif" width="128" height="64"/></a></div>
						<div style="float:left;margin:0;padding:0 6px 0 0;"><a href="#" onclick="selectStyle('l_swi-live'); return false;" onfocus="selectStyle('l_swi-live');"><img name="l_swi-live" onhover="selectStyle('l_swi-live');" title="Large Search Box" border="0" type="image" src="http://www.ebscohost.com/customerSuccess/downloads/supports/ehost200.gif" width="170" height="85"/></a></div>
					</div>
				</div>
			</div>
<!-- STEP 4 Customize Layout section -->
			<div>&nbsp;</div>
			<div class="leftblock">
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;">
						<h3><font color="#144679">STEP 4</font> &nbsp;Customize the Layout</h3>
					</div>
				</div>

				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="txtTitle">Title:</label>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="margin-top:2px;"><input name="txtTitle" type="text" id="txtTitle" value="" size="38" style="width:297px;" onkeyup="updatePreview();"/></div>
					</div>
				</div>

				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="txtLogo">Logo:</label>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="margin-top:2px;"><input name="txtLogo" type="text" id="txtLogo" value="" size="38" style="width:297px;" onkeyup="updatePreview();"/></div>
						<div class="commenttext">Want to use your own logo? Paste a URL to the image.</div>
					</div>

				</div>
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="txtHeight">Height:</label>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="margin-top:2px;"><p><input name="txtHeight" type="text" id="txtHeight" value="" maxlength="3" size="3" style="width:30px;" onkeypress="return restrictCharacters(this, event);" onkeyup="updatePreview();"/> pixels</p></div>

					</div>
				</div>
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="txtWidth">Width:</label>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="margin-top:2px;"><p><input name="txtWidth" type="text" id="txtWidth" value="" maxlength="3" size="3" style="width:30px;" onkeypress="return restrictCharacters(this, event);" onkeyup="updatePreview();"/> pixels</p></div>

					</div>
				</div>
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="chkResults">Results:</label>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="margin-top:2px;">
						<p>
						<input type="checkbox" name="chkResults" id="chkResults" value="1" checked="checked" />
						<label for="chkResults">Open search results in new browser</label></p></div>
					</div>
				</div>
				<div style="display:none;float:left;margin:0;padding:0;width:100%;" id="displayChooseDatabases">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="chkChooseDatabases">Databases:</label>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="margin-top:2px;">
						<p><input type="checkbox" name="chkChooseDatabases" id="chkChooseDatabases" value="choose" onclick="updateChooseDatabases();" checked="checked" />
						<label for="chkChooseDatabases">Show choose databases <span id="requireChooseDatabases" style="color:#999999;display:none;">(for 2 or more databases)</span></label></p></div>

					</div>
				</div>
				<div style="float:left;margin:0;padding:0;width:100%;" id="displayFullText">
					<div style="float:left;margin:0;padding:0;margin-top:17px;width:90px;">
						<label for="chkShowFT">Full Text Limiter:</label>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext" style="margin-top:2px;">
						<p>
						<input type="checkbox" name="chkShowFT" id="chkShowFT" onclick="SetFTSearch(this);" checked="checked" />
						<label for="chkShowFT">Show Full Text Checkbox Limiter</label></p></div>
					</div>
				</div>

			</div>
			<div>&nbsp;</div>
			<div class="leftblock">
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;">
						<h3><font color="#144679">STEP 5</font> &nbsp;Confirm Your Search Box</h3>

					</div>
				</div>
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext"><p>Test-drive your search box. Try it out here.</p></div>
						<div id="ebscohostsearchbox" name="ebscohostsearchbox" style="margin:10px 0px 0px 5px;background-repeat:no-repeat;">
							<div id="ebscohostsearchfields" name="ebscohostsearchfields" style="padding-top:5px;">
								<div id="ebscohostsearchtitle" name="ebscohostsearchtitle" style="font-weight:bold;">Research databases</div>
								<div style="padding-top:7px;">
									<span><input id="ebscohostsearchtext" name="ebscohostsearchtext" type="text" size="23" style="font-size:9pt;padding-left:5px;"/></span>
									<span><input type="button" value="Search" onclick="ebscoHostSearchGo();" style="font-size:9pt;padding-left:5px;"/></span>
								</div>
								<div id="includeFT" style="float:left;margin:0;padding:0;width:100%;">
									<input type="checkbox" id="chkFullText" name="chkFullText"/>
									<label for="chkFullText">Full Text</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div style="clear:both;"></div>
				<div id="previewChooseDatabases" style="float:left;margin:0;padding:0;width:100%;display:none;">
					<div style="float:left;margin:0;padding:0;padding-left:4px;">
					<ul class="choose-db-list" id="dbList">
					</ul>
					</div>
				</div>
				<div style="clear:both;">&nbsp;</div>
				<div style="float:left;margin:0;padding:0;">
					<div style="float:left;margin:0;padding:0;width:200px;">
						<div class="labeltext"><a href="#" onclick="createSearchBox();return false" onmouseout="swapImgRestore()" onmouseover="swapImage('CreateButton','','img/sbb/CreateButton_over.gif',1)"><img src="img/sbb/CreateButton.gif" title="Create Search Box" name="CreateButton" width="140" height="32" border="0" /></a></div>
					</div>
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext"><a href="#" onclick="resetForm(document.form1); return false;">Reset form</a></div>
					</div>
				</div>

			</div>
			<div style="clear:both;">&nbsp;</div>
			<div class="leftblock">

				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;">
						<h3><font color="#144679">STEP 6</font> &nbsp;Copy Your Search Box Code</h3>
					</div>
				</div>
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext"><p>Copy code to clipboard. Paste this code in your web page.</p></div>
					</div>
				</div>
				<div style="float:left;margin:0;padding:0;width:100%;">
					<div style="float:left;margin:0;padding:0;">
						<div class="labeltext"><textarea name="memoCode" id="memoCode" rows="6">Click the "Create Search Box" button above to generate code.</textarea></div>
					</div>
				</div>

			</div>
			<div style="clear:both;">&nbsp;</div>
			<div class="leftblock">
				<p>For help with EBSCOhost Search Box Builder, please see:</p>
				<ul class="general" style="margin-top:7px;">
				<li style="margin-left: 30px;"><a href="http://support.ebsco.com/knowledge_base/detail.php?topic=&amp;id=3955" target="_blank">How do I embed an EBSCOhost search box on to my website?</a></li>
				<li style="margin-left: 30px;"><a href="http://support.ebsco.com/knowledge_base/detail.php?topic=&amp;id=4295" target="_blank">How do I use the EBSCO Search Box Builder tool?</a></li>
				<!--<li style="margin-left: 30px;"><a href="http://supportforms.epnet.com/eit/searchboxbuilder/openaccess/" target="_blank">EBSCOhost Integrated Search (EHIS) search box samples</a></li>-->
				</ul>
			</div>
			<div>&nbsp;</div>
		</div>
		</form>

	<p>&nbsp;</p>
	
<?php 

include( 'includes/footer.php' );

?>