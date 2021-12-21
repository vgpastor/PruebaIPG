<?php

declare(strict_types=1);

namespace App\Application\Domain;

class PostBodyValidator
{
    public function execute(string $body): string
    {
        if (!$this->isLengthValid($body)) {
            throw new \InvalidArgumentException('Body is too short');
        }

        $body = $this->removeDangerousHTMLChars($body);

        return $body;
    }

    private function isLengthValid(string $body): bool
    {
        return mb_strlen($body) >= 100;
    }

    private function removeDangerousHTMLChars(string $body): string
    {
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $body);

        if (is_null($html)) {
            throw new \InvalidArgumentException('Body contains invalid HTML');
        }

        return $html;
    }
}
