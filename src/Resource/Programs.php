<?php

declare(strict_types=1);

namespace Dotdigital\Resource;

class Programs extends AbstractResource
{
	const RESOURCE_BASE = '/programs';

	public function all(int $select = 1000, int $skip = 0)
	{
		$url = sprintf(self::RESOURCE_BASE . '/?select=%s&skip=%s', $select, $skip);
		return $this->get($url);
	}

	public function getById(int $id)
	{
		return $this->get(sprintf(self::RESOURCE_BASE . '/' . $id));
	}

	public function createEnrolment(array $params)
    {
        if (!isset($params['ProgramId'])) {
            throw new \Exception(); // we need our own exception handling
        }

        return $this->post(self::RESOURCE_BASE . '/enrolments', $params);
    }

    public function getEnrolmentById(string $id)
    {
        return $this->get(sprintf(self::RESOURCE_BASE . '/enrolments/' . $id));
    }

    public function getEnrolmentReportFaults(string $id)
    {
        return $this->get(sprintf(self::RESOURCE_BASE . '/enrolments/' . $id . '/report-faults'));
    }

    public function getEnrolmentsByStatus(string $status, int $select = 1000, int $skip = 0)
    {
        $url = sprintf(
            self::RESOURCE_BASE . '/enrolments/%s?select=%s&skip=%s',
            $status,
            $select,
            $skip
        );
        return $this->get($url);
    }
}
