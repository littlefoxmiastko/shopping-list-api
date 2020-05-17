<?php
declare(strict_types=1);

namespace App\Modules\Http\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use \Symfony\Component\Serializer\Serializer as BaseSerializer;

class Serializer
{
    public const DEFAULT_FORMAT = 'json';

    /**
     * @return BaseSerializer
     */
    public function get(): BaseSerializer
    {
        return new BaseSerializer($this->getNormalizers(), $this->getEncoders());
    }

    /**
     * @return array|JsonEncoder[]
     */
    private function getEncoders(): array
    {
        return [
          new JsonEncoder(),
        ];
    }

    /**
     * @return array|ObjectNormalizer[]
     */
    private function getNormalizers(): array
    {
        return [
          new ObjectNormalizer()
        ];
    }
}