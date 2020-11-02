<?php declare(strict_types=1);

namespace JustSteveKing\Laravel\Envoyer\SDK\Resources;

use JustSteveKing\PhpSdk\Resources\AbstractResource;

class Project extends AbstractResource
{
    protected string $path = 'api/projects';

    public function all():? object
    {
        return json_decode($this->get()->getBody()->getContents());
    }

    public function servers($identifier = nill):? object
    {
        //
    }
}
