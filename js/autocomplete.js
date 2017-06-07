$( function() {
    $( "#searchBar" ).autocomplete({
        source: '/ensisocial/recherche/userSearchAutocomplete.php'
        /*select: function (event, ui) {
            $("#searchBar").val(ui.item.label);
            $("#search").submit();
        }*/
    });

} );
