<?php
/**
 * @author Erik van Paassen <erikp@ch.tudelft.nl>
 */
class challenge_menu_theme_Core {
  static function head($theme) {
    return $theme->css("challenge_menu.css");
  }
}
