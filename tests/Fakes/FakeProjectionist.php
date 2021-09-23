<?php

namespace Mannum\ZeroDowntimeEventReplays\Tests\Fakes;

use Illuminate\Support\Collection;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Spatie\EventSourcing\Projectionist;

class FakeProjectionist extends Projectionist
{
    public array $projectors = [];

    public array $replays = [];

    public function __construct()
    {
    }

    public function addProjector($projector, ?Projector $class = null): Projectionist
    {
        $this->projectors[$projector] = $class ?? new FakeProjector();

        return $this;
    }

    public function getProjector(string $name): ?Projector
    {
        return $this->projectors[$name] ?? null;
    }

    public function replay(Collection $projectors, int $startingFromEventId = 0, callable $onEventReplayed = null): void
    {
        $this->replays[] = [
            'projectors' => $projectors,
            'startingFrom' => $startingFromEventId,
        ];
    }
}
