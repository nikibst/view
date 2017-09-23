<?php

namespace Bastas\View;


class View
{
    protected $template = null;
    protected $children = [];

    public function __call($helper, $params)
    {
        return new $helper(implode(', ', $params));
    }

    public function __get($param)
    {
        if (!isset($this->children[$param])) {
            return false;
        }

        if ($this->children[$param] instanceof ViewInterface) {
            $this->children[$param] = $this->children[$param]->render();
        }

        return $this->children[$param];

    }

    public function __set($param, $value)
    {
        $this->$param = $value;

        return $this;
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function templateIsSet(): bool
    {
        return isset($this->template);
    }

    public function addChild(string $childName, ViewInterface $view)
    {
        $this->children[$childName] = $view;

        return $this;
    }

    // TODO: Implement methods hasChildren, removeChild, etc...?


}