<?php declare(strict_types=1);

namespace JustSteveKing\Laravel\Envoyer\SDK\Resources;

class Project extends EnvoyerResource
{
    protected string $path = 'api/projects';

    public function updateSource($identifier, array $data):? object
    {
        $this->uri()->addPath(
            "{$this->uri()->path()}/{$identifier}/source"
        );

        try {
            $response = $this->http()->put(
                $this->uri()->toString(),
                $data,
                $this->strategy()->getHeader($this->authHeader)
            );
            // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            throw $e;
        }
        // @codeCoverageIgnoreEnd;
        return \json_decode(
            $response->getBody()->getContents(),
            false
        );
    }
}
