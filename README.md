<pre>

    _/      _/  _/                                  _/_/_/  _/    _/    
   _/_/  _/_/        _/_/_/  _/  _/_/    _/_/    _/            _/_/_/_/    _/_/
  _/  _/  _/  _/  _/        _/_/      _/    _/    _/_/    _/    _/      _/_/_/_/
 _/      _/  _/  _/        _/        _/    _/        _/  _/    _/      _/      
_/      _/  _/    _/_/_/  _/          _/_/    _/_/_/    _/      _/_/    _/_/_/

</pre>
=========

<h2>MicroSite : A simple but powerful static web framework for your static web projects.</h2>

MicroSite is a very small framework for building static websites.  It does not depend on any particular UI or backend framework and doesn't require a database.  It supports Bower and Grunt for rapid development and deployment, however these tools are not required. If you do not want to use Bower and Grunt, just clone the repository and copy everything from the /dev directory into your project root.

<h4>What does it require?</h4>
<ul>
  <li>Apache Web Server</li>
  <li>PHP</li>
  <li><a href="http://bower.io">Bower</a> (not required by very useful)</li>
  <li><a href="http://gruntjs.com">Grunt</a> (not required by very useful)</li>
</ul>

MicroSite is meant to be a quick starting point for building static websites from scratch.  You can use whatever frontend frameworks you want. Just add in their required dependancies as well as any JavaScript frameworks you'd like to work with using the bower.json file.

<h4>Getting Started</h4>

The first thing you're going to want to do is clone the repository into the root directory of your project.  You can do this by opening Terminal (Mac) or Powershell (Windows) and 'cd'ing to your project directory.  Then just type "git clone git@github.com:mikeytusa/MicroSite.git".  As previously mentioned, if you don't want to use Bower and Grunt, you'll want to move everything in the /dev directory into your root folder and remove the Gruntfile.js, bower.json and packages.json files.

To make life a million times easier, Microsite uses Bower for managing dependencies.  What's a dependency you might ask?  jQuery, Twitter Bootstrap or any other libraries you like to use to build out your project.  Let's make sure you've got Bower installed before we proceed.

Bower and Grunt both require NodeJS to function, so the first thing you'll want to do is install NodeJS.  Head over to <a href="http://nodejs.org">nodejs.org</a> and download NodeJS for your platform of choice.  It will install everything automatically for you.  There's not much you have to do for this step.

Awesome!  Now that you've got NodeJS installed, let's install Bower and the Grunt CLI.  There's very simple instructions for doing this on Bower and Grunt's website.  Open up Terminal/Powershell again.

To install Bower type "npm install -g bower".  The "-g" means "globally" so you're installing Bower in a manner that allows you to use it from any directory.  You're done with Bower.  Wasn't that easy?

To install the Grunt CLI, in Terminal/Powershell type "npm install -g grunt-cli".  Bitchin'!  You've just installed Grunt globally as well.  Now we're ready to start making some magic.

<h4>Understanding Bower</h4>

Bower manages your projects dependencies.  I recommend you spend a few minutes on the Bower website reviewing how it works and what it does.  It's really simple once you've used it for a bit.  The bower.json file in your project root is where you can add your project dependencies manually.  Or from Terminal/Powershell you can do things like "bower install bootstrap --save-dev" and it will download Twitter Bootstrap for you as well as automatically add the dependency to your bower.json file.  It gets added automatically because of the "--save-dev" you added at the end of the command.  I won't spend too much time on this as the Bower website does a great job explaining how it works.

<h4>Understanding Grunt</h4>

I'll just start off by saying Grunt is fucking awesome.  It's a very capable tool that can save you a ton of time if you use it right.

The Gruntfile.js file located in your project root contains some JSON that runs various jobs when building your production website.  You'll notice when you cloned MicroSite that the main project files are in a directory called "dev".  That's the directory you'll be working of as you build your site locally.  The "dev" directory DOES NOT get uploaded to your server and is not a production website.  Once you're ready to build your production site, Grunt will handle it all for you automatically.  Grunt will, create a "prod" folder, copy over all of the files from the "dev" directory, minify your LESS/CSS in the /assets/css directory, lint your JS and minify that JS in the /assets/js directory, optimize your images in /assets/img directory, convert any LESS files you're using into minified CSS and copy over your libraries into /assets/lib -- all by typing the word "grunt" into Terminal/Powershell.

