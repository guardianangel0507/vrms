<?php
class Template
{
    // Path to Template
    protected $templatePath;

    // arguments Passed In
    protected $args = array();

    // Constructor
    public function __construct($templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function __get($key)
    {
        return $this->args[$key];
    }

    public function __set($key, $value)
    {
        $this->args[$key] = $value;
    }

    public function __toString()
    {
        extract($this->args);
        chdir(dirname($this->templatePath));
        ob_start();

        include basename($this->templatePath);

        return ob_get_clean();
    }
}
