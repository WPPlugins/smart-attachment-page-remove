<?php

/**
 * The smart Attachment Page Remove core plugin class
 */

 
// If this file is called directly, abort
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * The core plugin class
 */
if ( !class_exists( 'PP_Smart_Attachment_Page_Remove' ) ) { 

  class PP_Smart_Attachment_Page_Remove {
    
    public $plugin_name;
    public $plugin_slug;
    public $version;
    private $wp_url;
    private $my_url;
    private $dc_url;
    private $admin_handle;
    
    
    /**
	   * here we go
     */
    public function __construct( $file ) {
      $this->_file = $file;
      $this->plugin_name = 'smart Attachment Page Remove';
      $this->plugin_slug = 'smart-attachment-page-remove';
      $this->version = '1.1';
      $this->init();
    } 
    
    
    /**
     * do plugin init 
     */
    private function init() {
      
      $this->wp_url = 'https://wordpress.org/plugins/' . $this->plugin_slug;
      $this->my_url = 'http://petersplugins.com/free-wordpress-plugins/' . $this->plugin_slug;
      $this->dc_url = 'http://petersplugins.com/docs/' . $this->plugin_slug;
      
      add_action( 'wp', array( $this, 'remove_attachment_page' ) );
      add_action( 'init', array( $this, 'add_text_domain' ) );
      add_action( 'admin_menu', array( $this, 'adminmenu' ) );
      add_action( 'admin_head', array( $this, 'admin_css' ) );
      add_filter( 'plugin_action_links_' . plugin_basename( $this->_file ), array( $this, 'add_links' ) ); 
    }
    
    
    /**
     * send an 404 error if accessing an attachment page
     */
    function remove_attachment_page() {
      global $wp_query;
      if ( is_attachment() ) {
        $wp_query->set_404();
        status_header( 404 );
      }
    }
      
    
    /**
     * add text domain
     */
    function add_text_domain() {  
      load_plugin_textdomain( 'smart-attachment-page-remove' );
    }
    
    
    /**
     * init backend
     */
    function adminmenu() {
      $this->admin_handle = add_submenu_page( null, $this->plugin_name, $this->plugin_name, 'read', $this->plugin_slug, array( $this, 'show_info_page' ) );
    }

    
    /**
     * show info page
     */
    function show_info_page() {
      ?>    
      <div class="wrap">
        <h1 id="pp-plugin-info-smart-attachment-page-remove"><?php echo $this->plugin_name; ?><span><a class="dashicons dashicons-star-filled" href="https://wordpress.org/support/plugin/<?php echo $this->plugin_slug; ?>/reviews/" title="<?php _e( 'Please rate plugin', 'smart-attachment-page-remove' ); ?>"></a> <a class="dashicons dashicons-wordpress" href="<?php echo $this->wp_url; ?>/" title="<?php _e( 'wordpress.org plugin directory', 'smart-attachment-page-remove' ); ?>"></a> <a class="dashicons dashicons-admin-home" href="http://petersplugins.com/" title="<?php _e( 'Author homepage', 'smart-attachment-page-remove' );?>"></a> <a class="dashicons dashicons-googleplus" href="http://g.petersplugins.com/" title="<?php _e( 'Authors Google+ Page', 'smart-attachment-page-remove' ); ?>"></a> <a class="dashicons dashicons-facebook-alt" href="http://f.petersplugins.com/" title="<?php _e( 'Authors facebook Page', 'smart-attachment-page-remove' ); ?>"></a> <a class="dashicons dashicons-editor-help" href="http://wordpress.org/support/plugin/<?php echo $this->plugin_slug; ?>/" title="<?php _e( 'Support', 'smart-attachment-page-remove'); ?>"></a> <a class="dashicons dashicons-admin-comments" href="http://petersplugins.com/contact/" title="<?php _e( 'Contact Author', 'smart-attachment-page-remove' ); ?>"></a></span></h1>
        <?php settings_errors(); ?>
        
        <div class="postbox">
          <div class="inside">
            <p><strong><?php _e( 'This Plugin removes Attachment Pages from your Blog', 'smart-attachment-page-remove' ); ?></strong></p>
            <p><?php _e( 'There are no settings. When activated the plugin blocks access to all Attachment Pages.', 'smart-attachment-page-remove' ); ?></p>
          </div>
        </div>
        
      </div>
      <?php
    }
    
    
    /**
     * add links to plugins table
     */
    function add_links( $links ) {
      return array_merge( $links, array( '<a class="dashicons dashicons-admin-tools" href="' . menu_page_url( $this->plugin_slug, false ) . '" title="' . __( 'Show plugin info', 'smart-attachment-page-remove' ) . '"></a>', '<a class="dashicons dashicons-star-filled" href="https://wordpress.org/support/plugin/' . $this->plugin_slug . '/reviews/" title="' . __( 'Please rate plugin', 'smart-attachment-page-remove' ) . '"></a>' ) );
    }
    
    
    /**
     * add admin css
     */
    function admin_css() {
      if ( get_current_screen()->id == $this->admin_handle ) {
        echo '<style type="text/css">#pp-plugin-info-smart-attachment-page-remove{ min-height: 48px; line-height: 48px; vertical-align: middle; padding-left: 60px; background-image: url(' . plugins_url( 'assets/pluginicon.png', $this->_file ) .'); background-repeat: no-repeat; background-position: left center;}#pp-plugin-info-smart-attachment-page-remove span{float: right; padding-left: 50px;}#pp-plugin-info-smart-attachment-page-remove .dashicons{ vertical-align: middle; }#pp-plugin-info-smart-attachment-page-remove + .postbox{margin-top: 20px}</style>';
      }
    }
    
    // uninstall plugin
    // there's nothing to do on uninstall because we have not settings to delete
    // therefore there is no uninstall function

  }
}
 
?>