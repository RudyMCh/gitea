<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint;

use Cadoles\Gitea\Client;
use Cadoles\Gitea\Endpoint\Users\TokensTrait;
use Cadoles\Gitea\Endpoint\Users\UsersTrait;

/**
 * Users endpoint
 */
class Users extends AbstractEndpoint implements EndpointInterface
{
    use TokensTrait;
    use UsersTrait;

    public const BASE_URI = '/users';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
