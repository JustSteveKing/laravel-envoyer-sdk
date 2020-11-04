<?php declare(strict_types=1);

namespace JustSteveKing\Laravel\Envoyer\SDK;

use DI\Container;
use JustSteveKing\HttpAuth\Strategies\BasicStrategy;
use JustSteveKing\HttpSlim\HttpClient;
use JustSteveKing\Laravel\Envoyer\SDK\Resources\Action;
use JustSteveKing\Laravel\Envoyer\SDK\Resources\Collaborator;
use JustSteveKing\Laravel\Envoyer\SDK\Resources\Deployment;
use JustSteveKing\Laravel\Envoyer\SDK\Resources\Environment;
use JustSteveKing\Laravel\Envoyer\SDK\Resources\Hook;
use JustSteveKing\Laravel\Envoyer\SDK\Resources\Notification;
use JustSteveKing\Laravel\Envoyer\SDK\Resources\Project;
use JustSteveKing\Laravel\Envoyer\SDK\Resources\Server;
use JustSteveKing\PhpSdk\Client;
use JustSteveKing\PhpSdk\ClientBuilder;
use JustSteveKing\UriBuilder\Uri;
use Symfony\Component\HttpClient\Psr18Client;

class Envoyer extends Client
{
    /**
     * Envoyer constructor.
     * @param string $apiKey
     * @param string $uri
     */
    public function __construct(string $apiKey, string $uri = 'https://envoyer.io/')
    {
        parent::__construct(new ClientBuilder(
            Uri::fromString($uri),
            HttpClient::build(
                new Psr18Client(), // http client (psr-18)
                new Psr18Client(), // request factory (psr-17)
                new Psr18Client() // stream factory (psr-17)
            ),
            new BasicStrategy(
                $apiKey
            ),
            new Container()
        ));
    }

    /**
     * Return a new Envoyer SDK
     *
     * @param string $apiKey
     * @param string $uri
     * @return static
     */
    public static function illuminate(string $apiKey, string $uri = 'https://envoyer.io/'): self
    {
        $client = new self($apiKey, $uri);

        // Add Resources
        $client->addResource('hooks', new Hook());
        $client->addResource('actions', new Action());
        $client->addResource('servers', new Server());
        $client->addResource('projects', new Project());
        $client->addResource('deployments', new Deployment());
        $client->addResource('environments', new Environment());
        $client->addResource('collaborators', new Collaborator());
        $client->addResource('notifications', new Notification());

        return $client;
    }
}
