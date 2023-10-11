<?
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$page_function = page_function(
	array( "list" ), request_value('page_function')
);

$template->setStyle('site');
$template->setHtmlTitle('Support Site');
$template->printHeader();

# ----------------------------------- #
#	BODY
# ----------------------------------- #
?>
<style>
/* 404 page REMOVE AFTER LAUNCH */
.contact_title {
  color: #454545;
  font-size: 34px;
  margin: 40px 10px;
}

.hrstyle { 
  border: 0;
  height: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
  border-bottom: 1px solid rgba(255, 255, 255, 0.3);
  margin: 20px 10px;
 }
 
.pagenotfound1 { 
    font-size: 22px;
    color: #454545;
    margin: 20px 10px;
}

.pagenotfound2 { 
    font-size: 16px;
    color: #454545;
    margin: 20px 10px;
  }
  
.pnf_search { margin: 30px 10px 160px; }
</style>
	<div id="pnf">
	<div class="contact_title">Contact Support</div>
  <hr class="hrstyle">
 <p class="pagenotfound1">We're sorry, the page you are looking for may have moved or may no longer exist.</p>

<p class="pagenotfound2">Please try searching EBSCO Help or vist our <a href="/">homepage</a>.</p>

<!--<div class="pnf_search mt-quick-search-container mt-toggle-form-container">
<form action="https://ebsco-prod.mindtouch.us/Special:Search"><input id="mt-qid-skin" name="qid" type="hidden" value="" /> <input id="mt-search-filter-id" name="fpid" type="hidden" value="230" /> <input id="mt-search-filter-path" name="fpth" type="hidden" /> <input id="mt-search-path" name="path" type="hidden" value="" /> <label class="mt-label" for="mt-site-search-input"> Search </label> <input class="mt-text mt-search search-field" id="mt-site-search-input" name="search" placeholder="How can we help you?" tabindex="1" type="search" /><button class="mt-button ui-button-icon mt-icon-site-search-button search-button" tabindex="2" type="submit">Search</button></form>
</div>-->
	</div>
	

<?php
# ----------------------------------- #
# FOOTER
# ----------------------------------- #
$template->printFooter();
?>