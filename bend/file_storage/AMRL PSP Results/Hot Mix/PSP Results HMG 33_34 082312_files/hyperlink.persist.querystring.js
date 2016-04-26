$(document).ready(function() {
    if ($("a.unorderedlistlink").length)
    {
        $("a.unorderedlistlink").wrap("<span class='unorderedlistlink'>");
    }
});