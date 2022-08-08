<?php

namespace Dotdigital\Resources;

use Dotdigital\Exception\ResponseValidationException;
use Dotdigital\Models\Contact as ContactModel;
use Dotdigital\Models\ContactList;
use Http\Client\Exception;

class Contacts extends AbstractResource
{
    public const RESOURCE_BASE = '/contacts';

    /**
     * Post contact given email.
     *
     * @param string $email
     * @return ContactModel
     * @throws Exception
     * @throws ResponseValidationException
     */
    public function postContacts(string $email)
    {
        $response = $this->post(
            self::RESOURCE_BASE,
            [
                "email" => $email,
                "EmailType" => 'Html'
            ]
        );

        return new ContactModel($response);
    }

    /**
     * Resubscribe contact.
     *
     * @param string $email
     * @param array<string,mixed> $dataFields
     * @return ContactList
     * @throws ResponseValidationException
     * @throws Exception
     */
    public function resubscribe(string $email, array $dataFields = [])
    {
        $url = self::RESOURCE_BASE . '/resubscribe';
        $params = [
            'unsubscribedContact' => [
                'email' => $email,
                'dataFields' => $dataFields
            ]
        ];

        return new ContactList($this->post($url, $params));
    }

    /**
     * Get contact by email.
     *
     * @param string $email
     * @return ContactModel
     * @throws Exception
     */
    public function getByEmail(string $email)
    {
        $url = sprintf('%s/%s', self::RESOURCE_BASE, $email);
        return new ContactModel($this->get($url));
    }
}
