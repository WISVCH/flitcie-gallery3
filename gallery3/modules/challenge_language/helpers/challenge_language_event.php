<?php defined("SYSPATH") or die("No direct script access.");

class challenge_language_event_Core {
  static function admin_menu($menu, $theme) {
    // Add a menu option to the admin screen for configuring the slideshow.
    $menu->get("settings_menu")
      ->append(Menu::factory("link")
               ->id("challenge-language")
               ->label(t("Language selector"))
               ->url(url::site("admin/challenge_language")));
  }
}
