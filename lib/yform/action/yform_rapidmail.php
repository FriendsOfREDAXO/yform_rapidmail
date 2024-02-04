<?php

use rex_yform_action_abstract;
use Rapidmail\ApiClient\Client;
use Rapidmail\ApiClient\Exception\ApiClientException;
use rex_config;

class rex_yform_action_yform_rapidmail extends rex_yform_action_abstract
{

    public function executeAction(): void
    {

        $client = new Client(rex_config::get('yform_rapidmail', 'api_user_hash'), rex_config::get('yform_rapidmail', 'api_password_hash'));

        $list_id = $this->getElement(2);
        $email = &$this->params['value_pool']['sql'][$this->getElement(3)] ?? null; // email field
        $optin = true;
        if($this->getElement(4)) {
            $optin = (bool) $this->params['value_pool']['sql'][$this->getElement(4)]; // opt: DSGVO optin field
        }
        $fullname = &$this->params['value_pool']['sql'][$this->getElement(5)] ?? ""; // opt: fullname field

        if($list_id && $optin && $email && 0 == count($this->params['warning_messages'])) {
            
            $recipientService = $client->recipients();

            $payload = [
                'email' => $email,
                'recipientlist_id' => $list_id
            ];


            $modifier = [
                'send_activationmail' => 'yes'
            ];

            try {

                $recipientService->create($payload, $modifier);

            } catch (ApiClientException $e) {
                if ($e->getCode() == 401) {
                    dump('Unauthorized access. Check if username and password are correct');
                }

                dump('An API exception occurred: ' . $e->getMessage());

            }

        }
    }

    public function getDescription(): string
    {
        return 'action|yform_rapidmail|list_id|email_fieldname(e.g. email)|opt:optin_fieldname(e.g. newsletter)|opt:fieldname_fullname(fullname)';
    }
}
