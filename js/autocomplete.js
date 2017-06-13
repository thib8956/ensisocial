$( function() {
	$( "#searchBar" ).autocomplete({
		source: '/ensisocial/recherche/userSearchAutocomplete.php',
		autoFocus : true,
		minLength: 1
	});
});
