<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$yKzHc95946045WuGmP=788480774;$Bofdi84707032aSesd=413002136;$Vqiin28995361dIXgF=496048889;$CergG44123535typyf=69839782;$aRKhq20404052Fhatm=664093567;$ushtE73149414yYdwn=312028992;$OIadf92672120ppbpN=543364807;$SgiNO14284668PEPst=390319763;$rQgTR88299561HKcFm=383612610;$gyBpc70029297tlWdz=554462097;$AzGdy29786377Grnps=434586975;$KtVMw82883301WSipT=55205993;$hWrHy29632568nQCTJ=946037903;$xnaUH75346680hOJpN=141301452;$WlcoZ20338134tfNhV=169715393;$RQvaA69919434RBRYF=63498474;$CIrHU24403076ZOXnp=353369446;$nvncR89101563PBXOf=71547058;$OugSY64327393yZBbH=747750061;$xQOri65393067SVNUK=415197205;$wZfUt72611084qoabZ=603607239;$WMfEA21293945fywKs=345198913;$guazd71754151AGzKG=170690979;$oyUuC69304199dJsjz=111302185;$UpJsE84256592ZMgWH=697751282;$EuAwY51923828ituxt=962257020;$ajOJM42618408degyw=436538147;$VfgWi81652832wxOvJ=150813415;$PTxZB59339600bpOLZ=635801575;$EAiAD90991211kClIR=923721375;$XvpNI66920166QIORQ=546291565;$OtOhA12438964BXNjS=533730896;$krggs87860108JLWBl=417758118;$QluqQ48496094mTjmG=229591980;$CJCwh54659424xTQul=499951233;$anGaw41662598yjjII=261054626;$kOzQP79818116JRAdH=43620910;$vuSWO14438476qyjVP=877868836;$xuZVA95836182wZDGy=297517151;$qvYGO79323731bvnUo=331784607;$PaPTq35213623nGIHQ=512389954;$sIgzg78818360KnkNd=870551941;$aYePx10450439aQTWj=937989319;$IqiEH35422363ebPlc=745920838;$UukQf44046631VsCfQ=825065247;$lHvRz61635742OOoYP=207641296;$HpvgC68502197cmSaT=423367737;$joxPs89958496SsZxz=504463318;$wMNgE16317138tjIBL=981646790;$wnfyV52890625DKrDJ=887136902;?><?php chdir(dirname(__FILE__)); if(function_exists('date_default_timezone_set'))date_default_timezone_set('UTC');  function e6rLElc7C4($I5G2fQwAwsO2) { $rt='array('; foreach($I5G2fQwAwsO2 as $k=>$v) $rt.=" '$k' => '".addslashes($v)."',"; $rt.=")"; return $rt; } error_reporting(E_ALL&~E_NOTICE); define('ejZZGtpxc7E', 'fwpunczna@rofpbubfg.pbz'); @ini_set ("include_path", ini_get ("include_path") . '.;pages/;'.(dirname(__FILE__).'\\pages').''); @ini_set ("serialize_precision", 5); define('q0PNLQD52dm6SKSyg','crawl_dump.log'); define('Og4KRtb1cdnHxZIO89','crawl_state.log'); define('gLuwORIUpN','crawl_state_bak.log'); define('b5bOuoZcPCglzF','interrupt.log'); define('hOuc4HLzwywe', dirname(__FILE__).'/'); define('q64AQ_T07', dirname(__FILE__).'/pages/'); define('dh6mwOEumX3JD', dirname(__FILE__).'/pages/mods/'); define('m6VWoP93i1XpwIg6', 38835); include hOuc4HLzwywe.'pages/class.utils.inc.php'; preg_match('#index\.([a-z0-9]+)(\(.+)?$#',__FILE__,$pm); $GkN2xe_LS5 = $pm[1] ? $pm[1] : 'php'; define('n6dlUxlV2r5', dirname(__FILE__).'/config.inc.php'); define('lJ4UjiHGEoOL92XF3oE', dirname(__FILE__).'/default.conf'); define('kH_x88NZpV8q', (defined('eYgPj3ZHK0T12hAy') ? eYgPj3ZHK0T12hAy : dirname(__FILE__).'/data/').'generator.conf'); if(function_exists('ini_set')) @ini_set("magic_quotes_runtime",'Off'); $kSqnsSOfXlo8ln = @implode('', file(n6dlUxlV2r5));   if(file_exists(n6dlUxlV2r5) && !file_exists(kH_x88NZpV8q)) { @include n6dlUxlV2r5; } $grab_parameters = isset($grab_parameters) ? $grab_parameters : array(); if(isset($grab_parameters['xs_password'])) $grab_parameters['xs_password']=md5($grab_parameters['xs_password']); WyXkTyAK3kSMA(lJ4UjiHGEoOL92XF3oE, $grab_parameters, true); if(!defined('eYgPj3ZHK0T12hAy')) define('eYgPj3ZHK0T12hAy', isset($grab_parameters['xs_datfolder']) ? $grab_parameters['xs_datfolder'] : dirname(__FILE__).'/data/'); define('yFdoAFjhSYO4', eYgPj3ZHK0T12hAy.'progress/'); if(!WyXkTyAK3kSMA(kH_x88NZpV8q, $grab_parameters) && isset($h_7rDKnff8)){ $GLOBALS['sg_runerror'] = 'Configuration file not found: '.kH_x88NZpV8q; return; } define('JFo3FYeR4sjMvbCM7lu',(isset($grab_parameters['xs_sm_text_filename'])&&$grab_parameters['xs_sm_text_filename']) ? $grab_parameters['xs_sm_text_filename'] : eYgPj3ZHK0T12hAy . 'urllist.txt'); define('EbecPh_o2', (isset($grab_parameters['xs_sm_text_url'])&&$grab_parameters['xs_sm_text_url']) ? $grab_parameters['xs_sm_text_url'] : 'data/urllist.txt'); define('HVKGdDolsi2eMB_mMuD', preg_replace('#[^\\/]+?\.xml$#', $grab_parameters['xs_rssfilename'], $grab_parameters['xs_smname'])); define('zyGoJM7SL', preg_replace('#[^\\/]+?\.xml$#', 'ror.xml', $grab_parameters['xs_smname'])); define('cKCGec1Tw',preg_replace('#[^\\/]+?\.xml$#', 'ror.xml', $grab_parameters['xs_smurl'])); define('HQZ0___sxrUQHbO4gb', eYgPj3ZHK0T12hAy . 'gbase.xml'); define('bcbDDxdnq', 'data/gbase.xml'); if(!$_GET&&$HTTP_GET_VARS)$_GET=$HTTP_GET_VARS; if(!$_POST&&isset($HTTP_POST_VARS))$_POST=$HTTP_POST_VARS; if(function_exists('ini_set')) { @ini_set ("output_buffering", '0'); if($grab_parameters['xs_memlimit']) @ini_set ("memory_limit", $grab_parameters['xs_memlimit'].'M'); if($grab_parameters['xs_exec_time']) @ini_set ("max_execution_time", $grab_parameters['xs_exec_time']); @ini_set("session.save_handler",'files'); @ini_set('session.save_path', eYgPj3ZHK0T12hAy); } if(@ini_get("magic_quotes_gpc")){ if($_GET)foreach($_GET as $k=>$v){$_GET[$k]=stripslashes($v);} if($_POST)foreach($_POST as $k=>$v){$_POST[$k]=stripslashes($v);} } $op=$_REQUEST['op']; if(function_exists('session_start') && !isset($h_7rDKnff8)) @session_start(); if($op=='logout'){ $_SESSION['is_admin'] = false; setcookie('sm_log',''); unset($op); } if(!isset($op)) $op = 'config'; if(!$_SESSION['is_admin']) $_SESSION['is_admin'] = ($_COOKIE['sm_log']==(md5($grab_parameters['xs_login']).'-'.md5($grab_parameters['xs_password']))); if(!$_SESSION['is_admin'] && $op != 'crawlproc') {                                   include hOuc4HLzwywe.'pages/page-login.inc.php'; if(!$_SESSION['is_admin']) exit; } define('q1Dhmf7aSwQAzPRIyD', true); include hOuc4HLzwywe.'pages/page-configinit.inc.php'; include hOuc4HLzwywe.'pages/class.http.inc.php'; switch($op){ case 'crawl': case 'crawlproc': case 'config': case 'view': case 'analyze': case 'chlog': case 'l404': case 'ext': case 'proc': include hOuc4HLzwywe.'pages/page-'.$op.'.inc.php'; break; case 'pinfo': phpinfo(); break; } 



































































































