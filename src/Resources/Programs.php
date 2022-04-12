<?php

declare(strict_types=1);

namespace Dotdigital\Resources;

use Dotdigital\Exception\MissingArgumentException;
use Dotdigital\Models\Enrolment;
use Dotdigital\Models\EnrolmentList;
use Dotdigital\Models\Program;
use Dotdigital\Models\ProgramList;

class Programs extends AbstractResource
{
    public const RESOURCE_BASE = '/programs';

    /**
     * @param int $select
     * @param int $skip
     *
     * @return Program[]
     * @throws \Http\Client\Exception
     */
    public function all(int $select = 1000, int $skip = 0)
    {
        $url = sprintf(self::RESOURCE_BASE . '/?select=%s&skip=%s', $select, $skip);
        $list = new ProgramList($this->get($url));
        return $list->toArray();
    }

    /**
     * @param int $id
     *
     * @return Program
     * @throws \Http\Client\Exception
     */
    public function getById(int $id)
    {
        return new Program($this->get(sprintf(self::RESOURCE_BASE . '/' . $id)));
    }

    /**
     * @param int $programId
     * @param int[] $contacts
     * @param int[] $addressBooks
     *
     * @return Enrolment
     * @throws \Exception
     */
    public function createEnrolment(int $programId, array $contacts, $addressBooks = [])
    {
        if (!$programId) {
            throw new MissingArgumentException('programId');
        }

        $params = [
            'programId' => $programId,
            'contacts' => $contacts,
            'addressBooks' => $addressBooks
        ];

        return new Enrolment($this->post(self::RESOURCE_BASE . '/enrolments', $params));
    }

    /**
     * @param string $id
     *
     * @return Enrolment
     * @throws \Http\Client\Exception
     */
    public function getEnrolmentById(string $id)
    {
        return new Enrolment($this->get(sprintf(self::RESOURCE_BASE . '/enrolments/' . $id)));
    }

    /**
     * @param string $status
     * @param int $select
     * @param int $skip
     *
     * @return Enrolment[]
     * @throws \Http\Client\Exception
     */
    public function getEnrolmentsByStatus(string $status, int $select = 1000, int $skip = 0)
    {
        $url = sprintf(
            self::RESOURCE_BASE . '/enrolments/%s?select=%s&skip=%s',
            $status,
            $select,
            $skip
        );
        $list = new EnrolmentList($this->get($url));
        return $list->toArray();
    }
}
