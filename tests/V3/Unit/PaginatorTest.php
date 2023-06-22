<?php

namespace Dotdigital\Tests\V3\Unit;

use Dotdigital\Tests\V3\Traits\InteractsWithContactTrait;
use Dotdigital\V3\Models\Collection;
use Dotdigital\V3\Models\Contact;
use Dotdigital\V3\Utility\Pagination\PageableResourceInterface;
use Dotdigital\V3\Utility\Pagination\Parameter;
use Dotdigital\V3\Utility\Pagination\ParameterCollection;
use Dotdigital\V3\Utility\Paginator;

class PaginatorTest extends TestCase
{
    use InteractsWithContactTrait;

    public function testPaginate()
    {
        $resource = $this->createMock(PageableResourceInterface::class);
        $parameters = new ParameterCollection();
        $parameters->set('limit', new Parameter(['field' => 'limit', 'value' => '10']));
        $parameters->set('marker', new Parameter(['field' => 'marker', 'value' => 'abc123']));

        $paginator = new Paginator(
            Contact::class,
            $resource,
            $parameters
        );

        $resource->expects($this->once())
            ->method('getPaged')
            ->with($parameters)
            ->willReturn($this->buildPagedContactResponse(100));

        $paginator->paginate();

        $this->assertInstanceOf(Paginator::class, $paginator);
        $this->assertInstanceOf(Collection::class, $paginator->getItems());

        return $paginator;
    }

    /**
     * @depends testPaginate
     * @param \Dotdigital\V3\Utility\Paginator $paginator
     * @return void
     * @throws \Dotdigital\Exception\ValidationException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testNext(Paginator $paginator)
    {

        $resource = $this->createMock(PageableResourceInterface::class);
        $paginator->setResource($resource);

        $resource->expects($this->atMost(1))
            ->method('getPaged')
            ->willReturn($this->buildPagedContactResponse(100));

        $paginator = $paginator->next();

        $this->assertInstanceOf(Paginator::class, $paginator);
        $this->assertInstanceOf(Collection::class, $paginator->getItems());

        return $paginator;
    }

    /**
     * @depends testPaginate
     * @param Paginator $paginator
     * @return void
     * @throws \Dotdigital\Exception\ValidationException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testPrev(Paginator $paginator)
    {
            $resource = $this->createMock(PageableResourceInterface::class);
            $paginator->setResource($resource);

            $resource->expects($this->atMost(1))
                ->method('getPaged')
                ->willReturn($this->buildPagedContactResponse(100));

            $paginator = $paginator->prev();

            $this->assertInstanceOf(Paginator::class, $paginator);
            $this->assertInstanceOf(Collection::class, $paginator->getItems());
    }

    /**
     * @depends testPaginate
     * @param Paginator $paginator
     * @return void
     * @throws \Dotdigital\Exception\ValidationException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testFirst(Paginator $paginator){
        $resource = $this->createMock(PageableResourceInterface::class);
        $paginator->setResource($resource);

        $resource->expects($this->atMost(1))
            ->method('getPaged')
            ->willReturn($this->buildPagedContactResponse(100));

        $paginator = $paginator->first();

        $this->assertInstanceOf(Paginator::class, $paginator);
        $this->assertInstanceOf(Collection::class, $paginator->getItems());
    }

    /**
     * @depends testPaginate
     * @param \Dotdigital\V3\Utility\Paginator $paginator
     * @return void
     * @throws \Dotdigital\Exception\ValidationException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testLast(Paginator $paginator)
    {
        $resource = $this->createMock(PageableResourceInterface::class);
        $paginator->setResource($resource);

        $resource->expects($this->atMost(1))
            ->method('getPaged')
            ->willReturn($this->buildPagedContactResponse(100));

        $paginator = $paginator->last();

        $this->assertInstanceOf(Paginator::class, $paginator);
        $this->assertInstanceOf(Collection::class, $paginator->getItems());
    }

}
