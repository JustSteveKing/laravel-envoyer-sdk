<?php declare(strict_types=1);

namespace JustSteveKing\Laravel\Envoyer\SDK\Resources;

class Collaborator extends EnvoyerResource
{
    protected string $path = 'collaborators';

    public function invite(array $data)
    {
        try {
            $response = $this->http()->post(
                $this->uri()->toString(),
                $data,
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
