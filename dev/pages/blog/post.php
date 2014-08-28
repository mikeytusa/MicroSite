<ul class="categories">
	<? foreach ($categories as $category): ?>
		<li><a href="/blog/<?= $category ?>"><?= ucwords(str_replace('-', ' ', $category)) ?></a></li>
	<? endforeach; ?>
</ul>

<div class="post">
	<h2><?= htmlspecialchars($title) ?></h2>
	<div class="date"><?= $date ?></div>
	<div class="content">
		<?= $content ?>
	</div>
</div>