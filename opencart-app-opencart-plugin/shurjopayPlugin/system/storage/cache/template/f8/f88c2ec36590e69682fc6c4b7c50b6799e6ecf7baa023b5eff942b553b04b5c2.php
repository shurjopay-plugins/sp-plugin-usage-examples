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

/* default/template/extension/payment/shurjopay.twig */
class __TwigTemplate_ea19f12d7adbd81c417405cd4b684caf90c51bfdd609ca1f0419bb6cf40c0b2d extends \Twig\Template
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
        echo "<form action=\"";
        echo ($context["action"] ?? null);
        echo "\" method=\"post\">
    <input type=\"hidden\" name=\"pay_to_username\" value=\"";
        // line 2
        echo ($context["pay_to_username"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"pay_to_password\" value=\"";
        // line 3
        echo ($context["pay_to_password"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"uniq_transaction_key\" value=\"";
        // line 4
        echo ($context["uniq_transaction_key"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"userIP\" value=\"";
        // line 5
        echo ($context["userIP"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"paymentOption\" value=\"";
        // line 6
        echo ($context["paymentOption"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"amount\" value=\"";
        // line 7
        echo ($context["amount"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"returnUrl\" value=\"";
        // line 8
        echo ($context["returnUrl"] ?? null);
        echo "\" />
    <div class=\"buttons\">
        <div class=\"pull-right\">
            <input type=\"submit\" value=\"";
        // line 11
        echo ($context["button_confirm"] ?? null);
        echo "\" class=\"btn btn-primary\" />
        </div>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "default/template/extension/payment/shurjopay.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 11,  66 => 8,  62 => 7,  58 => 6,  54 => 5,  50 => 4,  46 => 3,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/extension/payment/shurjopay.twig", "");
    }
}
