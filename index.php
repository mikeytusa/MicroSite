<?php

// if we're requesting a CSS file, try processing that
if (substr($_SERVER['REQUEST_URI'], -4) == '.css')
	return generate_css_file();

// is there a password file?
if (file_exists(__DIR__ . '/protect.php')) {
	// load the password file
	include(__DIR__ . '/protect.php');

	// if there's a password
	if (isset($password)) {
		// start a session
		session_name('MicroSite');
		session_start();

		// if we're not logged in
		if (!isset($_SESSION['authenticated'])) {
			// if our password has been entered
			if (isset($_POST['password'])) {
				// if it's correct
				if ($_POST['password'] == $password) {
					// save to the session
					$_SESSION['authenticated'] = true;

					// do a GET redirect back to the same page
					return header('Location: ' . $_SERVER['REQUEST_URI']);
				}

				// otherwise, wrong password
				else {
					$wrong_password = true;
				}
			}

			// if we're still not authenticated
			if (!isset($_SESSION['authenticated'])) {
				// change the page to password
				$page = '_password';
			}
		}
	}
}

// if the page is not set
if (!isset($page)) {
	// get the requested page, disallowing pages that begin with _
	$page = preg_replace('/(^\/*_*)|((\/)_+)|(\/+$)/', '$2', preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']));

	// no request? home page it is
	if (!$page)
		$page = 'home';

	// page doesn't exist? uh oh. 404!
	if (!file_exists('pages/' . $page . '.php'))
		$page = '_404';
}

// what includes should we have for this page?
determine_page_includes();

// output page
output_page();

// output page
function output_page() {
	global $page, $wrong_password, $import;

	// import variables?
	if (isset($import) && is_array($import))
		extract($import);

	// start output buffering
	ob_start();

	// include the content page
	include('pages/' . $page . '.php');

	// get the buffer into a variable
	// now we've got the content, and
	// any variables in the content file
	// have been loaded
	$_content = ob_get_clean();

	// is there a header/footer file prefix?
	$_prefix = isset($_category) ? $_category . '-' : '';

	// so, include the header, output the content,
	// and then output the footer
	include('pages/_' . $_prefix . 'header.php');
	echo $_content;
	include('pages/_' . $_prefix . 'footer.php');
}

// output any includes for the header
function output_header_includes($indent = '') {
	global $includes;
	$append = array();
	foreach ($includes['head']['css'] as $file)
		$append[] = '<link rel="stylesheet" type="text/css" href="' . get_absolute_path($file, '/assets/css/') . '">';
	foreach ($includes['head']['js'] as $file)
		$append[] = '<script type="text/javascript" src="' . get_absolute_path($file, '/assets/js/') . '"></script>';
	echo implode("\n" . $indent, $append);
}

// output any includes for the footer
function output_footer_includes($indent = '') {
	global $includes;
	$append = array();
	foreach ($includes['foot']['css'] as $file)
		$append[] = '<link rel="stylesheet" type="text/css" href="' . (substr($file, 0, 1) == '/' ? '' : '/assets/css/') . $file . '">';
	foreach ($includes['foot']['js'] as $file)
		$append[] = '<script type="text/javascript" src="' . (substr($file, 0, 1) == '/' ? '' : '/assets/js/') . $file . '"></script>';
	echo implode("\n" . $indent, $append);
}

// figure out what the includes should be
function determine_page_includes() {
	global $includes, $page, $def;

	// prepare an empty array for all the includes possibilities
	$includes = array(
		'head' => array(
			'css' => array(),
			'js' => array()
		),
		'foot' => array(
			'css' => array(),
			'js' => array()
		)
	);

	// if we have an includes definition file
	if (file_exists('includes.txt')) {
		// array to keep track of definitions
		$def = array();

		// some stuff to help us parse
		$nextLineIsBlockDef = true;
		$blockAppliesTo = array();
		
		// who knows what line endings its using, so hopefully PHP can figure it out
		ini_set('auto_detect_line_endings', true);

		// read the includes file and process each line
		foreach (file('includes.txt', FILE_IGNORE_NEW_LINES) as $line) {
			// strip off any whitespace
			$line = trim($line);

			// ignore comments
			if (substr($line, 0, 1) == '#')
				continue;

			// is this a blank line? if so, the next line is a new block definition
			if (!strlen($line)) {
				$nextLineIsBlockDef = true;
				$blockAppliesTo = array();
				continue;
			}

			// is this line part of a block definition?
			if ($nextLineIsBlockDef) {
				// if this line ends with a colon, the next line won't be a block definition
				if (substr($line, -1) == ':') {
					$nextLineIsBlockDef = false;
					$line = substr($line, 0, -1);
				}

				// break this line up by commas and add it to the block applies to array
				foreach (explode(',', $line) as $segment)
					if ($segment = trim($segment))
						$blockAppliesTo[] = $segment;

				// if the next line is not part a block definition
				if (!$nextLineIsBlockDef) {
					// set the definition index for the next block
					$blockIndex = count($def);

					// add this block definition
					$def[$blockIndex] = array(
						'appliesTo' => $blockAppliesTo,
						'includes' => array()
					);
				}

				// and we're done until we're out of the block def
				continue;
			}

			// add this line to the block
			$def[$blockIndex]['includes'][] = $line;
		}

		// if this page is in a subfolder
		if (strpos($page, '/')) {
			// break this page into folders
			$folders = explode('/', dirname($page));

			// add includes for each folder
			for ($index = 0, $count = count($folders); $index < $count; $index++)
				add_includes_for(implode('/', array_slice($folders, 0, $index + 1)) . '/');
		}

		// add includes for the page
		add_includes_for($page);
	}

	// how about page-specific CSS files?
	process_asset($page, 'css', 'head');
	process_asset($page . '-head', 'css', 'head');
	process_asset($page . '-foot', 'css', 'foot');
	process_asset($page, 'js', 'foot');
	process_asset($page . '-foot', 'js', 'foot');
	process_asset($page . '-head', 'js', 'head');

	// a folder full of CSS?
	if (file_exists($dir = 'assets/css/' . $page) && is_dir($dir))
		foreach (scandir($dir) as $file)
			if (substr($file, -4) == '.css' || substr($file, -5) == '.less')
				process_asset($page . '/' . $file, 'css', preg_match('/-foot\./', $file) ? 'foot' : 'head');

	// a folder full of JS?
	if (file_exists($dir = 'assets/js/' . $page) && is_dir($dir))
		foreach (scandir($dir) as $file)
			if (substr($file, -3) == '.js')
				process_asset($page . '/' . $file, 'js', preg_match('/-head\./', $file) ? 'head' : 'foot');
}

function process_asset($file, $type, $section) {
	global $includes;

	// do we have a minified version?
	if (file_exists('assets/' . $type . '/' . $file . '.min.' . $type))
		$file = $file . '.min.' . $type;

	// otherwise, if the file doesn't exist in the assets folder
	elseif (!file_exists('assets/' . $type . '/' . $file . '.' . $type))
		// if it's not CSS, or we don't have a LESS copy hanging around, bail
		if ($type != 'css' || !file_exists('assets/' . $type . '/' . $file . '.less'))
			return;

	// append the extension
	$file .= '.' . $type;

	// add file
	$includes[$section][$type][] = $file;
}

function add_includes_for($key) {
	global $includes, $def;
	static $includedIndexes;

	// set up included indexes array if it hasn't been set up yet
	if (!isset($includedIndexes))
		$includedIndexes = array();

	// loop through each definition
	foreach ($def as $index => &$block) {
		// if we've already included this index, don't do it again
		if (in_array($index, $includedIndexes))
			continue;

		// by default, we won't include this block
		$includeBlock = false;

		// but if we happen to find the key in this block's "applies to"
		// we will include it
		foreach ($block['appliesTo'] as $appliesTo)
			if ($key == $appliesTo)
				$includeBlock = true;

		// if we're not including it, skip to the next block
		if (!$includeBlock)
			continue;

		// add this index to the list of blocks we've included
		$includedIndexes[] = $index;

		// loop through the includes
		foreach ($block['includes'] as $include) {
			// a group?
			if (substr($include, 0, 1) == '@') {
				add_includes_for(substr($include, 1));
				continue;
			}

			// header/footer?
			$placement = null;
			if (in_array($firstChar = substr($include, 0, 1), array('>', '<'))) {
				$placement = $firstChar == '<' ? 'head' : 'foot';
				$include = trim(substr($include, 1));
			}

			// CSS?
			if (substr($include, -4) == '.css')
				$includes[$placement == 'foot' ? 'foot' : 'head']['css'][] = $include;
			elseif (substr($include, 0, 4) == 'css:')
				$includes[$placement == 'foot' ? 'foot' : 'head']['css'][] = substr($include, 4);

			// JS?
			elseif (substr($include, -3) == '.js')
				$includes[$placement == 'head' ? 'head' : 'foot']['js'][] = $include;
			elseif (substr($include, 0, 3) == 'js:')
				$includes[$placement == 'head' ? 'head' : 'foot']['js'][] = substr($include, 3);
		}
	}
}

function get_absolute_path($path, $folder) {
	if (substr($path, 0, 1) == '/' || substr($path, 0, 7) == 'http://' || substr($path, 0, 8) == 'https://')
		return $path;
	else
		return $folder . $path;
}

function generate_css_file() {
	if (!file_exists($file = preg_replace('/\.css$/', '.less', preg_replace('/^\//', '', $_SERVER['REQUEST_URI']))))
		return header('HTTP/1.1 404 File Not Found');
	if (file_exists('vendor/leafo/lessphp/lessc.inc.php'))
		require_once('vendor/leafo/lessphp/lessc.inc.php');
	elseif (file_exists('assets/lib/lessphp/lessc.inc.php'))
		require_once('assets/lib/lessphp/lessc.inc.php');
	else
		return header('HTTP/1.1 503 LESS Compiler Unavailable');
	header('Content-Type: text/css');
	$less = new lessc;
	echo $less->compileFile($file);
}

/* End! */