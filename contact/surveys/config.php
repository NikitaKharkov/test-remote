<?php
/*
* LimeSurvey
* Copyright (C) 2007 The LimeSurvey Project Team / Carsten Schmitz
* All rights reserved.
* License: GNU/GPL License v2 or later, see LICENSE.php
* LimeSurvey is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or is 
* derivative of works licensed under the GNU General Public License or other 
* free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*
* $Id: config-defaults.php 4334 2008-02-25 13:21:10Z c_schmitz $
*/

/* IMPORTANT NOTICE
*  With LimeSurvey v1.70+ the configuration of LimeSurvey was simplified,
*  Now config.php only contains the basic required settings.
*  Some optional settings are also set by default in config-defaults.php.
*  If you want to change an optional parameter, DON'T change values in config-defaults.php!!!
*  Just copy the parameter into your config.php-file and adjust the value!
*  All settings in config.php overwrite the default values from config-defaults.php
*/

// Basic Setup

$databasetype       =   'mysql';       // ADOdb database driver - valid values are mysql, odbc_mssql or postgres
$databaselocation   =   'supportdb102.epnet.com';   // Network location of your Database - for odbc_mssql use the mssql servername, not localhost or IP
$databasename       =   'surveys';  // The name of the database that we will create
$databaseuser       =   'surveyUser';        // The name of a user with rights to create db (or if db already exists, then rights within that db)
$databasepass       =   'Th1sI$@t3st#';            // Password of db user
$dbprefix           =   '';       // A global prefix that can be added to all LimeSurvey tables. Use this if you are sharing
                                       // a database with other applications. Suggested prefix is 'lime_'

// File Locations
$rooturl            =   "http://{$_SERVER['HTTP_HOST']}/contact/surveys"; //The root web url for your limesurvey installation (without a trailing slash). The double quotes (") are important.

$rootdir            =   dirname(__FILE__); // This is the physical disk location for your limesurvey installation. Normally you don't have to touch this setting.
                                           // If you use IIS then you MUST enter the complete rootdir e.g. : $rootDir='C:\Inetpub\wwwroot\limesurvey'!
                                           // Some IIS installations also require to use forward slashes instead of backslashes, e.g.  $rootDir='C:/Inetpub/wwwroot/limesurvey'!
                                           // If you use OS/2 this must be the complete rootdir with FORWARD slashes e.g.: $rootDir='c:/limesurvey';!
// Site Setup
$sitename           =   'EBSCO Surveys';     // The official name of the site (appears in the Window title)

$defaultuser        =   'dinonet';          // This is the default username when LimeSurvey is installed
$defaultpass        =   'lam3surve3ys';       // This is the default password for the default user when LimeSurvey is installed
$sessionlifetime    =  36000;    // How long until a survey session expires in seconds

// Email Settings

$siteadminemail     =   'customersuccess@ebscohost.com'; // The default email address of the site administrator
$siteadminbounce    =   'customersuccess@ebscohost.com'; // The default email address used for error notification of sent messages for the site administrator (Return-Path)
$siteadminname      =   'EP Customer Success';      // The name of the site administrator
$maxemails          =   3996;               // The maximum number of emails to send in one go (this is to prevent your mail server or script from timeouting when sending mass mail)
// $surveyPreview_require_Auth
// Enforce Authentication to the LS system
// before beeing able to preview a survey (testing a non active survey)
// Default is true
$surveyPreview_require_Auth = false;

//XSS filter off
$filterxsshtml = false;
