<?php

declare(strict_types=1);

namespace Cadoles\Gitea\Endpoint;

use Cadoles\Gitea\Client;
use Cadoles\Gitea\Endpoint\Issues\CommentsTrait;
use Cadoles\Gitea\Endpoint\Issues\IssuesTrait;
use Cadoles\Gitea\Endpoint\Issues\IssueTrait;
use Cadoles\Gitea\Endpoint\Issues\LabelsTrait;
use Cadoles\Gitea\Endpoint\Issues\MilestonesTrait;
use Cadoles\Gitea\Endpoint\Issues\ReactionsTrait;
use Cadoles\Gitea\Endpoint\Issues\StopwatchTrait;
use Cadoles\Gitea\Endpoint\Issues\SubscriptionsTrait;
use Cadoles\Gitea\Endpoint\Issues\TimesTrait;

/**
 * Issues endpoint
 */
class Issues extends AbstractEndpoint implements EndpointInterface
{
    use CommentsTrait;
    use IssueTrait;
    use IssuesTrait;
    use LabelsTrait;
    use MilestonesTrait;
    use ReactionsTrait;
    use StopwatchTrait;
    use SubscriptionsTrait;
    use TimesTrait;

    public const BASE_URI = '/repos';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
