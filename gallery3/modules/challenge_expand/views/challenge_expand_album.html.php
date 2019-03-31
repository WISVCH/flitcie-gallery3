<div class="huidig-bestuursjaar">
  <h1><a href="<?= $album_url ?>"><?= $album_title ?></a></h1>
  <ul id="g-album-grid" class="ui-helper-clearfix">
    <? if (count($sub_albums)): ?>
      <? foreach ($sub_albums as $i => $child): ?>
      	<? if ($i >= 9) break ?>
        <li id="g-item-id-<?= $child->id ?>" class="g-item g-album">
          <?= $theme->thumb_top($child) ?>
          <a href="<?= $child->url() ?>">
            <? if ($child->has_thumb()): ?>
            <?= $child->thumb_img(array("class" => "g-thumbnail")) ?>
            <? endif ?>
          </a>
          <?= $theme->thumb_bottom($child) ?>
          <?= $theme->context_menu($child, "#g-item-id-{$child->id} .g-thumbnail") ?>
          <h2>
            <span class="g-album"></span>
            <a href="<?= $child->url() ?>"><?= html::purify($child->title) ?></a>
          </h2>
          <ul class="g-metadata">
            <?= $theme->thumb_info($child) ?>
          </ul>
        </li>
      <? endforeach ?>
      <? if (count($sub_albums) > 9): ?>
        <li id="g-item-id-showall" class="g-item g-album huidig-bestuursjaar-meer">
          <a href="<?= $album_url ?>">
            <span class="huidig-bestuursjaar-meer-pijltjes">&gt;&gt;</span>
            <h2><?= t("All albums of this year") ?></h2>
          </a>
        </li>
      <? endif ?>
    <? else: ?>
      <li><?= t("There aren't any albums here yet!") ?></li>
    <? endif ?>
  </ul>
</div>