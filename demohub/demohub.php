<?php
/**
 *
 * Name: Demo Hub
 * Description: Supports automatic authentication as a demo hub channel
 * Version: 1.0
 * Depends: Core
 * Recommends: None
 * Category: System
 * Author: Andrew Manning <andrew@reticu.li>
 * Maintainer: Andrew Manning <andrew@reticu.li>
 */


function demohub_load(){
	register_hook('page_end', 'addon/demohub/demohub.php', 'demohub_page_end');
}


function demohub_unload(){
	unregister_hook('page_end', 'addon/demohub/demohub.php', 'demohub_page_end');
}

function demohub_module() {}

function demohub_init($a) {
	
}

function demohub_content($a) {
	
	$o .= replace_macros(get_markup_template('demohub_launch.tpl', 'addon/demohub'), array(
		'$redirect' => t('Logging to demo channel...')		
		));

	return $o;
}

function demohub_page_end(&$a,&$b) {
	$b .= replace_macros(get_markup_template('demohub_dialog.tpl', 'addon/demohub'), array(
		'$title' => t('Welcome to the Hubzilla demo hub!'),
		'$paragraph_1' => t('This demo hub is designed to give you a chance to explore some of the features offered by the Hubzilla platform. The activities of the fictional characters illustrate only a few of the ways communities can use Hubzilla to collaborate and connect.'),
		'$paragraph_2' => t('To really grasp what Hubzilla is offering in terms of nomadic identity and decentralized access control, you have to try it for yourself. Run your own hub or register on an open hub. You can always clone your channels and migrate to another hub later. With Hubzilla, <i>you</i> not only own your <b>data</b>, but your <b>identity</b> as well!</p><p>The demo resets every ten minutes, which may interrupt your session. Simply reload the page as necessary. You can return to this dialog using the blue info button in the navbar.'),
		'$exploreBtn' => t('Explore')
		));
	$b .= '<script type="text/javascript" src="' . z_root() . '/addon/demohub/view/js/demohub.js"></script>'."\r\n";

}