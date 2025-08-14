<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint;

use Cadoles\Gitea\Client;
use Cadoles\Gitea\Endpoint\Organizations\HooksTrait;
use Cadoles\Gitea\Endpoint\Organizations\MembersTrait;
use Cadoles\Gitea\Endpoint\Organizations\OrganizationTrait;
use Cadoles\Gitea\Endpoint\Organizations\RepositoriesTrait;
use Cadoles\Gitea\Endpoint\Organizations\TeamsTrait;
use Cadoles\Gitea\Endpoint\Organizations\UsersTrait;

/**
 * Organizations endpoint
 */
class Organizations extends AbstractEndpoint implements EndpointInterface
{
    use HooksTrait;
    use MembersTrait;
    use OrganizationTrait;
    use RepositoriesTrait;
    use TeamsTrait;
    use UsersTrait;

    public const BASE_URI = '/orgs';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