But before we do that, let's install our dependencies and required Grunt packages.

CD into your working local directory.
Type "bower install" - this is going to install Bootstrap and jQuery as defined in the bower.json file.
Next type "npm install" - this is going to install the Grunt packages we need into a folder called "node_modules" in our project root.  These dependencies are in the "package.json" file.
Once that is done, type "grunt" - this is going to do a bunch of awesomeness.  It's going to read our Gruntfile.js and perform the commands we told it to do like building a "prod" folder, minifying our CSS/JS, optimizing our images, etc.
Once this is done you'll notice you now have a "prod" folder in the root of your website.  This is what you'll upload to your production server.

<h4>MicroSite File Descriptions:</h4>

<ul>
  <li><strong>index.php</strong> - this file is responsible for including your header and footer on each or serving up a 404 page if no page is found</li>
  <li><strong>protect.php</strong> <em>(optional)</em> - this file is used to password protect your site. Rename <em>password.sample.php</em> to <em>password.php</em> and set a new password.
  <li><strong>pages/</strong> - this folder contains all of your pages. You can create folders to stay organized.
    <ul>
      <li><strong>_header.php</strong> - this will be your websites header file</li>
      <li><strong>_footer.php</strong> - this is your websites footer file</li>
      <li><strong>_404.php</strong> - this is your websites 404 page</li>
      <li><strong>_password.php</strong> - this is the page displayed when your site is password protected</li>
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
  <li><strong>assets/img/</strong> - this is where you'll put all of your image files.  Make sure you put all of them in this directory as Grunt will optimize all of your images for you when you run the "grunt" command from Terminal/Powershell.</li>
</ul>

<h4>Includes</h4>

The includes system is simple, but powerful. There are numerous ways you can include JavaScript and CSS files automatically:

<ul>
  <li>
    <h5>Automatic per-page includes</h5>
    <p>If you have a page with the filename <strong>about.php</strong>, you can create an <strong>about.js</strong> file in <strong>assets/js</strong> and/or an <strong>about.css</strong> file in <strong>assets/css</strong> and they will be automatically loaded.</p>
    <p>Alternatively, you can create a folder by the name of the page (in this example, <strong>about</strong>) in the appropriate assets directory and all of the files within that folder will be loaded.</p>
    <p>By default, CSS files are loaded in the header and JavaScript files in the footer. You can change this behavior by appending <strong>-head</strong> or <strong>-foot</strong> to any filename (before the extension, of course) and it will be loaded in the correct place.</p>
  </li>
  <li>
    <h5>includes.txt file</h5>
    <p>The includes.txt file can be used to simplify the loading of additional libraries on specific pages, such as a form validation script on just pages using forms. The includes-examples.txt details all the possible scenarios this configuration file supports.  It can support pretty much any scenario you can throw at it.</p>
  </li>
</ul>

<h4>Sitemap Generator</h4>

There isn't anything you need to do to get the sitemap generator working.  It works out of the box.  The sitemap.php file is what you'll give to Google Webmaster Tools and any other places you submit your sitemaps.  It will exclude all files you specify in your robots.txt file from the generated sitemap so make sure to keep your robots.txt file updated with any files or folders you do not want to be indexed.  It will also exclude any PHP file whose name begins with an underscore. Thus, your header, footer, and 404 pages are automatically excluded.

<h4>Blog</h4>

The blog allows you to create blog entries with an automatic index, search, categories, and a standardized post template. Simply create pages in the <strong>pages/blog</strong> folder, just as you do any other page. Every time you create or change a page, you should rebuild the cache by visiting <strong>/blog/?cache=rebuild</strong>. The variables included in each post will be included in the cache, and you may use these variables on your posts list and post template pages.
