<?php

namespace App\Event;

use App\Entity\Annoucement;
use Symfony\Contracts\EventDispatcher\Event;

class AddAnnoucementEvent extends Event
{
    public const ADD_ANNOUCEMENT_EVENT = 'annoucement.add';

    public function __construct(private Annoucement $annoucement)
    {
    }

    public function getPersonne(): Annoucement
    {
        return $this->annoucement;
    }
}
