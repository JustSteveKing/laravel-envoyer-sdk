<?php declare(strict_types=1);

namespace JustSteveKing\Laravel\Envoyer\SDK\Tests;

use PHPUnit\Framework\TestCase;
use JustSteveKing\Laravel\Envoyer\SDK\Envoyer;

class EnvoyerTest extends TestCase
{
    /**
     * @test
     */
    public function it_will_create_the_client_correctly()
    {
        $client = Envoyer::illuminate('12345');
        $this->assertInstanceOf(
            Envoyer::class,
            $client
        );
    }
}
