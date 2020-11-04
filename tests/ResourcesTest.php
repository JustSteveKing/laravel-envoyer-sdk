<?php declare(strict_types=1);

namespace JustSteveKing\Laravel\Envoyer\SDK\Tests;

use JustSteveKing\HttpSlim\HttpClient;
use JustSteveKing\Laravel\Envoyer\SDK\Envoyer;
use JustSteveKing\Laravel\Envoyer\SDK\Resources\Action;
use JustSteveKing\PhpSdk\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Psr18Client;

class ResourcesTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        $this->client = Envoyer::illuminate('1234');
        $this->client->addResource('actions', new Action());
        $this->client->actions->setHttp(
            HttpClient::build(
                new \Http\Mock\Client(),
                new Psr18Client(),
                new Psr18Client()
            )
        );
    }

    /**
     * @test
     */
    public function it_can_get_all_actions()
    {
        $this->client->actions->all();
    }

    /**
     * @test
     */
    public function it_can_invite_a_collaborator()
    {
        $this->client->collaborators->on(10)->invite(['email' => 'test@email.com']);
    }

    /**
     * @test
     */
    public function it_can_deploy_and_cancel_a_deployment()
    {
        $this->client->deployments->on(10)->deploy();
        $this->client->deployments->on(10)->cancel(1);
    }

    /**
     * @test
     */
    public function it_can_work_with_environments()
    {
        $this->assertEquals(
            '1234',
            $this->client->environments->on(10)->key('1234')->uri()->query()->get('key')
        );

        $this->client->environments->on(10)->onServer(1)->put('test=this');
        $this->client->environments->on(10)->servers();
        $this->client->environments->on(10)->reset('1234');
    }

    /**
     * @test
     */
    public function it_can_work_with_projects()
    {
        $this->client->projects->all();
        $this->client->projects->save(['test' => 'body']);
        $this->client->projects->first(1);
        $this->client->projects->modify(1, ['foo' => 'bar']);
        $this->client->projects->remove(1);
    }
}
