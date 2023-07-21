<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://tirony.me
 * @since      1.0.0
 *
 * @package    Darkpress
 * @subpackage Darkpress/public
 */

class Darkpress_Public
{

  private $plugin_name;
  private $version;

  public  $dp_gen_options;
  public  $dp_color_options;
  public  $dp_other_options;

  public function __construct($plugin_name, $version)
  {

    $this -> plugin_name = $plugin_name;
    $this -> version     = $version;
    $this -> dp_gen_option  = get_option('darkpress_gen_settings');
    $this -> dp_color_options  = get_option('darkpress_color_settings');
    $this -> dp_other_options  = get_option('darkpress_other_settings');
  }

  public function enqueue_styles()
  {
    wp_enqueue_style('darkpress-public_style', plugin_dir_url(__FILE__) . 'css/darkpress-public.css', array(), $this -> version, 'all');
    if ( isset($this -> dp_other_options[ 'darkpress_custom_css' ]) ) {
      $custom_css = $this -> dp_other_options[ 'darkpress_custom_css' ];
      wp_add_inline_style('darkpress-public_style', $custom_css);
    }
  }

  public function enqueue_scripts()
  {
    wp_enqueue_script('darkpress-darkmode-js', plugin_dir_url(__FILE__) . 'js/darkmode.js', array(), $this -> version, true);
    wp_enqueue_script('darkpress-public_script', plugin_dir_url(__FILE__) . 'js/darkpress-public.js', array('jquery'), $this -> version, true);
    wp_localize_script('darkpress-public_script', 'darkpress', ['general'=>$this -> dp_gen_option,'color'=>$this -> dp_color_options,'other'=>$this -> dp_other_options]);
  }

}
