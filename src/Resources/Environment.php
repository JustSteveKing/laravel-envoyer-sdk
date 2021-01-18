<?php declare(strict_types=1);

namespace JustSteveKing\Laravel\Envoyer\SDK\Resources;

class Environment extends EnvoyerResource
{
    protected ?string $key = null;

    protected array $servers;

    protected string $path = 'environment';

    public function key($key): self
    {
        $this->key = (string) $key;
        $this->uri()->addQueryParam('key', $key);

        return $this;
    }

    public function servers():? object
    {
        $this->uri()->addPath(
            "{$this->uri()->path()}/servers"
        );

        return json_decode($this->get()->getBody()->getContents());
    }

    public function onServer(...$servers): self
    {
        $this->servers = $servers;

        return $this;
    }

    public function put(...$data):? object
    {
        $data = array_merge([
            'key' => $this->key,
        ], [
            'contents' => implode("\n", $data),
        ]);

        if (! empty($this->servers)) {
            $data['servers'] = array_values($this->servers);
        }

        $response = $this->http->put(
            $this->uri->toString(),
            $data,
            $this->strategy()->getHeader($this->authHeader)
        );

        return json_decode($response->getBody()->getContents());
    }

    public function reset($key):? object
    {
        $this->uri()->addQueryParam('key', (string) $key);

        try {
            $response = $this->http()->delete(
                $this->uri()->toString(),
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
