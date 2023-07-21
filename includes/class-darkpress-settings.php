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
class Darkpress_Admin_settings
{

  private $plugin_name;

  private $version;


  public $dp_gen_options;
  public $dp_color_options;
  public $dp_other_options;
  public function __construct($plugin_name, $version)
  {
    $this -> plugin_name = $plugin_name;
    $this -> version     = $version;

    $this -> dp_gen_options = get_option('darkpress_gen_settings');
    $this -> dp_color_options = get_option('darkpress_color_settings');
    $this -> dp_other_options = get_option('darkpress_other_settings');
  }


  public function darkpress_admin_init_callback()
  {

    register_setting(
      'darkpress_general_settings',
      'darkpress_gen_settings',
      [$this, 'sanitize_fields']
    );
    register_setting(
      'darkpress_color_settings',
      'darkpress_color_settings',
      [$this, 'sanitize_fields']
    );
    register_setting(
      'darkpress_other_settings',
      'darkpress_other_settings',
      [$this, 'sanitize_fields']
    );
    add_settings_section(
      'darkpress_general',
      'General Settings',
      [$this, 'darkpress_setting_general_section_callback'],
      'darkpress_general_settings'
    );
    add_settings_section(
      'darkpress_color',
      'Color Settings',
      [$this, 'darkpress_setting_color_section_callback'],
      'darkpress_color_settings'
    );
    add_settings_section(
      'darkpress_other',
      'Other Settings',
      [$this, 'darkpress_setting_other_section_callback'],
      'darkpress_other_settings'
    );

    add_settings_field(
      'darkpress_label',
      'Label',
      [$this, 'darkpress_label_callback'],
      'darkpress_general_settings',
      'darkpress_general'
    );
    add_settings_field(
      'darkpress_position_left',
      'Position From Left',
      [$this, 'darkpress_position_left_callback'],
      'darkpress_general_settings',
      'darkpress_general'
    );
    add_settings_field(
      'darkpress_position_right',
      'Position From Right',
      [$this, 'darkpress_position_right_callback'],
      'darkpress_general_settings',
      'darkpress_general'
    );

    add_settings_field(
      'darkpress_position_bottom',
      'Position From Bottom',
      [$this, 'darkpress_position_bottom_callback'],
      'darkpress_general_settings',
      'darkpress_general'
    );
    add_settings_field(
      'darkpress_mix_color',
      'Mix Color',
      [$this, 'darkpress_mix_color_callback'],
      'darkpress_color_settings',
      'darkpress_color'
    );

    add_settings_field(
      'darkpress_bg_color',
      'Background Color',
      [$this, 'darkpress_bg_color_callback'],
      'darkpress_color_settings',
      'darkpress_color'
    );
    add_settings_field(
      'darkpress_btn_dark_color',
      'Button Color Dark',
      [$this, 'darkpress_btn_dark_color_callback'],
      'darkpress_color_settings',
      'darkpress_color'
    );
    add_settings_field(
      'darkpress_btn_light_color',
      'Button Color Light',
      [$this, 'darkpress_btn_light_color_callback'],
      'darkpress_color_settings',
      'darkpress_color'
    );

    add_settings_field(
      'darkpress_save_cookie',
      'Save Cookies?',
      [$this, 'darkpress_save_cookie_callback'],
      'darkpress_other_settings',
      'darkpress_other'
    );
    add_settings_field(
      'darkpress_auto_os_theme',
      'Auto Match Os Theme?',
      [$this, 'darkpress_auto_os_theme_callback'],
      'darkpress_other_settings',
      'darkpress_other'
    );
    add_settings_field(
      'darkpress_custom_css',
      'Custom CSS',
      [$this, 'darkpress_custom_css_callback'],
      'darkpress_other_settings',
      'darkpress_other'
    );
  }
  public function sanitize_fields($field)
  {
    $new_field = [];

    if(isset($field['darkpress_label'])){
      $new_field['darkpress_label'] = sanitize_text_field($field['darkpress_label']);
    }
    if(isset($field['darkpress_position_left'])){
      $new_field['darkpress_position_left'] = sanitize_text_field($field['darkpress_position_left']);
    }
    if(isset($field['darkpress_position_right'])){
      $new_field['darkpress_position_left'] = sanitize_text_field($field['darkpress_position_left']);
    }
    if(isset($field['darkpress_position_right'])){
      $new_field['darkpress_position_right'] = sanitize_text_field($field['darkpress_position_right']);
    }
    if(isset($field['darkpress_position_bottom'])){
      $new_field['darkpress_position_bottom'] = sanitize_text_field($field['darkpress_position_bottom']);
    }
    if(isset($field['darkpress_mix_color'])){
      $new_field['darkpress_mix_color'] = sanitize_text_field($field['darkpress_mix_color']);
    }
    if(isset($field['darkpress_bg_color'])){
      $new_field['darkpress_bg_color'] = sanitize_text_field($field['darkpress_bg_color']);
    }
    if(isset($field['darkpress_btn_dark_color'])){
      $new_field['darkpress_btn_dark_color'] = sanitize_text_field($field['darkpress_btn_dark_color']);
    }
    if(isset($field['darkpress_btn_light_color'])){
      $new_field['darkpress_btn_light_color'] = sanitize_text_field($field['darkpress_btn_light_color']);
    }
    if(isset($field['darkpress_save_cookie'])){
      $new_field['darkpress_save_cookie'] = absint($field['darkpress_save_cookie']);
    }
    if(isset($field['darkpress_auto_os_theme'])){
      $new_field['darkpress_auto_os_theme'] = absint($field['darkpress_auto_os_theme']);
    }
    if(isset($field['darkpress_custom_css'])){
      $new_field['darkpress_custom_css'] = sanitize_textarea_field($field['darkpress_custom_css']);
    }
    return $new_field;
  }
  public function darkpress_setting_general_section_callback()
  {
    $html = '
<h4>This library uses the css mix-blend-mode in order to bring Dark-mode to any of your websites.</h4>
<p>
Use the class <b>darkmode-ignore</b> where you don\'t want to apply darkmode
You can also add this style: <b>isolation: isolate; </b>in your css, this will also ignore the darkmode.<br>
  It is also possible to revert the dark-mode with this style <b>mix-blend-mode: difference;</b>
</p>';

    echo $html;
  }
public function darkpress_setting_color_section_callback(){
   echo "";
}
  public function darkpress_setting_other_section_callback(){
    echo "";
  }
  public function darkpress_label_callback()
  {
    printf('<input type="text" class="regular-text" id="dp_label" name="darkpress_gen_settings[darkpress_label]" value="%s" placeholder="Dark Mode" />', $this -> dp_gen_options[ 'darkpress_label' ] ?? '');
  }
  public function darkpress_position_left_callback()
  {
    printf('<input type="text" class="regular-text" id="dp_left" name="darkpress_gen_settings[darkpress_position_left]" value="%s" placeholder="32px" />', $this -> dp_gen_options[ 'darkpress_position_left' ] ?? '');
  }
  public function darkpress_position_right_callback()
  {
    printf('<input type="text" class="regular-text" id="dp_right" name="darkpress_gen_settings[darkpress_position_right]" value="%s" placeholder="32px" />', $this -> dp_gen_options[ 'darkpress_position_right' ] ?? '');
  }

