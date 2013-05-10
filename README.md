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

<h4>What does it require?</h4>
<ul>
  <li>PHP</li>
  <li>Apache Web Server</li>
</ul>

MicroSite is meant to be a quick starting point for building static websites from scratch.  You can use whatever frontend frameworks you want. Just add in their required dependancies as well as any Javascript frameworks you'd like to work with.

<h4>Required Files:</h4>

<ul>
  <li><strong>index.php</strong> - this file is responsible for including your header and footer on each or serving up a 404 page if no page is found</li>
  <li><strong>pages/</strong> - this folder contains all of your pages. You can create folders to stay organized.
    <uL>
      <li><strong>_header.php</strong> - this will be your websites header file</li>
      <li><strong>_footer.php</strong> - this is your websites footer file</li>
      <li><strong>_404.php</strong> - this is your websites 404 page</li>
      <li><strong>home.php</strong> - this is your home page, from which you can base all of your other pages</li>
    </ul>
</ul>

<h4>File Descriptions:</h4>

<ul>
  <li><strong>.htaccess</strong> - for removing .php from all URL's.  Make sure this doesn't get removed.</li>
  <li><strong>favicon.ico</strong> - this is just a sample favicon.  Replace it with your own.</li>
  <li><strong>robots.txt</strong> - used to exclude 404, header and footer from search results.  You can add anything else you need to exclude from search engines to this file.</li>
  <li><strong>humans.txt</strong> - use to explain who worked on the website.  You'll need to update this with your info.  You don't need this, but it's nice to know who worked on a website.</li>
  <li><strong>includes.txt</strong> - use this to automatically load JavaScript and CSS libraries on your pages. See below for details.
  <li><strong>assets/css/common/</strong> - this folder is where all css files should go that get loaded on all pages of your website</li>
  <li><strong>assets/css/</strong> - this is where you'll put page specific css files.  See below for more details.</li>
  <li><strong>assets/js/common/</strong> - this is where all JavaScript files should go that get loaded on all pages of your website</li>
  <li><strong>assets/js/</strong> - this is where you'll put page specific JavaScript.  See below for more details.</li>
  <li><strong>assets/img/</strong> - this is where you'll put all of your image files</li>
</ul>

<h4>Includes</h4>

The includes system is simple, but powerful. There are two ways you can include JavaScript and CSS files:

<ul>
  <li>
    <h5>Automatic per-page includes</h5>
    <p>If you have a page with the filename <strong>about.php</strong>, you can create an <strong>about.js</strong> file in <strong>assets/js</strong> and/or an <strong>about.css</strong> file in <strong>assets/css</strong> and they will be automatically loaded.</p>
    <p>Alternatively, you can create a folder by the name of the page (in this example, <strong>about</strong>) in the appropriate assets directory and all of the files within that folder will be loaded.</p>
    <p>By default, CSS files are loaded in the header and JavaScript files in the footer. You can change this behavior by appending <strong>-head</strong> or <strong>-foot</strong> to any filename (before the extension, of course) and it will be loaded in the correct place.</p>
  </li>
  <li>
    <h5>includes.txt file</h5>
    <p>The includes.txt file can be used to simplify the loading of additional libraries on specific pages, such as a form validation script on just pages using forms. The includes-examples.txt details all the possible scenarios this configuration file supports.</p>
  </li>
</ul>

<h4>Sitemap Generator</h4>

There isn't anything you need to do to get the sitemap generator working.  It should work out of the box.  The sitemap.php file is what you'll give to Google Webmaster Tools and any other places you submit your sitemaps.  It will exclude all files you specify in your robots.txt file from the generated sitemap so make sure to keep your robots.txt file updated with any files or folders you do not want to be indexed.  It will also exclude any PHP file whose name begins with an underscore. Thus, your header, footer, and 404 pages are automatically excluded.

<h4>Thanks!</h4>

Special thanks to Sean Ferguson from Signal24 for helping out with the concept and <strike>some</strike> all of the PHP.
