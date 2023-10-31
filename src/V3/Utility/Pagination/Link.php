<?php

namespace Dotdigital\V3\Utility\Pagination;

use Dotdigital\V3\Models\AbstractSingletonModel;

class Link extends AbstractSingletonModel
{
    /**
     * @var string
     */
    protected $marker;

    /**
     * @var string
     */
    protected $link;

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @param string $marker
     */
    public function setMarker(string $marker): void
    {
        $this->marker = $marker;
    }

    /**
     * @return string
     */
    public function getMarker(): string
    {
        return $this->marker;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        $queryString = parse_url(
            $this->link,
            PHP_URL_QUERY
        );

        if (!is_string($queryString)) {
            return [];
        }

        parse_str($queryString, $params);
        return $params;
    }
}
