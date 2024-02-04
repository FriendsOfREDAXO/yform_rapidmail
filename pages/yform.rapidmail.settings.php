<?php

use Rapidmail\ApiClient\Client;
use Rapidmail\ApiClient\Exception\ApiClientException;

echo rex_view::title(rex_i18n::msg('yform_rapidmail'));

$addon = rex_addon::get('yform_rapidmail');


/* Konfigurations-Fragment API-Einstellungen Rapidmail */
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



/* Empfängerlisten-Fragment */
$client = new Client(rex_config::get('yform_rapidmail', 'api_user_hash'), rex_config::get('yform_rapidmail', 'api_password_hash'));

$listService = $client->recipientlists();
$listFragment = new rex_fragment();
$content = '';

$table = '<p>' . $this->i18n('yform_rapidmail_info_list') . '</p>	';

try {
    foreach ($listService->query() as $list) {
        $content .= '<tr>';
        $content .= '<td>' . $list['id'] . '</td>';
        $content .= '<td><strong>' . $list['name'] . '</strong><br>'. $list['description'] .'</td>';
        $content .= '<td><a href="'.$list['subscribe_form_url'].'" target="_blank">Link</a></td>';
        $content .= '</tr>';
    }

    $table = '<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Formular</th>
				</tr>
			</thead>
			<tbody>
				' . $content . '
			</tbody>
		  </table>';
} catch (ApiClientException $e) {
    $table = '<p>' . $this->i18n('yform_rapidmail_info_list_error') . '</p>';
}
$listFragment->setVar('class', 'info', false);
$listFragment->setVar('title', $this->i18n('yform_rapidmail_donate'), false);

$listFragment->setVar('content', $table, false);
?>

<div class="row">
	<div class="col-lg-8">
		<?= $fragment->parse('core/page/section.php') ?>
		<?= $listFragment->parse('core/page/section.php') ?>
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
