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

/* default/template/checkout/payment_method.twig */
class __TwigTemplate_3e9842a8cce675f1c35103fcead7bfd4d9379b4fad24e76e03286267ece33887 extends \Twig\Template
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
        if (($context["error_warning"] ?? null)) {
            // line 2
            echo "<div class=\"alert alert-warning alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "</div>
";
        }
        // line 4
        if (($context["payment_methods"] ?? null)) {
            // line 5
            echo "<p>";
            echo ($context["text_payment_method"] ?? null);
            echo "</p>
";
            // line 6
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["payment_methods"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["payment_method"]) {
                // line 7
                echo "<div class=\"radio\">
  <label>";
                // line 8
                if (((twig_get_attribute($this->env, $this->source, $context["payment_method"], "code", [], "any", false, false, false, 8) == ($context["code"] ?? null)) ||  !($context["code"] ?? null))) {
                    // line 9
                    echo "    ";
                    $context["code"] = twig_get_attribute($this->env, $this->source, $context["payment_method"], "code", [], "any", false, false, false, 9);
                    // line 10
                    echo "    <input type=\"radio\" name=\"payment_method\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["payment_method"], "code", [], "any", false, false, false, 10);
                    echo "\" checked=\"checked\" />
    ";
                } else {
                    // line 12
                    echo "    <input type=\"radio\" name=\"payment_method\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["payment_method"], "code", [], "any", false, false, false, 12);
                    echo "\" />
    ";
                }
                // line 14
                echo "    ";
                echo twig_get_attribute($this->env, $this->source, $context["payment_method"], "title", [], "any", false, false, false, 14);
                echo "
    ";
                // line 15
                if (twig_get_attribute($this->env, $this->source, $context["payment_method"], "terms", [], "any", false, false, false, 15)) {
                    // line 16
                    echo "    (";
                    echo twig_get_attribute($this->env, $this->source, $context["payment_method"], "terms", [], "any", false, false, false, 16);
                    echo ")
    ";
                }
                // line 17
                echo " </label>
</div>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['payment_method'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 21
        echo "<p><strong>";
        echo ($context["text_comments"] ?? null);
        echo "</strong></p>
<p>
  <textarea name=\"comment\" rows=\"8\" class=\"form-control\">";
        // line 23
        echo ($context["comment"] ?? null);
        echo "</textarea>
</p>
";
        // line 25
        if (($context["text_agree"] ?? null)) {
            // line 26
            echo "<div class=\"buttons\">
  <div class=\"pull-right\">";
            // line 27
            echo ($context["text_agree"] ?? null);
            echo "
    ";
            // line 28
            if (($context["agree"] ?? null)) {
                // line 29
                echo "    <input type=\"checkbox\" name=\"agree\" value=\"1\" checked=\"checked\" />
    ";
            } else {
                // line 31
                echo "    <input type=\"checkbox\" name=\"agree\" value=\"1\" />
    ";
            }
            // line 33
            echo "    &nbsp;
    <input type=\"button\" value=\"";
            // line 34
            echo ($context["button_continue"] ?? null);
            echo "\" id=\"button-payment-method\" data-loading-text=\"";
            echo ($context["text_loading"] ?? null);
            echo "\" class=\"btn btn-primary\" />
  </div>
</div>
";
        } else {
            // line 38
            echo "<div class=\"buttons\">
  <div class=\"pull-right\">
    <input type=\"button\" value=\"";
            // line 40
            echo ($context["button_continue"] ?? null);
            echo "\" id=\"button-payment-method\" data-loading-text=\"";
            echo ($context["text_loading"] ?? null);
            echo "\" class=\"btn btn-primary\" />
  </div>
</div>
";
        }
        // line 43
        echo " ";
    }

    public function getTemplateName()
    {
        return "default/template/checkout/payment_method.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 43,  144 => 40,  140 => 38,  131 => 34,  128 => 33,  124 => 31,  120 => 29,  118 => 28,  114 => 27,  111 => 26,  109 => 25,  104 => 23,  98 => 21,  89 => 17,  83 => 16,  81 => 15,  76 => 14,  70 => 12,  64 => 10,  61 => 9,  59 => 8,  56 => 7,  52 => 6,  47 => 5,  45 => 4,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/checkout/payment_method.twig", "");
    }
}
