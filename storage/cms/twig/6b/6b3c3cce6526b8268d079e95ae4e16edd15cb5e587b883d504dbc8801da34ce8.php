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

/* D:\Web-Development\htdocs\KurzCademy.com/themes/KurzCademy/pages/register.htm */
class __TwigTemplate_3898270aac1c5467593a89f86453fc3d771934054f66ebe1d70d4b2578bf12cc extends \Twig\Template
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
        echo "<form data-request=\"onRegister\">
    <label>Full Name</label>
    <input name=\"name\" type=\"text\" placeholder=\"Enter your full name\">

    <label>Email</label>
    <input name=\"email\" type=\"email\" placeholder=\"Enter your email\">

    <label>Username</label>
    <input name=\"username\" placeholder=\"Pick a login name\">

    <label>Password</label>
    <input name=\"password\" type=\"password\" placeholder=\"Choose a password\">

    <button type=\"submit\">Register</button>
</form>";
    }

    public function getTemplateName()
    {
        return "D:\\Web-Development\\htdocs\\KurzCademy.com/themes/KurzCademy/pages/register.htm";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<form data-request=\"onRegister\">
    <label>Full Name</label>
    <input name=\"name\" type=\"text\" placeholder=\"Enter your full name\">

    <label>Email</label>
    <input name=\"email\" type=\"email\" placeholder=\"Enter your email\">

    <label>Username</label>
    <input name=\"username\" placeholder=\"Pick a login name\">

    <label>Password</label>
    <input name=\"password\" type=\"password\" placeholder=\"Choose a password\">

    <button type=\"submit\">Register</button>
</form>", "D:\\Web-Development\\htdocs\\KurzCademy.com/themes/KurzCademy/pages/register.htm", "");
    }
}
