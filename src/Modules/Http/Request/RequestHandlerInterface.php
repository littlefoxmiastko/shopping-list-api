<?php
declare(strict_types=1);

namespace App\Modules\Http\Request;


interface RequestHandlerInterface
{
    /** @var string  */
    public const HEADER_PAGE_SIZE = 'X-Page-Size';

    /** @var string  */
    public const HEADER_CURRENT_PAGE = 'X-Current-Page';

    /** @var int  */
    public const DEFAULT_PAGE_SIZE = 10;

    /** @var int  */
    public const DEFAULT_CURRENT_PAGE = 1;

    /**
     * @return int
     */
    public function getPageSize(): int;

    /**
     * @return int
     */
    public function getCurrentPage(): int;
}