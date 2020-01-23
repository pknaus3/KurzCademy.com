<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* D:\Web-Development\htdocs\KurzCademy.com/themes/KurzCademy/pages/index.htm */
class __TwigTemplate_96be3f6b487b88de980a14d7fa8a3a066005a78b011ba756ceaedc1d17c87a58 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "D:\\Web-Development\\htdocs\\KurzCademy.com/themes/KurzCademy/pages/index.htm";
    }

    public function getDebugInfo()
    {
        return array ();
    }

    public function getSourceContext()
    {
        return new Source("", "D:\\Web-Development\\htdocs\\KurzCademy.com/themes/KurzCademy/pages/index.htm", "");
    }
}
