<?php
/**
*Plugin Name: Plugin Example
*Description: An Example plugin 
**/

function example_plugin_function(){
    $content = "this is a plugin";
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
        <div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible"><strong>Settings have been saved.</div>
        <?php
    }
    $header_scripts = get_option('example_header_scripts', 'none',);
    $footer_scripts = get_option('example_footer_scripts', 'none',);

    ?>
    <div class="wrap">
        <h2>Update Scripts on the header and footer.</h2>
        <form method="post" action="">
        <label for="header_scripts">Header Scripts</label>
        <textarea class="large-text"><?php print $header_scripts; ?></textarea>
        <label for="footer_scripts">Footer Scripts</label>
        <textarea class="large-text"><?php print $footer_scripts; ?></textarea>
        <input type="submit" name="submit_scripts_update" class="button button-primary" value="UPDATE SCRIPTS">
        </form>

    </div>
    <?php
}
?>  


