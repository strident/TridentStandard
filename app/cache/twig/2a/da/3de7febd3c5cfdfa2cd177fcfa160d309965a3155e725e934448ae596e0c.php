<?php

/* SeerUKTestModule:Test:index.html.twig */
class __TwigTemplate_2ada3de7febd3c5cfdfa2cd177fcfa160d309965a3155e725e934448ae596e0c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <p>Hello ";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo "!</p>
    <p>Welcome to Trident.</p>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "SeerUKTestModule:Test:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 7,  19 => 1,);
    }
}
