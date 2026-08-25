<?php

declare(strict_types=1);

namespace Dotdigital\V2\Resources;

use Dotdigital\Enums\DataField\Type;
use Dotdigital\Enums\DataField\Visibility;
use Dotdigital\Resources\AbstractResource;
use Dotdigital\V2\Models\DataField;
use Dotdigital\V2\Models\DataFieldList;

class DataFields extends AbstractResource
{
    public const RESOURCE_BASE = '/data-fields';

    /**
     * @return DataFieldList
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function show()
    {
        return new DataFieldList($this->get(self::RESOURCE_BASE));
    }

    /**
     * @param string $name Name of the data field.
     * @param Type $type Data field type enum value.
     * @param Visibility|null $visibility Data field visibility; defaults to `Visibility::PRIVATE`.
     * @param string|null $defaultValue Optional default value for the field.
     *
     * @return DataField Created data field model from the API response.
     *
     * @throws \Http\Client\Exception When the HTTP request fails.
     * @throws \Exception When response handling or model hydration fails.
     */
    public function create(
        string $name,
        Type $type,
        ?Visibility $visibility = null,
        ?string $defaultValue = null
    ): DataField {
        $visibility = $visibility ?? Visibility::from(Visibility::PRIVATE);
        $data = [
            'name' => $name,
            'type' => $type->value,
            'visibility' => $visibility->value,
            'defaultValue' => $defaultValue,
        ];

        return new DataField($this->post(self::RESOURCE_BASE, $data));
    }
}
