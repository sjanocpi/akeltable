<?php
/**
* Admin functions akt_popin_plugin
**/

/* register menu item */
function akt_popin_plugin_admin_menu_setup(){
  add_submenu_page(
  'options-general.php',
  'Paramètres d\'Akt-popin-plugin',
  'akt popin plugin', // name in the menu
  'manage_options',
  'akt_popin_plugin',
  'akt_popin_plugin_admin_page_screen'
  );
}

add_action('admin_menu', 'akt_popin_plugin_admin_menu_setup'); //menu setup

function akt_popin_plugin_admin_page_screen () {
  global $submenu;
  // access page settings
  $page_data = array();
  foreach($submenu['options-general.php'] as $i => $menu_item) {
    if($submenu['options-general.php'][$i][2] == 'akt_popin_plugin')
    $page_data = $submenu['options-general.php'][$i];
  }
  // output
  ?>
  <div class="wrap">
  <?php screen_icon();?>
  <h2><?php echo $page_data[3];?></h2>
  <form id="akt_popin_plugin_options" action="options.php" method="post">
  <?php
  settings_fields('akt_popin_plugin_options');
  do_settings_sections('akt_popin_plugin');
  submit_button('Sauvegarder les options', 'primary', 'akt_popin_plugin_options_submit');
  ?>
   </form>
  </div>
  <?php
}

/* settings link in plugin management screen */
function akt_popin_plugin_settings_link($actions, $file) {
  if(false !== strpos($file, 'akt_popin_plugin'))
  $actions['settings'] = '<a href="options-general.php?page=akt_popin_plugin">Paramètres</a>';
  return $actions;
}

add_filter('plugin_action_links', 'akt_popin_plugin_settings_link', 2, 2);


function akt_popin_plugin_settings_init(){

  register_setting(
   'akt_popin_plugin_options',
   'akt_popin_plugin_options',
   'akt_popin_plugin_options_validate'
   );

  add_settings_section(
   'akt_popin_plugin_imagebox',
   'Champ d\'image',
   'akt_popin_plugin_imagebox_desc',
   'akt_popin_plugin'
   );

  add_settings_field(
   'akt_popin_plugin_imagebox_template',
   'Image : ',
   'akt_popin_plugin_imagebox_field',
   'akt_popin_plugin',
   'akt_popin_plugin_imagebox'
   );
   // Durée dans le temps entre 2 popins
  add_settings_section(
   'akt_popin_plugin_numbox',
   'Champ de nombre',
   'akt_popin_plugin_numbox_desc',
   'akt_popin_plugin'
   );

  add_settings_field(
   'akt_popin_plugin_numbox_template',
   'Nombre de jours : ',
   'akt_popin_plugin_numbox_field',
   'akt_popin_plugin',
   'akt_popin_plugin_numbox'
   );

}

add_action('admin_init', 'akt_popin_plugin_settings_init');

/* validate input */
function  akt_popin_plugin_options_validate($input){
  global $allowedposttags, $allowedrichhtml;
  if(isset($input['imagebox_template']))
   $input['imagebox_template'] = wp_kses_post($input['imagebox_template']);
  return $input;
}

function akt_popin_plugin_imagebox_desc(){
  echo "<p>Coller l'URL de l'image copiée dans les <a href=\"upload.php\">Médias</a> puis sauvegarder.</p>";
}

function akt_popin_plugin_numbox_desc(){
  echo "<p>Nombre de jours avant le nouvel affichage de la popin. Doit être un nombre entier supérieur ou égal à 1.</p>";
}

function  akt_popin_plugin_imagebox_field() {
 $options = get_option('akt_popin_plugin_options');
 $imagebox = (isset($options['imagebox_template'])) ? $options['imagebox_template'] : '';
 $imagebox = sanitize_text_field( $imagebox );
?>
 <input type="text" value="<?php echo $imagebox;?>" name="akt_popin_plugin_options[imagebox_template]" id="imagebox_template"  class="large-text code">
<?php
}

function  akt_popin_plugin_numbox_field() {
 $options = get_option('akt_popin_plugin_options');
 $numbox = (isset($options['numbox_template'])) ? $options['numbox_template'] : '1';
 $numbox = intval( $numbox );
?>
 <input type="number" min="1" value="<?php echo $numbox;?>" name="akt_popin_plugin_options[numbox_template]" id="numbox_template"  class="small-text code">
<?php
}
?>
