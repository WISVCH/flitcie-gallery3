<?php defined("SYSPATH") or die("No direct script access.") ?>
<? if ($anchor): ?>
<a name="<?= $anchor ?>"></a>
<? endif ?>
<div id="<?= $css_id ?>" class="g-block">
  <div class="block-top">
    <div class="block-top-left"></div>
	<div class="block-top-right"></div>
    <h3><?= $title ?></h3>
  </div>
  <div class="g-block-content">
    <?= $content ?>
  </div>
</div>