<?php
declare(strict_types=1);

namespace App\Modules\Http\Request;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestHandler implements RequestHandlerInterface
{
    /** @var HeaderBag  */
    private $headerBag;

    /**
     * RequestHandler constructor.
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->headerBag = $requestStack->getCurrentRequest()->headers;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        $size = (int) $this->headerBag->get(RequestHandlerInterface::HEADER_PAGE_SIZE);
        return $size>0 ? $size : RequestHandlerInterface::DEFAULT_PAGE_SIZE;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        $currentPage = (int) $this->headerBag->get(RequestHandlerInterface::HEADER_CURRENT_PAGE);
        return $currentPage>0 ? $currentPage : RequestHandlerInterface::DEFAULT_CURRENT_PAGE;
    }
}