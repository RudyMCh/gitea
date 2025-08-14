<?php

declare(strict_types=1);

namespace Cadoles\Gitea;

use Cadoles\Gitea\Endpoint\Admin;
use Cadoles\Gitea\Endpoint\EndpointInterface;
use Cadoles\Gitea\Endpoint\Issues;
use Cadoles\Gitea\Endpoint\Miscellaneous;
use Cadoles\Gitea\Endpoint\Organizations;
use Cadoles\Gitea\Endpoint\Repositories;
use Cadoles\Gitea\Endpoint\User;
use Cadoles\Gitea\Endpoint\Users;
use InvalidArgumentException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @method Admin admin()
 * @method Issues issues()
 * @method Miscellaneous miscellaneous()
 * @method Organizations organizations()
 * @method Repositories repositories()
 * @method User user()
 * @method Users users()
 */
class Client
{
    private const AUTH_ACCESS_TOKEN = 'access_token';
    private const AUTH_TOKEN = 'token';
    private const AUTH_BASIC_AUTH = 'basic_auth';
    private const BASE_URI = '/api/v1';

    private array $config = [];

    public function __construct(
        private HttpClientInterface $httpClient,
        private string $baseUri,
        array $authentication
    ) {
        $this->baseUri = rtrim($this->baseUri, '/');
        $this->auth($authentication);
    }

    public function __call(string $method, array $args): EndpointInterface
    {
        $endpointClassName = __NAMESPACE__ . '\\Endpoint\\' . ucfirst($method);
        if (class_exists($endpointClassName)) {
            return new $endpointClassName($this);
        }
        throw new InvalidArgumentException(sprintf('Endpoint "%s" not found', ucfirst($method)));
    }

    public function request(string $uri = '', string $method = 'GET', array $options = []): ResponseInterface
    {
        $uri = $this->config['base_uri'] . self::BASE_URI . $uri;

        if (!empty($this->config['query'])) {
            $options['query'] = isset($options['query'])
                ? array_merge($this->config['query'], $options['query'])
                : $this->config['query'];
        }

        if (!empty($this->config['auth_basic'])) {
            $options['auth_basic'] = $this->config['auth_basic'];
        }

        return $this->httpClient->request($method, $uri, $options);
    }

    public function sudo(string $username): self
    {
        $this->config['query']['sudo'] = $username;
        return $this;
    }

    private function auth(array $authentication): void
    {
        if (empty($authentication['type'])) {
            throw new InvalidArgumentException('Please add an authentication type.');
        }

        switch ($authentication['type']) {
            case self::AUTH_ACCESS_TOKEN:
                if (empty($authentication['auth'])) {
                    throw new InvalidArgumentException('Please add the access token.');
                }
                $this->config['query']['access_token'] = $authentication['auth'];
                break;

            case self::AUTH_BASIC_AUTH:
                if (empty($authentication['auth']['username']) || empty($authentication['auth']['password'])) {
                    throw new InvalidArgumentException('Please add both username and password.');
                }
                $this->config['auth_basic'] = [
                    $authentication['auth']['username'],
                    $authentication['auth']['password']
                ];
                break;

            case self::AUTH_TOKEN:
                if (empty($authentication['auth'])) {
                    throw new InvalidArgumentException('Please add the token.');
                }
                $this->config['query']['token'] = $authentication['auth'];
                break;

            default:
                throw new InvalidArgumentException('Unknown authentication type: ' . $authentication['type']);
        }
    }
}
