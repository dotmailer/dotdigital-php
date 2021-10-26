<?php

declare(strict_types=1);

namespace Dotdigital\Resource;

class AccountInfo extends AbstractResource
{
	const RESOURCE_BASE = '/account-info';

	public function show()
	{
		return $this->get(self::RESOURCE_BASE);
	}
}
