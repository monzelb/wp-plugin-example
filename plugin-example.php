<?php
/**
*Plugin Name: Plugin Example
*Description: An Example plugin 
**/

function example_plugin_function(){
    $info = "this is a plugin";
    return $info;
}

add_shortcode('example', 'example_plugin_function');

function example_admin_menu_option(){
    add_menu_page('Header & Footer scripts', 'Site scripts', 'manage_options', 'example-admin-menu', 'example_scripts_page', '', 200);
}

add_action('admin_menu', 'example_admin_menu_option');

function example_scripts_page(){

    if( array_key_exists('submit_scripts_update', $_POST) ){
        update_option('example_header_scripts', $_POST['header_scripts']);
        update_option('example_footer_scripts', $_POST['footer_scripts']);

        ?>
        <div id="setting-error-settings-updated" class="updated settings-error notice is-dismissible"><strong>Settings have been saved.</strong></div>
        <?php
    }
    $header_scripts = get_option('example_header_scripts', 'none',);
    $footer_scripts = get_option('example_footer_scripts', 'none',);

    ?>
    <div class="wrap">
        <h2>Update Scripts</h2>
        <form method="post" action="">
        <label for="header_scripts">Header Scripts</label>
        <textarea name="header_scripts" class="large-text"><?php print $header_scripts; ?></textarea>
        <label for="footer_scripts">Footer Scripts</label>
        <textarea name="footer_scripts" class="large-text"><?php print $footer_scripts; ?></textarea>
        <input type="submit" name="submit_scripts_update" class="button button-primary" value="UPDATE SCRIPTS">
        </form>

    </div>
    <?php
}

function example_display_header_scripts(){
    $header_scripts = get_option('example_header_scripts', 'none',);
    print $header_scripts;
}
add_action('wp_head', 'example_display_header_scripts');

function example_display_footer_scripts(){
    $footer_scripts = get_option('example_footer_scripts', 'none',);
    print $footer_scripts;
}
add_action('wp_footer', 'example_display_footer_scripts');

function example_form(){
    $content = '';
    $content .= '<form method="post" action="/wordpress/?p=49">';
    $content .= '<input type="text" name="phone_number">';
    $content .= '<input type="text" name="email">';
    $content .= '<input type="submit" name="example_submit_form">';
    $content .= '</form>';
    return $content;
}
add_shortcode('example_contact_form', 'example_form');

function set_html_content_type(){
    return 'text/html';
}

function example_form_capture(){
    global $post;
    if(array_key_exists('example_submit_form', $_POST)){
        $to = "monzelb@gmail.com";
        $subject = "got an email";
        $body = 'email: '.$_POST['email'];
        $body .= 'Phone Number: '.$_POST['phone_number'];

        add_filter('wp_mail_content_type', 'set_html_content_type');

        wp_mail($to, $subject, $body);

        remove_filter('wp_mail_content_type', 'set_html_content_type');

        /* Insert the info into a comment */

        $time = current_time('mysql');

        $data = array(
            'comment_post_ID' => $post->ID,
            'comment_content' => $body,
            'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
            'comment_date' => $time,
            'comment_approved' => 1            
        );
        wp_insert_comment($data);
    }
}
add_action('wp_head', 'example_form_capture' );
?>  


