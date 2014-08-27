$(function() {
	var isLoading = false, start = 10;
	var canLoadMore = $('.post').not('.template').length >= start;

	var $document = $(document);
	var $window = $(window);
	$window.scroll(__handleScroll);

	function __handleScroll() {
		if (isLoading || !canLoadMore)
			return;

		if ($document.height() - $window.scrollTop() <= $window.height())
			__loadMore();
	}

	function __loadMore() {
		console.log('loading at', start);
		isLoading = true;
		$.ajax({
			url: '/blog/',
			data: {
				ajax: 'yes',
				start: start
			},
			dataType: 'json',
			success: __handleLoad
		});
	}

	function __handleLoad(result) {
		$.each(result, function(index, post) {
			var $post = $('.post.template').clone().removeClass('template').insertBefore('.post.template');
			$post.find('.permalink').attr('href', post.permalink);
			$post.find('.title').text(post.title);
			$post.find('.excerpt').text(post.excerpt);
			$post.find('.date').text(post.date);
		});
		start += result.length;
		canLoadMore = result.length == 10;
		isLoading = false;
	}
});