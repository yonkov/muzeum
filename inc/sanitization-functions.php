<?php 

//checkbox sanitization function
function muzeum_sanitize_checkbox($checked) {
    // Boolean check.
    return ((isset($checked) && true == $checked) ? true : false);
}