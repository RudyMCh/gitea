<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint;

use Cadoles\Gitea\Client;
use Cadoles\Gitea\Endpoint\User\RepositoriesTrait;
use Cadoles\Gitea\Endpoint\User\UserTrait;
use Cadoles\Gitea\Endpoint\User\FollowersTrait;
use Cadoles\Gitea\Endpoint\User\KeysTrait;

class User extends AbstractEndpoint implements EndpointInterface
{
    use FollowersTrait;
    use KeysTrait;
    use RepositoriesTrait;
    use UserTrait;

    public const BASE_URI = '/user';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
