<?php defined("SYSPATH") or die("No direct script access.");

class challenge_language_installer {
  static function install() {
    // Set the default flag type.
    module::set_var("challenge_language", "flag_shape", "custom");

    module::set_version("challenge_language", 1);
  }

  static function uninstall() {
    module::delete("challenge_language");
  }
}
