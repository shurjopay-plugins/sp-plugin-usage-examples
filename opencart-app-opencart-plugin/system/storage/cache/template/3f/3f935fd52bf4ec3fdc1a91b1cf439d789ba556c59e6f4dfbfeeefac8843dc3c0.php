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
class __TwigTemplate_80c385e740950502dd62049c6294f0bb2f49ac3bd08ff44618d94dff2bfa8508 extends \Twig\Template
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
    <input type=\"hidden\" name=\"merchant_prefix\" value=\"";
        // line 5
        echo ($context["merchant_prefix"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"currency\" value=\"";
        // line 6
        echo ($context["currency"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"name\" value=\"";
        // line 7
        echo ($context["name"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"address\" value=\"";
        // line 8
        echo ($context["address"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"email\" value=\"";
        // line 9
        echo ($context["email"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"phone\" value=\"";
        // line 10
        echo ($context["phone"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"city\" value=\"";
        // line 11
        echo ($context["city"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"state\" value=\"";
        // line 12
        echo ($context["state"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"postcode\" value=\"";
        // line 13
        echo ($context["postcode"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"country\" value=\"";
        // line 14
        echo ($context["country"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"userIP\" value=\"";
        // line 15
        echo ($context["userIP"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"paymentOption\" value=\"";
        // line 16
        echo ($context["paymentOption"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"amount\" value=\"";
        // line 17
        echo ($context["amount"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"returnUrl\" value=\"";
        // line 18
        echo ($context["returnUrl"] ?? null);
        echo "\" />
    <input type=\"hidden\" name=\"cancel_url\" value=\"";
        // line 19
        echo ($context["cancel_url"] ?? null);
        echo "\" />
    <div class=\"buttons\">
        <div class=\"pull-right\">
            <input type=\"submit\" value=\"";
        // line 22
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
        return array (  116 => 22,  110 => 19,  106 => 18,  102 => 17,  98 => 16,  94 => 15,  90 => 14,  86 => 13,  82 => 12,  78 => 11,  74 => 10,  70 => 9,  66 => 8,  62 => 7,  58 => 6,  54 => 5,  50 => 4,  46 => 3,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/extension/payment/shurjopay.twig", "");
    }
}
