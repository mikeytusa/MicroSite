MicroSite
=========

A tiny static website framework.

MicroSite is a very small framework for building static websites.  It does not depend on any particular UI or backend framework and doesn't require a database.

It does requires PHP for header and footer file inclusion.

MicroSite is meant to be a quick starting point for building static websites from scratch.  Adding in your frontend framework is simple and takes a moment.

Five pages have been created for reference and to serve as a starting point:

index.php - this file is responsible for including your header and footer on each or serving up a 404 page if no page is found.
header.php - this will be your websites header file
footer.php - this is your websites footer file
404.php - this is your websites 404 page
home.php - this is your home page.  You'll want to copy this file for all of your other pages.

File Descriptions:

.htaccess - for removing .php from all URL's.  Make sure this doesn't get removed.
favicon.ico - this is just a sample favicon.  Replace it with your own.
robots.txt - used to exclude 404, header and footer from search results.  You can add anything else you need to exclude from search engines to this file.
humans.txt - use to explain who worked on the website.  You'll need to update this with your info.  You don't need this, but it's nice to know who worked on a website.
/assets/css/common - this folder is where all css files should go that get loaded on all pages of your website
/assets/css - this is where you'll put page specific css files.  For example, if you have a page called about.php and have css that is specific to ONLY the about page, create a file called with about.css in this folder with only that specific CSS.
/assets/js/common - this is where all JavaScript files should go that get loaded on all pages of your website
/assets/js - this is where you'll put page specific JavaScript.  For example if you have a page called about.php and you have JavaScript that is only specific to the about page, create a file called about.js in this folder with only that specific JavaScript. 
/assets/img - this is where you'll put all of your image files



