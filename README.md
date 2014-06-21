wac_suiteCRM
============

Web Site Account Control (WAC) Using SuiteCRM

This project is a series of php codifications that will allow you to control access to your website, using SuiteCRM as a backend controller.

It's a generic portal software for accounts suscribed to your website, and that eventually suscribe with your company a service.

It also shows what is going on behind the scenes in our "http://crmsync.me" website.

Please dare to provide more features to WAC!

You will have a way to allow in your website the following:

- Register a new user, impacting over Contact and Accounts database.
- Login / logout a user
- Allow him to reset his forgotten username and password
- Allow him to enter several account settings, that will impact over AOS_Contracts module.

REGISTER A NEW USER
===================

When a user register himself in your website, all the data he put in the registration form, will be processed by the action code present in
"crmConnectionSoap.php" using v4_1 soap webservices. Inmmediatly a logic hook provided in the installable module. (scrm_install) will send him an email to validate his account.
The validation, is provided in two ways: providing a one-time validation over the website, or a 24 hours expire validation through a link sent to his declared email.

LOGIN / LOGOUT A USER
=====================

When a user (Contact) logs in, his login password is validated by "crmConnectionSoap.php" facilities. If his username and password is correct, it establishes a logged_in session in his browser.

If login/password pair is unsuccessful, allows to retrieve them using a validation, received by email. crmConnectionSoap.php generates a special
Task in SuiteCRM, and a logic_hook present in the installable module, sends him an email to validate. This action is similar to the validation process provided by the registration form.

ACCOUNT SETTINGS
================

Accounts settings component, provided by different forms, impact over Contacts (for user personal settings) Accounts (for company billing settings) and AOS_Contracts module (type of services suscribed). Also in the http://crmsync.me case, impact over an ad-hoc package, where the technical settings of the service are stored, and further, used by the crmsync.me sincronization executable.


Directories:


/--------index.sample.php (bootstrap index page containing the generic website. Rename to index.php or whaterver...)
    |
    |-----js/ (directory containing the jquery scripts that show the different modal popups with the forms)
    |
    |-----scrm_install (zip this directory to obtain an installable module)
    |
    |  
    -----include-----/*_forms.php (forms that control the process)
    |               |
    |               |--/modalpopups.php (modal container)
    |
    |
    -----core/----actions/-----crmConnectionSoap.php (processes that control the connection to suitecrm)
                            |
                            |--crmConnectionRest.php (not in use. Deprecated in this version due to undesired functioning.. get_entry_list 
                            |                       method was delivering the whole object instead of just selected records)
                            |--parameters.sample.php (rename this to parameters.php and put your access (url, username and password) data to 
                            |                       your  crm)
                        
    



WIKI
======================

Include this in the very beginning of your index.php:
<?php include('include/location/headlocation.php'); ?>

Include this style to hide alerts by default:
<link href="/css/crmsyncme.css" rel="stylesheet">


Include the following before </body> in your index.php for example:

This is the wrapper of popups to login/logout...
<?php include('include/modalwrapper/modalpopups.php'); ?>

The following shows or hide alerts depending of status of variables:
<?php include('include/js/jquerypopups.php'); ?>


SuiteCRM Installable Module
===========================

This is to generate an installable module in SuiteCRM. The manifest.php
is empty at the moment of this commit.
