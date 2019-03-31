<?php defined("SYSPATH") or die("No direct script access.");

class Admin_Challenge_Language_Controller extends Admin_Controller {
  public function index() {
    // Generate a new admin page.
    $view = new Admin_View("admin.html");
    $view->content = new View("admin_challenge_language.html");
    $view->content->preferences_form = $this->_get_admin_form();
    print $view;
  }

  public function saveprefs() {
    // Prevent Cross Site Request Forgery
    access::verify_csrf();

    // Save Settings
    module::set_var("challenge_language", "flag_shape", Input::instance()->post("flag_shape"));

    // Load Admin page.
    message::success(t("Your Selection Has Been Saved."));
    $view = new Admin_View("admin.html");
    $view->content = new View("admin_challenge_language.html");
    $view->content->preferences_form = $this->_get_admin_form();
    print $view;
  }

  private function _get_admin_form() {
    // Make a new Form.
    $form = new Forge("admin/challenge_language/saveprefs", "", "post",
                      array("id" => "g-language-flags-adminForm"));

    // Figure out what type of flags to display.
    $group_flag_types = $form->group("flag_types");
    $group_flag_types->dropdown('flag_shape')
                             ->label(t("Flag Shape:"))
                             ->options(array('rectangular'=>'Rectangular', 'round'=>'Round', 'square'=>'Square', 'custom'=>'Custom'))
                             ->selected(module::get_var("challenge_language", "flag_shape"));

    // Add a save button to the form.
    $form->submit("SavePrefs")->value(t("Save"));

    // Return the newly generated form.
    return $form;
  }
}