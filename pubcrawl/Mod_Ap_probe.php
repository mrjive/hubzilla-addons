<?php
namespace Zotlabs\Module;

require_once('include/zot.php');
//require_once('jsonld.php');

class Ap_probe extends \Zotlabs\Web\Controller {

	function get() {
	
		$o .= '<h3>ActivityPub Probe Diagnostic</h3>';
	
		$o .= '<form action="ap_probe" method="get">';
		$o .= 'Lookup URI: <input type="text" style="width: 250px;" name="addr" value="' . $_GET['addr'] .'" /><br>';
		$o .= 'Request Signed version: <input type=checkbox name="magenv" value="1" ><br>';
		$o .= '<input type="submit" name="submit" value="Submit" /></form>'; 
	
		$o .= '<br /><br />';
	
		if(x($_GET,'addr')) {
			$addr = $_GET['addr'];

			if($_GET['magenv']) {
				$headers = 'Accept: application/magic-envelope+json, application/activity+json, application/ld+json; profile="https://www.w3.org/ns/activitystreams"';
			}
			else {
				$headers = 'Accept: application/activity+json, application/ld+json; profile="https://www.w3.org/ns/activitystreams"';
			}

			$redirects = 0;
		    $x = z_fetch_url($addr,true,$redirects, [ 'headers' => [ $headers ]]);
	    	if($x['success'])
				$o .= '<pre>' . $x['header'] . '</pre>' . EOL;
				
				$o .= 'verify returns: ' . str_replace("\n",EOL,print_r(\Zotlabs\Web\HTTPSig::verify($x),true)) . EOL;

//				$normalized1 = jsonld_normalize(json_decode($x['body']),[ 'algorithm' => 'URDNA2015' ]);
//				$o .= var_export($normalized1,true); 

//				$o .= '<pre>' . json_encode($normalized1, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</pre>';


				$o .= '<pre>' . str_replace(['\\n','\\'],["\n",''],jindent($x['body'])) . '</pre>';
		}
		return $o;
	}
	
}
