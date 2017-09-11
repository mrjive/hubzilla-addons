$(document).ready(function(){
	if (typeof(homebase) === 'undefined') {
		if (confirm("Automatically log in as demo channel?\n\nusername: demo\npassword:hubzillademo")) {
			window.location = '/demohub';
		}
	}
	
	$('<li class="">\n\
		<a class="demohub-help-btn nav-item" target="demohubHelpModal" href=#demohubHelpModal" title="Demo help" \n\
		onclick="$(\'#demohubHelpModal\').modal(); return false;"><i class="fa fa-info" style="color: white; background-color:#3A87AD;"></i></a>\n\
		</li>').appendTo('#navbar-collapse-1 .nav-right');
	
	$('<button class="navbar-toggle border-0 demohub-help-btn" type="button" onclick="$(\'#demohubHelpModal\').modal(); return false;">\n\
			<i class="fa fa-info" style="color: white; background-color:#3A87AD;"></i>\n\
		</button>').appendTo('nav .navbar .navbar-toggler-right');
	
	$('.demohub-help-btn').css('background-color', '#3A87AD');
	// Save data to sessionStorage

	var parser = document.createElement('a');
	parser.href = window.location;
	// Get saved data from sessionStorage
	if (sessionStorage.getItem('demohub-intro') !== '1' && parser.pathname.search('network') > 0) {
		sessionStorage.setItem('demohub-intro', '1');
		$('#demohubHelpModal').modal();
	}
});
