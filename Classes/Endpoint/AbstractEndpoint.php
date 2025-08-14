<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint;

use Cadoles\Gitea\Client;

/**
 * Abstract endpoint
 */
abstract class AbstractEndpoint implements EndpointInterface
{
    protected function removeNullValues(array $array): array
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = $this->removeNullValues($value);
                if ($value === []) {
                    unset($array[$key]);
                    continue;
                }
                $array[$key] = $value;
            } elseif ($value === null) {
                unset($array[$key]);
            }
        }
    
        return $array;
    }
}
