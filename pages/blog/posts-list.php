<form class="search">
	<input type="text" name="q" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
	<input type="submit" value="Search">
</form>

<ul class="categories">
	<? foreach ($categories as $category): ?>
		<li><a href="/blog/<?= $category ?>"><?= ucwords(str_replace('-', ' ', $category)) ?></a></li>
	<? endforeach; ?>
</ul>

<?php foreach ($posts as $post): ?>
	<div class="post">
		<h2><a href="/blog/<?= $post['permalink'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
		<div class="excerpt"><?= htmlspecialchars($post['excerpt']) ?></div>
		<div class="date"><?= $post['date'] ?></div>
	</div>
<?php endforeach; ?>

<?php if (!count($posts)): ?>
	<div class="none">There are no posts matching your search criteria.</div>
<?php endif; ?>

<div class="post template">
	<h2><a class="permalink title"></a></h2>
	<div class="excerpt"></div>
	<div class="date"></div>
</div>