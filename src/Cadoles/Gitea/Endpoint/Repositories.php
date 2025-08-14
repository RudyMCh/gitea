<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint;

use Cadoles\Gitea\Client;
use Cadoles\Gitea\Endpoint\Repositories\BranchesTrait;
use Cadoles\Gitea\Endpoint\Repositories\CollaboratorsTrait;
use Cadoles\Gitea\Endpoint\Repositories\CommitsTrait;
use Cadoles\Gitea\Endpoint\Repositories\ContentsTrait;
use Cadoles\Gitea\Endpoint\Repositories\ForksTrait;
use Cadoles\Gitea\Endpoint\Repositories\GitTrait;
use Cadoles\Gitea\Endpoint\Repositories\HooksTrait;
use Cadoles\Gitea\Endpoint\Repositories\KeysTrait;
use Cadoles\Gitea\Endpoint\Repositories\PullsTrait;
use Cadoles\Gitea\Endpoint\Repositories\ReleasesTrait;
use Cadoles\Gitea\Endpoint\Repositories\RepositoryTrait;
use Cadoles\Gitea\Endpoint\Repositories\StatusesTrait;
use Cadoles\Gitea\Endpoint\Repositories\SubscriptionTrait;
use Cadoles\Gitea\Endpoint\Repositories\TopicsTrait;

/**
 * Repositories endpoint
 */
class Repositories extends AbstractEndpoint implements EndpointInterface
{
    use BranchesTrait;
    use CollaboratorsTrait;
    use CommitsTrait;
    use ContentsTrait;
    use ForksTrait;
    use GitTrait;
    use HooksTrait;
    use KeysTrait;
    use PullsTrait;
    use ReleasesTrait;
    use RepositoryTrait;
    use StatusesTrait;
    use SubscriptionTrait;
    use TopicsTrait;

    public const BASE_URI = '/repos';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
