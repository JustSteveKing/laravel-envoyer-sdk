<?php declare(strict_types=1);

namespace JustSteveKing\Laravel\Envoyer\SDK\Resources;

use JustSteveKing\PhpSdk\Resources\AbstractResource;

class Action extends AbstractResource
{
    protected string $path = 'api/actions';

    public function all():? object
    {
        return json_decode($this->get()->getBody()->getContents());
    }
}
