<?php


namespace MyProject\Views;


class View
{
    private $templatePath;

    public function __construct($templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function renderHtml(string $pagePath, array $params = [], int $code = 200): void
    {
        http_response_code($code);
        extract($params);
        require __DIR__ . $this->templatePath . '/' . $pagePath;
    }
}