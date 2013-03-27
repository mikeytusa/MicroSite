<!-- This is where all of your fancy footer code will go. -->



<!-- Let's load up some javascript, shall we? --> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
<!-- This is where you'll add the rest of your JavaScript libraries --> 

<!-- Page specific JS -->
<? if (file_exists('assets/js/' . $page . '.js')): ?>
<script src="/assets/js/<?= $page ?>.js"></script>
<? endif; ?>

</body>

</html>