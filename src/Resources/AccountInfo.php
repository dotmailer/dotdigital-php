<?php

declare(strict_types=1);

namespace Dotdigital\Resources;

use Dotdigital\Models\AccountInfo as AccountInfoModel;

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
