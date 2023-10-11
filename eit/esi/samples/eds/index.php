<?php
/**
* Include profile.php for credentials.
* Display the main page for eds search
*
* PHP version 5
*
* LICENSE: This source file is subject to version 3.01 of the PHP license
* that is available through the world-wide-web at the following URI:
* http://www.php.net/license/3_01.txt.  If you did not receive a copy of
* the PHP License and are unable to obtain it through the web, please
* send a note to license@php.net so we can mail you a copy immediately.
*
* @category  Simple_Search
* @package   PackageName
* @author    EBSCO Publishing's <author@example.com>
* @author    Persistent System Limited <minal@persistent.co.in>
* @copyright 1997-2005 The PHP Group
* @license   http://www.php.net/license/3_01.txt  PHP License 3.01
* @link      http://pear.php.net/package/PackageName
*/	
require "profile.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>The University Collection - Search using EBSCOhost</title>
<link rel='stylesheet' href='eds.css' type='text/css' />

<script language="javascript">

function submitform()
{
obj_disp=document.getElementById( "main_disp" );
if(obj_disp.style.display == "block" )
    {
    document.getElementById( "s1" ).value = "";
    document.getElementById( "s2" ).value = "";
    document.getElementById( "s3" ).value = "";
    }
    
    if(obj_disp.style.display == "none" )
    {
    document.getElementById( "query" ).value = "";
    }
    
    document.forms["index_form"].submit();
}
//function to see the search options or hide it
function toggle_search()
{
    toggle_display( "search_opt_on" );
    toggle_display( "search_opt_off" );
}

function toggle_display( id ) {
    
    obj = document.getElementById( id );
    obj_disp=document.getElementById( "main_disp" );
    
    
    if ( obj )
    {
        obj_disp.style.display = ( obj.style.display == "none" ) ? "block" : "none";
        obj.style.display = ( obj.style.display == "none" ) ? "block" : "none";
        
     }   
      
    
}

</script>

</head>
<body>

