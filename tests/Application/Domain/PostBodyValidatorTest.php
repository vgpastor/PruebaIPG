<?php

declare(strict_types=1);

namespace App\Tests\Application\Domain;

use App\Application\Domain\PostBodyValidator;
use PHPUnit\Framework\TestCase;

class PostBodyValidatorTest extends TestCase
{
    private string $body = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';

    final public function testExecute(): void
    {
        $postBodyValidator = new PostBodyValidator();
        $this->assertEquals($this->body, $postBodyValidator->execute($this->body));
    }

    final public function testWithShortBody(): void
    {
        $postBodyValidator = new PostBodyValidator();
        try {
            $postBodyValidator->execute('');
        } catch (\Exception $e) {
            $this->assertEquals('Body is too short', $e->getMessage());
        }
    }

    final public function testHTMLScriptTagRemoved(): void
    {
        $postBodyValidator = new PostBodyValidator();
        $html = $postBodyValidator->execute($this->body.'<script>alert("XSS")</script>');
        $this->assertEquals($this->body, $html);
    }
}
