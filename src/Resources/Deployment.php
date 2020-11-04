<?php declare(strict_types=1);

namespace JustSteveKing\Laravel\Envoyer\SDK\Resources;

class Deployment extends EnvoyerResource
{
    protected string $path = 'deployments';

    public function deploy():? object
    {
        try {
            $response = $this->http()->post(
                $this->uri()->toString(),
                [],
                $this->strategy()->getHeader($this->authHeader)
            );
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            throw $e;
        }
        // @codeCoverageIgnoreEnd

        return json_decode($response->getBody()->getContents());
    }

    public function cancel($identifier):? object
    {
        $this->uri()->addPath(
            "{$this->uri()->path()}/{$identifier}"
        );

        try {
            $response = $this->http()->post(
                $this->uri()->toString(),
                [],
                $this->strategy()->getHeader($this->authHeader)
            );
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            throw $e;
        }
        // @codeCoverageIgnoreEnd

        return json_decode($response->getBody()->getContents());
    }
}
