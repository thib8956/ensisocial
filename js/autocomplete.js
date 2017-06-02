$( function() {
    $( "#searchBar" ).autocomplete({
        source: 'userSearchAutocomplete.php'
        /*select: function (event, ui) {
            $("#searchBar").val(ui.item.label);
            $("#search").submit();
        }*/
    });

} );
