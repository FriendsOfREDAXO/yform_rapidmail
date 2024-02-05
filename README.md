# YForm Rapidmail

Work in Progress. Stellt den Rapidmail PHP-SDK zur Verfügung. Und synchronisiert Email-Adressen mit Empfängerlisten.

## Einrichtung

1. API-Zugang bei Rapidmail einrichten
2. API-Zugang in den Einstellungen YForm > Rapidmail > Einstellungen hinterlegen.
3. Gewünschte Empfängerliste(n) bei Rapidmail anlegen

Wenn erfolgreich, dann werden in den Einstellungen die verfügbaren Empfängerlisten und deren IDs angezeigt.

## Beispiel-Action

Voraussetzung:

* Empfänger-Liste mit bekannter ID, diese als `###LIST_ID###` in der Action verwenden.

Optional:

* `newsletter_optin` als Checkbox, um Opt-In DSGVO-konform abzufragen.

```plaintext
checkbox|newsletter_optin|Möchten Sie den Newsletter empfangen?|0|
email|email|E-Mail
action|yform_rapidmail|###LIST_ID###|email|newsletter_optin
```

## Beispiel für eigene Nutzung / Ausgabe / etc

```php

<?php

use Rapidmail\ApiClient\Client;

$client = new Client(rex_config::get('yform_rapidmail', 'api_user_hash'), rex_config::get('yform_rapidmail', 'api_password_hash'));

$recipientsService = $client->recipients();

/*

$collection = $recipientsService->query(
    [
        'recipientlist_id' => rex_config::get('yform_rapidmail', 'sh_group_list_id') // Recipientlist ID MUST be provided
    ]
);

foreach ($collection as $recipient) {
    // dump($recipient);
    // Echo additional properties of $recipient individually
    echo $recipient['recipientlist_id'] . '<br>';
    echo $recipient['email'] . '<br>';
    echo $recipient['firstname'] . '<br>';
    echo $recipient['lastname'] . '<br>';
    echo $recipient['gender'] . '<br>';
    echo $recipient['title'] . '<br>';
    echo $recipient['zip'] . '<br>';
    echo $recipient['birthdate'] . '<br>';
    echo $recipient['extra1'] . '<br>';
    echo $recipient['extra2'] . '<br>';
    echo $recipient['extra3'] . '<br>';
    echo $recipient['extra4'] . '<br>';
    echo $recipient['extra5'] . '<br>';
    echo $recipient['extra6'] . '<br>';
    echo $recipient['extra7'] . '<br>';
    echo $recipient['extra8'] . '<br>';
    echo $recipient['extra9'] . '<br>';
    echo $recipient['extra10'] . '<br>';
    echo $recipient['mailtype'] . '<br>';
    echo $recipient['foreign_id'] . '<br>';
    echo $recipient['created_ip'] . '<br>';
    echo $recipient['created_host'] . '<br>';
    echo $recipient['created'] . '<br>';
    echo $recipient['updated'] . '<br>';
    echo $recipient['status'] . '<br>';
    // Add more properties as needed
}
*/


// https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Recipients#/RecipientImport/post_recipients_import
$import = [];
$import['recipientlist_id'] = rex_config::get('yform_rapidmail', 'sh_group_list_id');
$import['file']['type'] =  "text/csv";
$import['file']['content'] =  base64_encode(rex_file::get(rex_path::addon('yform_rapidmail', 'rapidmail.csv')));

$config  = [];
$config['recipient_exists'] =  "importfile";
$config['recipient_missing'] =  "softdelete";
$config['recipient_deleted'] =  "import";
$config['test_mode'] =  "yes";
$response = $recipientsService->import($import, $config);

dump($response);

```
