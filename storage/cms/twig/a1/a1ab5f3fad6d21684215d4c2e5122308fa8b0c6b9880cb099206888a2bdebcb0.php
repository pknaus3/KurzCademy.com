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

/* D:\Web-Development\htdocs\KurzCademy.com/themes/KurzCademy/layouts/Default.htm */
class __TwigTemplate_43488de22a47552c74b6ada4936f5107167ef6f8e010eb8857299eedf4a08e60 extends \Twig\Template
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
        echo "<!DOCTYPE html>
<html lang=\"en\" dir=\"ltr\">
  <head>
    <meta charset=\"utf-8\">

    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 6
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/CSS/MainStyle.css");
        echo " \" />
    <link rel=\"profile\" href=\"http://gmpg.org/xfn/11\">

                    <!-- Extensions for web (Somethink as bootstrap) -->
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\" integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\" crossorigin=\"anonymous\">
    <script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\" integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\"></script>
    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\" integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\" crossorigin=\"anonymous\"></script>
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
                    <!-- meta Settings -->
    <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"description\" content=\"KurzCademy je aplikácia na vytváranie a zdieľanie kurzov.\" />
    <meta name=\"keywords\" content=\"kurz development, kurzy, editor kurzov, vutvaranie kurzov, vlastne kurzy\" />
    <meta name=\"robots\" content=\"index, follow\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  </head>
  <body>

    ";
        // line 24
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("session"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 25
        echo "
    ";
        // line 26
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("header.htm"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 27
        echo "
    ";
        // line 28
        echo $this->env->getExtension('Cms\Twig\Extension')->pageFunction();
        // line 29
        echo "
    ";
        // line 30
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("footer.htm"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 31
        echo "
  </body>
</html>";
    }

    public function getTemplateName()
    {
        return "D:\\Web-Development\\htdocs\\KurzCademy.com/themes/KurzCademy/layouts/Default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 31,  84 => 30,  81 => 29,  79 => 28,  76 => 27,  72 => 26,  69 => 25,  65 => 24,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\" dir=\"ltr\">
  <head>
    <meta charset=\"utf-8\">

    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ 'assets/CSS/MainStyle.css' | theme }} \" />
    <link rel=\"profile\" href=\"http://gmpg.org/xfn/11\">

                    <!-- Extensions for web (Somethink as bootstrap) -->
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\" integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\" crossorigin=\"anonymous\">
    <script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\" integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\"></script>
    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\" integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\" crossorigin=\"anonymous\"></script>
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
                    <!-- meta Settings -->
    <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
    <meta name=\"description\" content=\"KurzCademy je aplikácia na vytváranie a zdieľanie kurzov.\" />
    <meta name=\"keywords\" content=\"kurz development, kurzy, editor kurzov, vutvaranie kurzov, vlastne kurzy\" />
    <meta name=\"robots\" content=\"index, follow\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  </head>
  <body>

    {% component 'session' %}

    {% partial \"header.htm\" %}

    {% page %}

    {% partial \"footer.htm\" %}

  </body>
</html>", "D:\\Web-Development\\htdocs\\KurzCademy.com/themes/KurzCademy/layouts/Default.htm", "");
    }
}
