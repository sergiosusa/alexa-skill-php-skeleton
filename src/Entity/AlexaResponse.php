<?php
declare(strict_types=1);

namespace App\Entity;

class AlexaResponse
{
    /** @var String */
    public $text;
    /** @var bool */
    public $shouldEndSession;

    public function __construct(String $text, bool $shouldEndSession)
    {
        $this->text = $text;
        $this->shouldEndSession = $shouldEndSession;
    }

    public function text(): String
    {
        return $this->text;
    }

    public function shouldEndSession(): bool
    {
        return $this->shouldEndSession;
    }
}
