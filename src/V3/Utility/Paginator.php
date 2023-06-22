<?php

namespace Dotdigital\V3\Utility;

use Dotdigital\Exception\ValidationException;
use Dotdigital\Resources\AbstractResource;
use Dotdigital\V3\Models\AbstractSingletonModel;
use Dotdigital\V3\Models\Collection;
use Dotdigital\V3\Utility\Pagination\Link;
use Dotdigital\V3\Utility\Pagination\LinkCollection;
use Dotdigital\V3\Utility\Pagination\PageableResourceInterface;
use Dotdigital\V3\Utility\Pagination\Parameter;
use Dotdigital\V3\Utility\Pagination\ParameterCollection;
use Exception;

class Paginator extends AbstractSingletonModel
{
    /**
     * @var \Dotdigital\V3\Utility\Pagination\PageableResourceInterface
     */
    private $resource;

    /**
     * @var string
     */
    private $model;

    /**
     * @var \Dotdigital\V3\Utility\Pagination\ParameterCollection
     */
    private $parameters;

    /**
     * @var LinkCollection
     */
    protected $_links;

    /**
     * @var Collection
     */
    protected $_items;

    /**
     * AbstractModel constructor.
     *
     * @param string|null $modelStruct
     * @param \Dotdigital\V3\Utility\Pagination\PageableResourceInterface|null $resource
     * @param \Dotdigital\V3\Utility\Pagination\ParameterCollection|null $criteria
     * @throws Exception
     */
    public function __construct(
        ?string $modelStruct = null,
        ?PageableResourceInterface $resource = null,
        ?ParameterCollection $criteria = null
    ) {
        if (!is_null($modelStruct)) {
            $this->setModel($modelStruct);
        }
        if (!is_null($resource)) {
            $this->setResource($resource);
        }
        if (!is_null($criteria)) {
            $this->setParameters($criteria);
        }
        parent::__construct();
    }

    /**
     * @param array $items
     * @return Collection
     */
    private function createResourceCollection(array $items): Collection
    {
        $collection = new Collection();
        foreach ($items as $item) {
            $collection->add($this->createResource($item));
        }
        return $collection;
    }

    /**
     * @param array $resource
     * @return AbstractResource
     */
    private function createResource(array $resource)
    {
        $class = $this->model;
        return new $class($resource);
    }

    /**
     * @param array $links
     * @return LinkCollection
     * @throws Exception
     */
    private function createLinkCollection(array $links): LinkCollection
    {
        $collection = new LinkCollection();
        foreach ($links as $key => $link) {
            $collection->set($key, new Link($link));
        }
        return $collection;
    }

    /**
     * @param array $criteria
     * @return \Dotdigital\V3\Utility\Pagination\ParameterCollection
     * @throws Exception
     */
    private function createParameterCollection(array $criteria): ParameterCollection
    {
        $collection = new ParameterCollection();
        foreach ($criteria as $field => $value) {
            $criterion = new Parameter();
            $criterion->setField($field);
            $criterion->setValue($value);
            $collection->add($criterion);
        }
        return $collection;
    }

    /**
     * @param string $step
     * @return ParameterCollection
     * @throws Exception
     */
    private function hydratePaginationStepParameter(string $step): ParameterCollection
    {
        if (!$link = $this->_links->getLink($step)) {
            throw new Exception("Link {$step} not found");
        }
        $this->setParameters(
            $this->createParameterCollection(
                array_merge(
                    empty($link->getMarker()) ? [] : ['marker' => $link->getMarker()],
                    $link->getParams()
                )
            )
        );
        return $this->parameters;
    }

    /**
     * @param array $links
     * @return void
     * @throws Exception
     */
    public function set_links(array $links): void
    {
        $this->_links = $this->createLinkCollection($links);
    }

    /**
     * @param array $items
     * @return void
     */
    public function set_items(array $items): void
    {
        $this->_items = $this->createResourceCollection($items);
    }

    /**
     * @param string $model
     * @return Paginator
     */
    public function setModel(string $model): self
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @param PageableResourceInterface $resource
     * @return Paginator
     */
    public function setResource(PageableResourceInterface $resource): self
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * @param \Dotdigital\V3\Utility\Pagination\ParameterCollection|null $parameters
     * @return Paginator
     */
    public function setParameters(?ParameterCollection $parameters): self
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @param string|null $marker
     * @return Paginator
     * @throws ValidationException
     */
    public function paginate(
        ?string $marker = null
    ): Paginator {
        if (is_null($this->model)) {
            throw new Exception('Model not set');
        }

        if (is_null($this->resource)) {
            throw new Exception('Resource not set');
        }

        if (is_null($this->parameters)) {
            $this->parameters = new ParameterCollection();
        }

        if (!is_null($marker)) {
            $this->parameters->set(
                'marker',
                new Parameter([
                    'field' => 'marker',
                    'value' => $marker
                ])
            );
        }

        $this->validate($this->resource->getPaged($this->parameters));
        return $this;
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->_items;
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function next(): Paginator
    {
        $this->hydratePaginationStepParameter('next');
        $this->validate($this->resource->getPaged($this->parameters));
        return $this;
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function prev(): Paginator
    {
        $this->hydratePaginationStepParameter('prev');
        $this->validate($this->resource->getPaged($this->parameters));
        return $this;
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function last(): Paginator
    {
        $this->hydratePaginationStepParameter('last');
        $this->validate($this->resource->getPaged($this->parameters));
        return $this;
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function first(): Paginator
    {
        $this->hydratePaginationStepParameter('first');
        $this->validate($this->resource->getPaged($this->parameters));
        return $this;
    }

    /**
     * @return bool
     */
    public function hasNext(): bool
    {
        try {
            $this->hydratePaginationStepParameter('next');
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
