<?
class akt_popin_plugin_wp {

  public function __construct() {

    if (!isset($_COOKIE['akt_overflow_init'])) {
      // time to see
      $hours = 24;
      $numbox_array = get_option('akt_popin_plugin_options');
      $days = $numbox_array['numbox_template'];
      $expire = (3600 * $hours) * $days;
      setcookie("akt_overflow_init", '1', time()+$expire, COOKIEPATH, COOKIE_DOMAIN);

      wp_register_script( 'akt_popin_plugin.js', plugin_dir_url( __FILE__ ) . '_inc/akt_popin_plugin.js', array('jquery'), AKT_POPIN_VERSION );
      wp_enqueue_script( 'akt_popin_plugin.js' );

      function akt_styles_method() {
          wp_enqueue_style(
            'custom-style',
            plugin_dir_url( __FILE__ ) . '_inc/akt_popin_plugin.css'
          );

                $imagebox_template_value = get_option( 'akt_popin_plugin_options' );
                $image = "background-image: url('".$imagebox_template_value['imagebox_template']."');";

                $custom_css = ".akt_overflow { $image } ";
                wp_add_inline_style( 'custom-style', $custom_css );
        }
        add_action( 'wp_enqueue_scripts', 'akt_styles_method' );
    }

  }
}

new akt_popin_plugin_wp();
