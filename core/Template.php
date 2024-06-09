<?php

namespace core;

class Template
{
    protected string $templateFilePath;
    protected array $paramsArray;

    public function __set($name, $value)
    {
        Core::getInstance()->template->setParam($name, $value);
    }

    public function __construct($templateFilePath)
    {
        $this->templateFilePath = $templateFilePath;
        $this->paramsArray = [];
    }

    public function setTemplateFilePath($path): void
    {
        $this->templateFilePath = $path;
    }

    public function setParam($paramName, $paramValue): void
    {
        $this->paramsArray[$paramName] = $paramValue;
    }

    public function setParams($params): void
    {
        foreach ($params as $key => $value) {
            $this->setParam($key, $value);
        }
    }

    public function getHTML(): string
    {
        ob_start();
        extract($this->paramsArray);
        include($this->templateFilePath);
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }

    public function display(): void
    {
        echo $this->getHTML();
    }
}