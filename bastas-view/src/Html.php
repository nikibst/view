<?php

namespace Bastas\View;

use Bastas\View\Exception\ViewException;


class Html extends View implements ViewInterface
{
    private $content;

    public function render() : string
    {
        if(!$this->templateIsSet()) {
            throw new ViewException("Template has not been set.");
        }

        $template = $this->getTemplate();

        ob_start();
        include $template;
        $this->content = ob_get_clean();

        return $this->content;
    }
}