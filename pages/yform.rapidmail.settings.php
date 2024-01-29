<?php


echo rex_view::title(rex_i18n::msg('yform_rapidmail'));

$addon = rex_addon::get('yform_rapidmail');

$form = rex_config_form::factory($addon->getName());

$field = $form->addTextField('api_user_hash');
$field->setLabel('API-Benutzer');
$field->setNotice('<a href="https://my.rapidmail.de/api/v3/userlist.html" target="_blank">hier erstellen</a>');

$field = $form->addTextField('api_password_hash');
$field->setLabel('Passwort-Hash');

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', $addon->i18n('yform_rapidmail_config'), false);
$fragment->setVar('body', $form->get(), false);


?>

<div class="row">
	<div class="col-lg-8">
		<?= $fragment->parse('core/page/section.php') ?>
	</div>
	<div class="col-lg-4">
		<?php

$anchor = '<a target="_blank" href="https://donate.alexplus.de/?addon=yform_rapidmail"><img src="' . rex_url::addonAssets('yform_rapidmail', 'jetzt-spenden.svg') . '" style="width: 100% max-width: 400px;"></a>';

$fragment = new rex_fragment();
$fragment->setVar('class', 'info', false);
$fragment->setVar('title', $this->i18n('yform_rapidmail_donate'), false);
$fragment->setVar('body', '<p>' . $this->i18n('yform_rapidmail_info_donate') . '</p>' . $anchor, false);
echo !rex_config::get('alexplusde', 'donated') ? $fragment->parse('core/page/section.php') : '';
?>
	</div>
</div>
