<?php

declare(strict_types=1);

namespace Dotdigital\V2\Resources;

use Dotdigital\Resources\AbstractResource;
use Dotdigital\V2\Models\AccountInfo as AccountInfoModel;

class AccountInfo extends AbstractResource
{
    public const RESOURCE_BASE = '/account-info';

    /**
     * @return AccountInfoModel
     * @throws \Http\Client\Exception
     */
    public function show()
    {
        return new AccountInfoModel($this->get(self::RESOURCE_BASE));
    }
}
