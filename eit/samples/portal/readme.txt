***************************************************
  README for EBSCOhost Integration Toolkit (EIT)
		Corporate Portal Demo
		June 2010
***************************************************

To view Readme.txt on screen in Notepad, maximize the Notepad window.

To print Readme.txt, open it in Notepad or another word 
processing program, and use the Print command on the File menu.

This README contains instructions on how to use the EBSCOhost Integration
Toolkit PHP Demo Files.


---------------------------------
REQUIREMENTS
---------------------------------
In order to run the demo software, your server must meet these minimum
requirements:

-	Apache Software Foundation(c) HTTP Server 2.2.x or greater,
	or Microsoft(R) IIS 6.0 or greater
		(http://www.apache.org)
		(http://www.iis.net)
-	PHP(c) 5.2.x or greater installed
		(http://www.php.net)
-	PHP Module 'php_curl' enabled (standard with most installations)
		(http://www.php.net/manual/en/curl.setup.php)

---------------------------------
SETUP
---------------------------------
To run the PHP applications, copy the 'portal_demo' folder onto
your web server environment.


---------------------------------
AUTHENTICATION
---------------------------------
In order to access the EBSCOhost Web Services, you must have an EIT
enabled profile.  If you have an EIT-enabled profile, you may enter
your details in the 'profile.php' source code, which is found in the
'portal_demo' folder.


---------------------------------
ABOUT THIS DEMO
---------------------------------
This demo application shows different ways to integrate EBSCOhost's
services into your corporate portal.  This example uses the REST protocol
to retrieve XML information from EBSCOhost.  This information is then
rendered into HTML using XSL stylesheets.

The highlights of this demo are EBSCOhost's Web Service, RSS, and Persistent
Link functions.

The web service is integrated into the portal via the search interface.  The
search interface on this demo will query EBSCOhost's web service, and return
the results in the portal using XSLT.  This demo gives a few examples of what
can be done with the search data;  A "Narrow By Subject" area, and a breadcrumb
feature have been implemented.

The RSS feed on the index page is displayed using an iframe.  An RSS feed can
be setup for any search, and displays the latest results for that particular
search.

The Persistent Links on the index page show practical uses of the persistent
link feature.  The search box will forward the users query to the EBSCOhost
interface, and the links directly below it are hard-coded to company profiles
in the EBSCOhost database.

