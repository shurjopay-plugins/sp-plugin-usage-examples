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

/* extension/payment/shurjopay.twig */
class __TwigTemplate_abf05ca86d8e4d83c0dde22d79d7ad1a4d54e857e977058daadcfadb3dbeb998 extends \Twig\Template
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
        echo ($context["header"] ?? null);
        echo ($context["column_left"] ?? null);
        echo "
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <button type=\"submit\" form=\"form-payment\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 7
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a></div>
      <h1>";
        // line 8
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 11
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 11);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 11);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">
    ";
        // line 17
        if (($context["error_warning"] ?? null)) {
            // line 18
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 22
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 24
        echo ($context["text_edit"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 27
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-payment\" class=\"form-horizontal\">
        <input type=\"hidden\" name=\"payment_shurjopay_merchant_paymentOption\" value=\"shurjopay\" />


          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-sandbox\">";
        // line 32
        echo ($context["entry_merchant_sandbox"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">

            <input type=\"checkbox\" name=\"payment_shurjopay_merchant_sandbox\" value=\"1\"
            ";
        // line 36
        if (($context["payment_shurjopay_merchant_sandbox"] ?? null)) {
            echo "checked";
        }
        // line 37
        echo "            > 
            
            </div>
          </div>
          
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-username\">";
        // line 43
        echo ($context["entry_merchant_username"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_shurjopay_merchant_username\" value=\"";
        // line 45
        echo ($context["payment_shurjopay_merchant_username"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_merchant_username"] ?? null);
        echo "\" id=\"input-username\" class=\"form-control\" />
              ";
        // line 46
        if (($context["error_merchant_username"] ?? null)) {
            // line 47
            echo "              <div class=\"text-danger\">";
            echo ($context["error_merchant_username"] ?? null);
            echo "</div>
              ";
        }
        // line 49
        echo "            </div>
          </div>

          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-password\">";
        // line 53
        echo ($context["entry_merchant_password"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_shurjopay_merchant_password\" value=\"";
        // line 55
        echo ($context["payment_shurjopay_merchant_password"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_merchant_password"] ?? null);
        echo "\" id=\"input-password\" class=\"form-control\" />
              ";
        // line 56
        if (($context["error_merchant_password"] ?? null)) {
            // line 57
            echo "              <div class=\"text-danger\">";
            echo ($context["error_merchant_password"] ?? null);
            echo "</div>
              ";
        }
        // line 59
        echo "            </div>
          </div>

          

            <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-unique_key\">";
        // line 65
        echo ($context["entry_merchant_uniq_transaction_key"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_shurjopay_merchant_uniq_transaction_key\" value=\"";
        // line 67
        echo ($context["payment_shurjopay_merchant_uniq_transaction_key"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_merchant_uniq_transaction_key"] ?? null);
        echo "\" id=\"input-password\" class=\"form-control\" />
              ";
        // line 68
        if (($context["error_merchant_uniq_transaction_key"] ?? null)) {
            // line 69
            echo "              <div class=\"text-danger\">";
            echo ($context["error_merchant_uniq_transaction_key"] ?? null);
            echo "</div>
              ";
        }
        // line 71
        echo "            </div>
          </div>

          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-userIP\">";
        // line 75
        echo ($context["entry_merchant_userIP"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_shurjopay_merchant_userIP\" value=\"";
        // line 77
        echo ($context["payment_shurjopay_merchant_userIP"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_merchant_userIP"] ?? null);
        echo "\" id=\"input-password\" class=\"form-control\" />
              ";
        // line 78
        if (($context["error_merchant_userIP"] ?? null)) {
            // line 79
            echo "              <div class=\"text-danger\">";
            echo ($context["error_merchant_userIP"] ?? null);
            echo "</div>
              ";
        }
        // line 81
        echo "            </div>
          </div>

          
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-order-status\">";
        // line 86
        echo ($context["entry_order_status"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"payment_shurjopay_order_status_id\" id=\"input-order-status\" class=\"form-control\">
                ";
        // line 89
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 90
            echo "                ";
            if ((twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 90) == ($context["payment_shurjopay_order_status_id"] ?? null))) {
                // line 91
                echo "                <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 91);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 91);
                echo "</option>
                ";
            } else {
                // line 93
                echo "                <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 93);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 93);
                echo "</option>
                ";
            }
            // line 95
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        echo "              </select>
            </div>
          </div>

          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-status\">";
        // line 101
        echo ($context["entry_status"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"payment_shurjopay_status\" id=\"input-status\" class=\"form-control\">
                ";
        // line 104
        if (($context["payment_shurjopay_status"] ?? null)) {
            // line 105
            echo "                <option value=\"1\" selected=\"selected\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                <option value=\"0\">";
            // line 106
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                ";
        } else {
            // line 108
            echo "                <option value=\"1\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                <option value=\"0\" selected=\"selected\">";
            // line 109
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                ";
        }
        // line 111
        echo "              </select>
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-sort-order\">";
        // line 115
        echo ($context["entry_sort_order"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_shurjopay_sort_order\" value=\"";
        // line 117
        echo ($context["payment_shurjopay_sort_order"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_sort_order"] ?? null);
        echo "\" id=\"input-sort-order\" class=\"form-control\" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
";
        // line 125
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "extension/payment/shurjopay.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  326 => 125,  313 => 117,  308 => 115,  302 => 111,  297 => 109,  292 => 108,  287 => 106,  282 => 105,  280 => 104,  274 => 101,  267 => 96,  261 => 95,  253 => 93,  245 => 91,  242 => 90,  238 => 89,  232 => 86,  225 => 81,  219 => 79,  217 => 78,  211 => 77,  206 => 75,  200 => 71,  194 => 69,  192 => 68,  186 => 67,  181 => 65,  173 => 59,  167 => 57,  165 => 56,  159 => 55,  154 => 53,  148 => 49,  142 => 47,  140 => 46,  134 => 45,  129 => 43,  121 => 37,  117 => 36,  110 => 32,  102 => 27,  96 => 24,  92 => 22,  84 => 18,  82 => 17,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/payment/shurjopay.twig", "");
    }
}
