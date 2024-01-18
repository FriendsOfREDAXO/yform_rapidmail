<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter;

use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class RecipientCreateParam extends GenericParameter
{

    /**
     * @var string[]
     */
    const GENDER = [
        'male',
        'female'
    ];

    /**
     * @var string[]
     */
    const MAILTYPES = [
        'text',
        'html'
    ];

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {

        return [
            'email',
            'recipientlist_id',
            'firstname',
            'lastname',
            'gender',
            'title',
            'zip',
            'birthdate',
            'foreign_id',
            'mailtype',
            'created_ip',
            'created_host',
            'activated'
        ];

    }

    /**
     * Sets the email address (required)
     *
     * @param string $email
     * @return static
     */
    public function setEmail($email)
    {
        $this->setAttributeRaw('email', $email);

        return $this;
    }

    /**
     * Sets the recipientlist ID the recipient is assigned to (required)
     *
     * @param int $recipientlistId
     * @return static
     */
    public function setRecipientlistId($recipientlistId)
    {
        $this->setAttributeRaw('recipientlist_id', $recipientlistId);

        return $this;
    }

    /**
     * Sets the firstname
     *
     * @param string $firstname
     * @return static
     */
    public function setFirstname($firstname)
    {
        $this->setAttributeRaw('firstname', $firstname);

        return $this;
    }

    /**
     * Sets the lastname
     *
     * @param string $lastname
     * @return static
     */
    public function setLastname($lastname)
    {
        $this->setAttributeRaw('lastname', $lastname);

        return $this;
    }

    /**
     * Sets the gender
     *
     * @param string $gender
     * @return static
     */
    public function setGender($gender)
    {

        if (!in_array($gender, static::GENDER)) {

            throw new InvalidArgumentException(
                'Invalid gender provided. Must be one of: ' . implode(', ', static::GENDER)
            );

        }

        $this->setAttributeRaw('gender', $gender);

        return $this;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return static
     */
    public function setTitle($title)
    {
        $this->setAttributeRaw('title', $title);

        return $this;
    }

    /**
     * Sets the zip code
     *
     * @param string $zip
     * @return static
     */
    public function setZip($zip)
    {
        $this->setAttributeRaw('zip', $zip);

        return $this;
    }

    /**
     * Sets the birthdate
     *
     * @param string|\DateTimeInterface $birthdate
     * @return static
     */
    public function setBirthdate($birthdate)
    {
        $this->setAttributeRaw('birthdate', $this->stringifyDateTime($birthdate, 'Y-m-d'));

        return $this;
    }

    /**
     * Sets the foreign/external ID
     *
     * @param mixed $foreignId
     * @return static
     */
    public function setForeignId($foreignId)
    {
        $this->setAttributeRaw('foreign_id', $foreignId);

        return $this;
    }

    /**
     * Sets the mailtype specifying if recipient wants text or html email
     *
     * @param string $mailtype
     * @return static
     */
    public function setMailtype($mailtype)
    {

        if (!in_array($mailtype, static::MAILTYPES)) {

            throw new InvalidArgumentException(
                'Invalid mailtype provided. Must be one of: ' . implode(', ', static::MAILTYPES)
            );

        }

        $this->setAttributeRaw('mailtype', $mailtype);

        return $this;
    }

    /**
     * Sets the created IP
     *
     * @param string $createdIp
     * @return static
     */
    public function setCreatedIp($createdIp)
    {
        $this->setAttributeRaw('created_ip', $createdIp);

        return $this;
    }

    /**
     * Sets the created host name
     *
     * @param string $createdHost
     * @return static
     */
    public function setCreatedHost($createdHost)
    {
        $this->setAttributeRaw('created_host', $createdHost);

        return $this;
    }

    /**
     * Sets the datetime the recipient was activated
     *
     * @param string|\DateTimeInterface $activated
     * @return static
     */
    public function setActivated($activated)
    {
        $this->setAttributeRaw('activated', $this->stringifyDateTime($activated));

        return $this;
    }

}