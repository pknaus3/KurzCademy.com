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

/* D:\Web-Development\htdocs\KurzCademy.com/themes/KurzCademy/partials/header.htm */
class __TwigTemplate_76349af3138bcab281e93d8f19516c25339e75893508bc6e4a468a2b2cf107c1 extends \Twig\Template
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
        // line 1
        echo "<?php
";
        // line 2
        if (($context["user"] ?? null)) {
            // line 3
            echo "    ?><p>Hello ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "name", [], "any", false, false, false, 3), "html", null, true);
            echo "</p><?php
";
        } else {
            // line 5
            echo "     ?><p>Log in</p><?php
";
        }
        // line 7
        echo "?>";
    }

    public function getTemplateName()
    {
        return "D:\\Web-Development\\htdocs\\KurzCademy.com/themes/KurzCademy/partials/header.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 7,  48 => 5,  42 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<?php
{% if user %}
    ?><p>Hello {{ user.name }}</p><?php
{% else %}
     ?><p>Log in</p><?php
{% endif %}
?>", "D:\\Web-Development\\htdocs\\KurzCademy.com/themes/KurzCademy/partials/header.htm", "");
    }
}
