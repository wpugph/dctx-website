<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
	<h2><label for="s">Search</label></h2>
	<input type="search" id="s" placeholder="Enter search term..." value="<?php echo get_search_query() ?>" name="s">
</form>
