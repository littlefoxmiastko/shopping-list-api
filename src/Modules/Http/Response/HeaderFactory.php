<?php
declare(strict_types=1);

namespace App\Modules\Http\Response;


use App\Modules\Http\Model\ResponseHeader;

class HeaderFactory
{
    public function produceForCollection(ResponseHeader $responseHeader): array
    {
        return [
           'Content-Type' => 'application/json',
           ResponseHeader::HEADER_CURRENT_PAGE => $responseHeader->getCurrentPage(),
           ResponseHeader::HEADER_CURRENT_PAGE_ITEMS => $responseHeader->getCurrentPageItems(),
           ResponseHeader::HEADER_PAGES_COUNT => $responseHeader->getPagesCount(),
           ResponseHeader::HEADER_TOTAL_ITEMS => $responseHeader->getTotalItems()
        ];
    }

    public function produceForSingleObject(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }
}