///----------------------------------
/// This handles the zebra-striping of grids and libraryGrids
///==================================
$(document).ready(function() {
    $("table.grid tr:even").addClass("alt");
    $("table.sf_libraryGrid tr:even").addClass("alt");
});

///----------------------------------
/// This handles the login modal.
///==================================
$(document).ready(function() {
    //Examples of how to assign the ColorBox event to elements
    $("#loginlink").click(function() {
        $("#loginForm").slideDown();
        return false;
    });
    $("#logincancel").click(function() {
        $("#loginForm").slideUp();
        return false;
    });
});