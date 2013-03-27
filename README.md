<pre>
                                                                                   
    _/      _/  _/                                  _/_/_/  _/    _/               
   _/_/  _/_/        _/_/_/  _/  _/_/    _/_/    _/            _/_/_/_/    _/_/    
  _/  _/  _/  _/  _/        _/_/      _/    _/    _/_/    _/    _/      _/_/_/_/   
 _/      _/  _/  _/        _/        _/    _/        _/  _/    _/      _/          
_/      _/  _/    _/_/_/  _/          _/_/    _/_/_/    _/      _/_/    _/_/_/     
                                                                                   
                                                                                                                   
</pre>
=========

<h2>MicroSite : A tiny, static website framework for your tiny, static websites.</h2>

MicroSite is a very small framework for building static websites.  It does not depend on any particular UI or backend framework and doesn't require a database.

<strong>What does it require?</strong>
<ul>
  <li>PHP</li>
  <li>Apache Web Server</li>
</ul>

MicroSite is meant to be a quick starting point for building static websites from scratch.  You can use whatever frontend frameworks you want just added in their required dependancies as well as any Javascript framworks you'd like to work with.

<strong>Five pages have been created for reference and to serve as a starting point:</strong>

<ul>
  <li>index.php - this file is responsible for including your header and footer on each or serving up a 404 page if no page is found.</li>
  <li>header.php - this will be your websites header file</li>
  <li>footer.php - this is your websites footer file</li>
  <li>404.php - this is your websites 404 page</li>
  <li>home.php - this is your home page.  You'll want to copy this file for all of your other pages.</li>
</ul>

<strong>File Descriptions:</strong>

<ul>
  <li><strong>.htaccess</strong> - for removing .php from all URL's.  Make sure this doesn't get removed.</li>
  <li><strong>favicon.ico</strong> - this is just a sample favicon.  Replace it with your own.</li>
  <li><strong>robots.txt</strong> - used to exclude 404, header and footer from search results.  You can add anything else you need to exclude from search engines to this file.</li>
  <li><strong>humans.txt</strong> - use to explain who worked on the website.  You'll need to update this with your info.  You don't need this, but it's nice to know who worked on a website.</li>
  <li><strong>/assets/css/common</strong> - this folder is where all css files should go that get loaded on all pages of your website</li>
  <li><strong>/assets/css</strong> - this is where you'll put page specific css files.  For example, if you have a page called about.php and have css that is specific to ONLY the about page, create a file called with about.css in this folder with only that specific CSS.</li>
  <li><strong>/assets/js/common</strong> - this is where all JavaScript files should go that get loaded on all pages of your website</li>
  <li><strong>/assets/js</strong> - this is where you'll put page specific JavaScript.  For example if you have a page called about.php and you have JavaScript that is only specific to the about page, create a file called about.js in this folder with only that specific JavaScript.</li>
  <li><strong>/assets/img</strong> - this is where you'll put all of your image files</li>