<div id="container">
    <div id="header">
        <div class="top">
            <a href="#">New Search</a>
        </div>

		 <div class="middle">
			<img src="images/logo_main_png.gif" style="float:left" alt="" />
			<img src="images/logo_right.png" style="float:right" alt="" />
			<table>
				<tr>
					<td>
						<div class="inactive_button" style="margin-left: 50px;">
							Home
						</div>
					</td>
					<td>
						<div class="active_button">
							Search
						</div>
					</td>
					<td>
						<div class="inactive_button">
							Subject Guides
						</div>
					</td>
					<td>
						<div class="inactive_button">
							A-Z Publications
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="bottom"></div>
		
    </div>
    <form action="search.php" method="get" id="index_form">
    
    <input type="text" name="advset" style="display: none;" value=""/>
    <div id="content">
        <div class="box">
            
            
            Searching: <b>University Library Collection</b>
            <br/>
            <div id="main_disp" style="display:block;">
            <p>
                <input type="text" name="query" style="width: 350px;" id="query" /> 
                <input type="button" value="Search" onclick="javascript: submitform();"/>
            </p>
            <br/>
            
            <table>
                <tr>
                    <td>
                        <input type="radio" name="searchfield" value="keyword" checked="checked"/>
                    </td>
                    <td>
                    Keyword
                    </td>
                    <td>
                        <input type="radio" name="searchfield" value="author" />
                    </td>
                    <td>
                        Author
                    </td>
                    <td>
                        <input type="radio" name="searchfield" value="title" />
                    </td>
                    <td>
                        Title
                    </td>
                </tr>
            </table>
            </div>
            <br/>
            <div id="search_opt_off" style="display: block">
                <p>
                    <span class="search_options_off" ><a href="javascript:toggle_search();">Advanced Search</a></span>
                </p>
            </div>
            <div id="search_opt_on" style="display: none">
                <p>
                    <span class="search_options_on"><a href="javascript:toggle_search();"><b>Advanced Search</b></a></span>
                </p>
                <div class="search_options_box">
                    <div style="float: left">
                        <div style="width: 180px; float: left; display: none;">
                            <input type="checkbox" name="ft" style="" />Full Text Only <br />
                            <input type="checkbox" name="sch" style="" />Peer Reviewed Journals <br />
                        </div>
                    
                        <table>
    <tr>
        
        <td colspan="2">
            <input type="text" name="s1" id="s1" style="width:170px;margin:5px 0 5px 0;">
        </td>
        <td>
            in <select name="t1">
            <option value="" selected="selected">Select a Field (optional)</option>
            <option value="TX">All Text</option>
            <option value="AU">Author</option>
            <option value="TI">Title</option>
            <option value="SU">Subject Terms</option>
            <option value="SO">Journal Title/Source</option>
            <option value="AB">Abstract</option>
            <option value="IS">ISSN</option>
            <option value="IB">ISBN</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <select name="d1" style="width:60px;margin:5px 0 5px 0;">
                <option value="AND">AND</option>
                <option value="OR">OR</option>
                <option value="NOT">NOT</option>
            </select>
        </td>
        <td>
            <input type="text" name="s2"  id="s2" style="width:100px;margin:5px 0 5px 0;">
        </td>
        <td>
            in <select name="t2">
            <option value="" selected="selected">Select a Field (optional)</option>
            <option value="TX">All Text</option>
            <option value="AU">Author</option>
            <option value="TI">Title</option>
            <option value="SU">Subject Terms</option>
            <option value="SO">Journal Title/Source</option>
            <option value="AB">Abstract</option>
            <option value="IS">ISSN</option>
            <option value="IB">ISBN</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <select name="d2" style="width:60px;margin:5px 0 5px 0;">
                <option value="AND">AND</option>
                <option value="OR">OR</option>
                <option value="NOT">NOT</option>
            </select>
        </td>
        <td>
            <input type="text" name="s3" id="s3" style="width:100px;margin:5px 0 5px 0;">
        </td>
        <td>
            in  <select name="t3">
            <option value="" selected="selected">Select a Field (optional)</option>
            <option value="TX">All Text</option>
            <option value="AU">Author</option>
            <option value="TI">Title</option>
            <option value="SU">Subject Terms</option>
            <option value="SO">Journal Title/Source</option>
            <option value="AB">Abstract</option>
            <option value="IS">ISSN</option>
            <option value="IB">ISBN</option>
            </select>
        </td>
    </tr>
</table>
          <input type="button" value="Search" onclick="javascript: submitform();"/>              
                         
                        <table style="float: left; display: none;">
                            <tr>
                                <td>
                                    <input type="radio" name="pubtype" value="all" />
                                </td>
                                <td>
                                    All
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="pubtype" value="articles" />
                                </td>
                                <td>
                                    Articles
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="pubtype" value="books" />
                                </td>
                                <td>
                                    Books
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                    <div style="float: right; text-align: right; display: none;">
                        Sort by: <select name="sort">
                            <option value="relevance" selected>Relevance</option>
                            <option value="date">Date</option>
                        </select>
                        <br />
                        <br />
                        <br />
                        <table>
                            <tr>
                                <td colspan="3" style="text-align: left">
                                    <b>Publication Date:</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    From:
                                </td>
                                <td>
                                    <select name="from_month">
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </td>
                                <td>
                                    of <input name="from_year" type="text" style="width: 50px" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    to
                                </td>
                                <td>
                                    <select name="to_month">
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </td>
                                <td>
                                    of <input name="to_year" type="text" style="width: 50px" />
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style="clear:both"></div>
                    
                </div>
            </div>
        </div>
    </div>
	
	<div id="footer">
		<a href="http://support.ebscohost.com/eit/">Back to EBSCOhost Integration Toolkit Home</a>
	</div>
	
    </form>
    
</div>

</body>
</html>