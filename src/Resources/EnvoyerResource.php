<?php declare(strict_types=1);

namespace JustSteveKing\Laravel\Envoyer\SDK\Resources;

use JustSteveKing\PhpSdk\Resources\AbstractResource;

class EnvoyerResource extends AbstractResource
{
    /**
     * @var string|null
     */
    protected ?string $project = null;

    /**
     * Set which project this resource belongs to
     *
     * @param $project
     * @return $this
     */
    public function on($project): self
    {
        $this->uri()->addPath(
            "api/projects/{$project}/{$this->path}"
        );

        $this->project = (string) $project;

        return $this;
    }

    /**
     * Get all Resources
     *
     * @return object|null
     */
    public function all():? object
    {
        return json_decode($this->get()->getBody()->getContents());
    }

    /**
     * Save a new Resource
     *
     * @param array $data
     * @return object|null
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function save(array $data):? object
    {
        return \json_decode(
            $this->create($data)->getBody()->getContents(),
            false
        );
    }

    /**
     * Get the first Resource with an identifier
     *
     * @param mixed $identifier
     * @return object|null
     */
    public function first($identifier):? object
    {
        return json_decode($this->find($identifier)->getBody()->getContents());
    }

    public function modify($identifier, array $data):? object
    {
        $this->uri()->addPath(
            "{$this->uri()->path()}/{$identifier}"
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

        return json_decode($response->getBody()->getContents());
    }

    public function remove($identifier = null):? object
    {
        if (! is_null($identifier)) {
            $this->uri()->addPath(
                "{$this->uri()->path()}/{$identifier}"
            );
        }

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
