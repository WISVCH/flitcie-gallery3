<?php defined("SYSPATH") or die("No direct script access.");

  // Base URL for flag pictures.
  $flag_type = module::get_var("challenge_language", "flag_shape");
  $base_url = url::base(FALSE) . "modules/challenge_language/images/" . $flag_type . "/";

  // Loop through each installed locale and display a flag.
  while ($one_locale = current($installed_locales)) {
    // Skip "default" so we don't end up with the same flag twice.
    if (key($installed_locales) != "") {

      // Use seperate div id's and img classes for the current language, the default language, and everything else.
      $div_id = "g-language-flag";
      $img_class = "g-flag";

      // Figure out where the flag is / use the default if it doesn't exist.
      $flag_path = MODPATH . "challenge_language/images/" . $flag_type . "/" . key($installed_locales) . ".png";
      $flag_url = $base_url . key($installed_locales) . ".png";
      if (!file_exists($flag_path)) {
        $flag_url = $base_url . "default.png";
      }
      
	  // Don't print the default language when no language has been selected.
	  if (key($installed_locales) != Gallery_I18n::instance()->locale()) {
        // Print out the HTML for the flag.
        print "<div id=\"" . $div_id . "\">" . 
              "<a href=\"javascript:image_click('" . 
              key($installed_locales) . "')\"><img src=\"" . 
              $flag_url . "\" width=\"50\" title=\"" . $one_locale . 
              "\" alt=\"" . $one_locale . "\" border=\"0\" class=\"" . 
              $img_class . "\" /> " . $one_locale . "</a></div>";
      }
    }
    next($installed_locales);
  }
?>
<script type="text/javascript">
function image_click(flag_code)
{
    var old_locale_preference = "<?= $selected ?>";
    var locale = flag_code;
    if (old_locale_preference == locale) {
      return;
    }

    var expires = -1;
    if (locale) {
      expires = 365;
    }
    $.cookie("g_locale", locale, {"expires": expires, "path": "/"});
    window.location.reload(true);
}
</script>
