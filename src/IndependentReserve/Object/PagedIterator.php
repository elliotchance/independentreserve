<?php

namespace IndependentReserve\Object;

use Closure;
use Elliotchance\Iterator\AbstractPagedIterator;
use IndependentReserve\PrivateClient;

class PagedIterator extends AbstractPagedIterator
{
    /**
     * @var int
     */
    protected $totalSize = -1;

    /**
     * @var PrivateClient
     */
    protected $client;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var string
     */
    protected $endPoint;

    /**
     * @var Closure
     */
    protected $translator;

    /**
     * @param PrivateClient $client
     * @param string $endPoint
     * @param array $params
     * @param Closure $translator
     */
    public function __construct(PrivateClient $client, $endPoint, array $params, Closure $translator)
    {
        $this->client = $client;
        $this->endPoint = $endPoint;
        $this->params = $params;
        $this->translator = $translator;
    }

    /**
     * @return integer
     */
    public function getPageSize()
    {
        return $this->params['pageSize'];
    }

    /**
     * @return integer
     */
    public function getTotalSize()
    {
        if ($this->totalSize < 0) {
            $this->getPage(0);
        }
        return $this->totalSize;
    }

    /**
     * @param integer $pageNumber
     * @return array
     */
    public function getPage($pageNumber)
    {
        $result = json_decode($this->client->getPrivateEndpoint($this->endPoint, $this->params + [
            'pageIndex' => $pageNumber + 1,
        ]));
        $this->totalSize = $result->TotalItems;
        return array_map($this->translator, $result->Data);
    }
}
