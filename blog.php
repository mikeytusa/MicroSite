<?php

$blog = new MicroBlog;
$blog->route();

class MicroBlog {
	public function route() {
		if ($_GET['cache'] == 'rebuild')
			$this->rebuildCache(true);
		elseif ($post = rtrim(preg_replace('/^\/blog\/?|\?.*$/', '', $_SERVER['REQUEST_URI']), '/'))
			$this->showPost($post);
		elseif (isset($_GET['ajax']))
			$this->getPosts();
		else
			$this->listPosts();
	}

	public function listPosts($cat = false) {
		global $page, $import;
		$page = 'blog/posts-list';
		$import = [
			'cat' => $cat,
			'posts' => $this->getPosts(false, $cat),
			'categories' => $this->getCategories()
		];
		require('index.php');
	}

	public function getPosts($output = true, $cat = false) {
		if (!file_exists('.blog-cache.json'))
			$this->rebuildCache();
		if (!file_exists('.blog-cache.json'))
			return [];
		$posts = json_decode(file_get_contents('.blog-cache.json'), true);
		$offset = isset($_GET['start']) && is_numeric($_GET['start']) && $_GET['start'] >= 0 ? $_GET['start'] : 0;
		$limit = isset($_GET['limit']) && is_numeric($_GET['limit']) && $_GET['limit'] >= 0 ? $_GET['limit'] : 10;
		if (isset($_GET['q']) && ($search = trim($_GET['q']))) {
			$result = [];
			foreach ($posts as $post) {
				if (stripos($post['excerpt'], $search) !== false)
					$result[] = $post;
				elseif (stripos($post['title'], $search) !== false)
					$result[] = $post;
				else {
					ob_start();
					include('pages/blog/posts/'. $post['permalink'] . '.php');
					$content = $this->stripContent(ob_get_clean());
					if (stripos($content, $search) !== false)
						$result[] = $post;
				}
			}
			$posts = $result;
		}
		elseif ($cat) {
			$result = [];
			foreach ($posts as $post)
				if (array_key_exists('category', $post))
					if ($post['category'] == $cat)
						$result[] = $post;
			$posts = $result;
		}
		$posts = array_slice($posts, $offset, $limit);
		if ($output) {
			header('Content-Type: application/json');
			echo json_encode($posts);
		} else {
			return $posts;
		}
	}

	public function showPost($post) {
		global $page, $import;
		if (!file_exists('pages/blog/posts/' . $post . '.php')) {
			if (file_exists('pages/blog/posts/' . $post)) {
				if (isset($_GET['ajax']))
					$this->getPosts(true, $post);
				else
					$this->listPosts($post);
			} else {
				$page = '_404';
				require('index.php');
			}
			return;
		}
		ob_start();
		include('pages/blog/posts/' . $post . '.php');
		$content = ob_get_clean();
		$page = 'blog/post';
		$categories = $this->getCategories();
		$import = get_defined_vars();
		require('index.php');
	}

	public function rebuildCache($feedback = false) {
		$cache = [];
		$this->scanDirectoryForCache($cache);
		usort($cache, function($a, $b) {
			if ($a['date'] == $b['date'])
				return 0;
			return $a['date'] < $b['date'] ? 1 : -1;
		});
		foreach ($cache as &$entry)
			$entry['date'] = date('F j, Y g:i a', $entry['date']);
		file_put_contents('.blog-cache.json', json_encode($cache));
		$feedback && print('OK');
	}

	private function getCategories() {
		$cats = [];
		$dh = opendir($base = 'pages/blog/posts');
		while ($file = readdir($dh)) {
			if ($file == '.' || $file == '..')
				continue;
			if (is_dir($base . '/' . $file))
				$cats[] = $file;
		}
		return $cats;
	}

	private function scanDirectoryForCache(&$cache, $dir = '') {
		$dh = opendir($base = 'pages/blog/posts/' . $dir);
		while ($file = readdir($dh)) {
			if ($file == '.' || $file == '..')
				continue;
			if (is_dir($base . '/' . $file)) {
				$this->scanDirectoryForCache($cache, $dir . $file . '/');
				continue;
			}
			$prevars = true;
			$prevars = get_defined_vars();
			ob_start();
			include($base . '/' . $file);
			$postvars = get_defined_vars();
			$content = ob_get_clean();
			$vars = [];
			foreach (array_keys($postvars) as $postkey)
				if (!array_key_exists($postkey, $prevars))
					$vars[$postkey] = $postvars[$postkey];
			foreach (array_keys($vars) as $key)
				unset($$key);
			if (!array_key_exists('excerpt', $vars)) {
				$vars['excerpt'] = $this->stripContent($content);
	            strlen($vars['excerpt']) > 150 && ($vars['excerpt'] = substr($vars['excerpt'], 0, 150) . '...');
	        }
	        $dir && ($vars['category'] = trim($dir, '/'));
            $vars['permalink'] = preg_replace('/\.php$/', '', $dir . $file);
            if (!array_key_exists('date', $vars))
            	continue;
            if (!($vars['date'] = strtotime($vars['date'])))
            	continue;
            $cache[] = $vars;
		}
	}

	private function stripContent($content) {
		return preg_replace('/\s+/', ' ', trim(strip_tags($content)));
	}
}