<?php
    /**
     * Plugin Name: WordPress Site Settings Plugin
     * Description: This plugin provides an easy way to adjust important website/company information. Plugin originally created by <a href="https://ryanfitton.co.uk">Ryan Fitton</a>.
     * Plugin URI:  https://ryanfitton.co.uk/blog/wordpress-site-settings-plugin/
     * Version:     1.0.0
     * Author:      Ryan Fitton
     * Author URI:  https://ryanfitton.co.uk
     * License:     CC Attribution 4.0 International
     * License URI: https://creativecommons.org/licenses/by/4.0/
     * Text Domain: wordpress
     * Domain Path: /languages
     * Network:     false
     */


    /*
     * Access the stored data in your theme by using 'get_option'.
     * 
     *  get_option('ws_contact_address');
     *  get_option('ws_contact_telephone');
     *  get_option('ws_contact_email');
     *  get_option('ws_footer_information');
     *  get_option('ws_meta_keywords');
     *
     */





    /*
     * Add additional links on the plugin page
     */
    //Settings Link
    function website_settings_plugin_add_link( $links ) {
        $settings_link = '<a href="admin.php?page=website-settings">' . __( 'Settings' ) . '</a>';
        array_push( $links, $settings_link );
        return $links;
    }
    $plugin = plugin_basename( __FILE__ );
    add_filter( "plugin_action_links_$plugin", 'website_settings_plugin_add_link' );

    //Add META Links to plugin page
    function website_settings_plugin_add_meta_link( $links, $file ) {
        $plugin = plugin_basename(__FILE__);

        if ( $file == $plugin ) {
            return array_merge(
                $links,
                array(
                    '<a href="https://ryanfitton.co.uk/blog/wordpress-site-settings-plugin/">Support</a>',
                    '<a href="https://creativecommons.org/licenses/by/4.0/">License</a>'
                )
            );
        }
        return $links;
    }
    add_filter( 'plugin_row_meta', 'website_settings_plugin_add_meta_link', 10, 2 );





    /**
     * Proper way to enqueue scripts and styles
     */
    function website_settings_includes() {
        wp_enqueue_style( 'website-settings-plugin-style', plugins_url( '/style.css', __FILE__ ) );
    }
    add_action('admin_enqueue_scripts', 'website_settings_includes');





    /*
     * Show in menu bar
     */ 
    function add_new_menu_items() {
        //Add a new menu item. This is a top level menu item i.e., this menu item can have sub menus
        add_menu_page(
            "Website Settings",         //Required. Text in browser title bar when the page associated with this menu item is displayed.
            "Website Settings",         //Required. Text to be displayed in the menu.
            "manage_options",           //Required. The required capability of users to access this menu item.
            "website-settings",         //Required. A unique identifier to identify this menu item.
            "website_settings_page",    //Optional. This callback outputs the content of the page associated with this menu item.
            "",                         //Optional. The URL to the menu item icon.
            100                         //Optional. Position of the menu item in the menu.
        );
    }





    /*
     * The settings page
     */ 
    function website_settings_page()
    {
    ?>
        <div class="wrap">
            <form method="post" action="options.php">
                <?php
                    //Add_settings_section callback is displayed here. For every new section we need to call settings_fields.
                    settings_fields("settings_section");
                    
                    //All the add_settings_field callbacks is displayed here
                    do_settings_sections("theme-options");
                
                    //Add the submit button to serialize the options
                    submit_button(); 
                ?>
            </form>
        </div>
        <?php
    }

    //this action callback is triggered when wordpress is ready to add new items to menu.
    add_action("admin_menu", "add_new_menu_items");





    /*
     * Setup display of fields
     */ 
    function display_options()
    {
        //Section Header
        add_settings_section("settings_section", "Website Settings", "display_header_options_content", "theme-options");

        //Add fields
        add_settings_field("ws_contact_address", "Business Address", "display_page_ws_contact_address_form_element", "theme-options", "settings_section");
        add_settings_field("ws_contact_telephone", "Contact Telephone Number", "display_page_ws_contact_telephone_form_element", "theme-options", "settings_section");
        add_settings_field("ws_contact_email", "Contact Email Address", "display_page_ws_contact_email_form_element", "theme-options", "settings_section");
        add_settings_field("ws_footer_information", "Footer Information", "display_page_ws_footer_information_form_element", "theme-options", "settings_section");
        add_settings_field("ws_meta_keywords", "META Keywords<br>(Entire website)", "display_page_ws_meta_keywords_form_element", "theme-options", "settings_section");

        //Register fields
        register_setting("settings_section", "ws_contact_address");
        register_setting("settings_section", "ws_contact_telephone");
        register_setting("settings_section", "ws_contact_email");
        register_setting("settings_section", "ws_footer_information");
        register_setting("settings_section", "ws_meta_keywords");
    }

    //Display text in the section
    function display_header_options_content() {
        echo "These settings allow you to customise specific areas of your website.";
    }





    /*
     * Render Elements
     */ 
    function display_page_ws_contact_address_form_element() {
    ?>
        <textarea name="ws_contact_address" id="ws_contact_address" rows="4" cols="50" class="ws_website_settings_textarea"><?php echo esc_attr( get_option('ws_contact_address') ); ?></textarea>
    <?php
    }
    function display_page_ws_contact_telephone_form_element() {
    ?>
        <input type="text" name="ws_contact_telephone" id="ws_contact_telephone" class="ws_website_settings_input" value="<?php echo esc_attr( get_option('ws_contact_telephone') ); ?>" />
    <?php
    }
    function display_page_ws_contact_email_form_element() {
    ?>
        <input type="email" name="ws_contact_email" id="ws_contact_email" class="ws_website_settings_input" value="<?php echo esc_attr( get_option('ws_contact_email') ); ?>" />
    <?php
    }
    function display_page_ws_footer_information_form_element() {
    ?>
        <textarea name="ws_footer_information" id="ws_footer_information" rows="4" cols="50" class="ws_website_settings_textarea"><?php echo esc_attr( get_option('ws_footer_information') ); ?></textarea>
    <?php
    }
    function display_page_ws_meta_keywords_form_element() {
    ?>
        <textarea name="ws_meta_keywords" id="ws_meta_keywords" rows="4" cols="50" class="ws_website_settings_textarea"><?php echo esc_attr( get_option('ws_meta_keywords') ); ?></textarea>
    <?php
    }





    //This action is executed after loads its core, after registering all actions, finds out what page to execute and before producing the actual output(before calling any action callback)
    add_action("admin_init", "display_options");
?>