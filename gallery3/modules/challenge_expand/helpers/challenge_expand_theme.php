<?php
/**
 * @author Erik van Paassen <erikp@ch.tudelft.nl>
 */
class challenge_expand_theme {
  function album_top($theme) {
    if ($theme->item()->is_album() && $theme->item()->id == 1) {
      $current_album = ORM::factory('item')
                       ->where('parent_id', '=', 1)
                       ->where('type', '=', 'album')
                       ->order_by(array('weight' => 'ASC'))
                       ->limit(1)
                       ->find();
      
      if ($current_album->loaded()) {
        $view = new View('challenge_expand_album.html');
        $view->album_title = $current_album->title;
        $view->album_url = $current_album->url();
        
        $sub_albums = $current_album->children(NULL, NULL, array(array('type', '=', 'album')), array('weight' => 'DESC'));
        
        $view->sub_albums = $sub_albums;
        
        return $view;
      }
    }
  }
}