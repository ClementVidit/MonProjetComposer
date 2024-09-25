<?php
/*
Plugin Name: Add Text To Footer
*/

// Hook the 'wp_footer' action hook, add the function named 'mfp_Add_Text' to it
add_action("wp_footer", "mfp_Add_Text");

// Define 'mfp_Add_Text'
function mfp_Add_Text()
{
    echo "<p style='color: black;'>After the footer is loaded, my text is added!</p>";
}
// Hook the 'init' action, which is called after WordPress is finished loading the core code, add the function 'remove_My_Meta_Tags'
add_action( 'init', 'remove_My_Meta_Tags' );

// Remove the 'add_My_Meta_Tags' function from the wp_head action hook
function remove_My_Meta_Tags()
{
    remove_action( 'wp_head', 'add_My_Meta_Tags');
}


// Hook the 'wp_footer' action, run the function named 'mfp_Add_Text()'
add_action("wp_footer", "mfp_Add_Text");

// Hook the 'wp_head' action, run the function named 'mfp_Remove_Text()'
add_action("wp_head", "mfp_Remove_Text");

// Define the function named 'mfp_Add_Text('), which just echoes simple text

// Define the function named 'mfp_Remove_Text()' to remove our previous function from the 'wp_footer' action
function mfp_Remove_Text()
{
    if (date("l") === "Monday") {
        // Target the 'wp_footer' action, remove the 'mfp_Add_Text' function from it
        remove_action("wp_footer", "mfp_Add_Text");
    }
}// Hook the 'the_content' filter hook (content of any post), run the function named 'mfp_Fix_Text_Spacing'
add_filter("the_content", "mfp_Fix_Text_Spacing");

// Automatically correct double spaces from any post
function mfp_Fix_Text_Spacing($the_Post)
{
    $the_New_Post = str_replace("  ", " ", $the_Post);

    return $the_New_Post;
}

/*
Plugin Name: Add Excerpt
*/

// Hook the get_the_excerpt filter hook, run the function named mfp_Add_Text_To_Excerpt
add_filter("get_the_excerpt", "mfp_Add_Text_To_Excerpt");

// Take the excerpt, add some text before it, and return the new excerpt
function mfp_Add_Text_To_Excerpt($old_Excerpt)
{
    $new_Excerpt = "<b>Excerpt: </b>" . $old_Excerpt;
    return $new_Excerpt;
}
// Hook the get_the_excerpt filter hook, run the function named mfp_Add_Text_To_Excerpt
add_filter("get_the_excerpt", "mfp_Add_Text_To_Excerpt");

// If today is a Thursday, remove the filter from the_excerpt()
if (date("l") === "Thursday") {
    remove_filter("get_the_excerpt", "mfp_Add_Text_To_Excerpt");
}

// Take the excerpt, add some text before it, and return the new excerpt
