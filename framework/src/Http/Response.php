<?php

namespace PhillipMwaniki\Framework\Http;

class Response
{
    use HttpResponseTrait;

    public function __construct(
        private ?string $content = '',
        private int $status = 200,
        private array $headers = []
    ) {
        // Must be set before sending content
        // So best to create an instantiation like here
        http_response_code($this->status);
    }

    public function send(): void
    {
        echo $this->content;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }


}
