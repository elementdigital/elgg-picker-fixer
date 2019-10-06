<?php

elgg_register_event_handler('init', 'system', 'picker_fixer_init');

function picker_fixer_init() {
	
	elgg_extend_view('elgg.css', 'pickerfixer/css');
	
	elgg_unregister_js('elgg.friendspicker');
	elgg_register_js('elgg.friendspicker', elgg_get_simplecache_url('js/ui.friends_picker.js'));

}

?>