  public function darkpress_position_bottom_callback()
  {
    printf('<input type="text" class="regular-text" id="dp_bottom" name="darkpress_gen_settings[darkpress_position_bottom]" value="%s" placeholder="32px" />', $this -> dp_gen_options[ 'darkpress_position_bottom' ] ?? '');
  }
  public function darkpress_mix_color_callback()
  {
    printf('<input type="text" class="color-field" id="dp_mixColor" name="darkpress_color_settings[darkpress_mix_color]" value="%s"  />', $this -> dp_color_options[ 'darkpress_mix_color' ] ?? '#ffffff');
  }


  public function darkpress_bg_color_callback()
  {
    printf('<input  type="text" class="color-field" id="dp_bgColor" name="darkpress_color_settings[darkpress_bg_color]" value="%s" placeholder="#fff" />', $this -> dp_color_options[ 'darkpress_bg_color' ] ?? '#ffffff');
  }
  public function darkpress_btn_dark_color_callback()
  {
    printf('<input  type="text" class="color-field" id="dp_btnDark" name="darkpress_color_settings[darkpress_btn_dark_color]" value="%s" placeholder="#fff" />', $this -> dp_color_options[ 'darkpress_btn_dark_color' ] ?? '#100f2c');
  }
  public function darkpress_btn_light_color_callback()
  {
    printf('<input  type="text" class="color-field" id="dp_btnLight" name="darkpress_color_settings[darkpress_btn_light_color]" value="%s" placeholder="#fff" />', $this -> dp_color_options[ 'darkpress_btn_light_color' ] ?? '#ffffff');
  }

  public function darkpress_save_cookie_callback()
  {

    printf('<input type="checkbox" class="dp_checkbox" id="dp_os_theme" name="darkpress_other_settings[darkpress_save_cookie]" value="1"'.checked(1, isset($this -> dp_other_options[ 'darkpress_save_cookie' ]), false).'/>' );
  }
  public function darkpress_auto_os_theme_callback()
  {
    printf('<input type="checkbox" class="dp_checkbox" id="dp_os_theme" name="darkpress_other_settings[darkpress_auto_os_theme]" value="1"'.checked(1, isset($this -> dp_other_options[ 'darkpress_auto_os_theme' ]), false).'/>' );
  }
  public function darkpress_custom_css_callback()
  {
$html = '<p>
A CSS class <b>darkmode--activated</b> is added to the body tag when the darkmode is activated. You can take advantage of it to override the style and have a custom style.<br>
</p>
<h4>For example</h4>
<pre>
.darkmode--activated p, .darkmode--activated a{
  color: #000;
}
</pre>';

    printf('<div class="db_details">%s</div><textarea class="large-text code" id="dp_custom_css" rows="12" cols="150" name="darkpress_other_settings[darkpress_custom_css]">%s</textarea>', $html, $this -> dp_other_options[ 'darkpress_custom_css' ] ?? '');
  }
}


