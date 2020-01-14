<?php
declare(strict_types=1);

namespace App\Entity;

class Joke
{
    /** @var String */
    private $text;

    public function __construct(String $joke)
    {
        $this->text = $joke;
    }

    public function text(): String
    {
        return $this->text;
    }
}
