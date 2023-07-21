<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://tirony.me
 * @since      1.0.0
 *
 * @package    Darkpress
 * @subpackage Darkpress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Darkpress
 * @subpackage Darkpress/admin
 * @author     t.i.rony <sefsd@sdfasdf.com>
 */
class Darkpress_Admin
{

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string $plugin_name The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string $version The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @param string $plugin_name The name of this plugin.
   * @param string $version The version of this plugin.
   * @since    1.0.0
   */
  public function __construct($plugin_name, $version)
  {

    $this -> plugin_name = $plugin_name;
    $this -> version     = $version;

  }

  public function enqueue_styles()
  {
    wp_enqueue_style($this -> plugin_name, plugin_dir_url(__FILE__) . 'css/darkpress-admin.css', array(), $this -> version, 'all');
    wp_enqueue_style('wp-color-picker');
  }

  public function enqueue_scripts()
  {
    wp_enqueue_script($this -> plugin_name, plugin_dir_url(__FILE__) . 'js/darkpress-admin.js', array('jquery', 'wp-color-picker'), $this -> version, true);
  }

  public function darkpress_admin_menu_callback()
  {
    add_menu_page('Dark Press Settings', 'DarkPress', 'manage_options', 'darkpress_settings', [$this, 'darkpress_option_page_callback'],);
  }

  public function darkpress_plugin_links_callback($links)
  {
    $settings_link = '<a href="admin.php?page=darkpress_settings&tab=general_settings">' . __('Settings') . '</a>';
    array_push($links, $settings_link);
    return $links;
  }

  public function darkpress_activated_redirect_callback($plugins)
  {
    if ( $plugins == DARKPRESS_BASE_NAME ) {
      wp_redirect(admin_url('admin.php?page=darkpress_settings&tab=general_settings'));
      exit();
    }
  }

  public function darkpress_option_page_callback()
  {

    ?>
    <div class="wrap">
      <?php
      $active_tab = isset($_GET[ 'tab' ]) ? $_GET[ 'tab' ] : 'general_settings';
      ?>

      <h2 class="nav-tab-wrapper">
        <a href="?page=darkpress_settings&tab=general_settings"
           class="nav-tab <?php echo $active_tab == 'general_settings' ? 'nav-tab-active' : ''; ?>">General Settings</a>
        <a href="?page=darkpress_settings&tab=color_settings"
           class="nav-tab <?php echo $active_tab == 'color_settings' ? 'nav-tab-active' : ''; ?>">Color Settings</a>
        <a href="?page=darkpress_settings&tab=other_settings"
           class="nav-tab <?php echo $active_tab == 'other_settings' ? 'nav-tab-active' : ''; ?>">Other Settings</a>
      </h2>
      <form action="options.php" method="post">
        <?php
        if ( $active_tab == 'color_settings' ) {
          settings_fields('darkpress_color_settings');
          do_settings_sections('darkpress_color_settings');
          submit_button();
        } elseif ( $active_tab == 'other_settings' ) {
          settings_fields('darkpress_other_settings');
          do_settings_sections('darkpress_other_settings');
          submit_button();
        } else {
          settings_fields('darkpress_general_settings');
          do_settings_sections('darkpress_general_settings');
          submit_button();
        }
        ?>
      </form>
    </div>
    <?php
  }


}


