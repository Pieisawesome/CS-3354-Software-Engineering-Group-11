# Intro
These files are supposed to emulate the administrator side of viewing/creating/editing/deleting events. You can search for a specific event as well as create one.

Currently working on implementing adding member and member list.

Files that go together: (I mean naming scheme should make sense but here it is anyways)
- createEventPage.html, createEventScript.php
- eventListPage.html, eventListScript.php, eventListSearchScript.php
- editEventPage.html, editEventScript.php, editEventUpdateEvents.php, eventListDeleteScript.php
- db_config.php is included in all .php files


### To run the program:
First make sure you have Xampp installed. Download this folder (lana_testing) and move it into your ...xampp/htdocs/ folder. Start both Apache and MySQL in the Xampp Control Panel. You should then be able to access phpMyAdmin through your local host: localhost:(apache port number)/phpMyAdmin. Create a database called 'cs3354Project'. Import the provided .sql file into your database. You should then be able to run localhost:(apache port number)/lana_testing/eventListPage.html.
