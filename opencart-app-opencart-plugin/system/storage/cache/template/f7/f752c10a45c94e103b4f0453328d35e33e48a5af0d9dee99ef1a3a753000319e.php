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

/* extension/extension/advertise.twig */
class __TwigTemplate_46be7b0c6d2704873d4b4d55973d75b657d413c923ae51f2ea64b3290d7488e0 extends \Twig\Template
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
        echo "<fieldset>
  <legend>";
        // line 2
        echo ($context["heading_title"] ?? null);
        echo "</legend>
  <div id=\"blockerError\" style=\"display: none;\" class=\"alert alert-danger\">
    <i class=\"fa fa-exclamation-circle\"></i> ";
        // line 4
        echo ($context["error_adblock"] ?? null);
        echo "
  </div>
  ";
        // line 6
        if (($context["error_warning"] ?? null)) {
            // line 7
            echo "  <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>
  ";
        }
        // line 11
        echo "  ";
        if (($context["success"] ?? null)) {
            // line 12
            echo "  <div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>
  ";
        }
        // line 16
        echo "  <div class=\"table-responsive\">
    <table class=\"table table-bordered table-hover\">
      <thead>
        <tr>
          <td class=\"text-left\">";
        // line 20
        echo ($context["column_name"] ?? null);
        echo "</td>
          <td class=\"text-left\">";
        // line 21
        echo ($context["column_status"] ?? null);
        echo "</td>
          <td class=\"text-right\">";
        // line 22
        echo ($context["column_action"] ?? null);
        echo "</td>
        </tr>
      </thead>
      <tbody>
        ";
        // line 26
        if (($context["extensions"] ?? null)) {
            // line 27
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["extensions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                // line 28
                echo "        <tr>
          <td class=\"text-left\" colspan=\"2\"><b>";
                // line 29
                echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 29);
                echo "</b></td>
          <td class=\"text-right\">";
                // line 30
                if ( !twig_get_attribute($this->env, $this->source, $context["extension"], "installed", [], "any", false, false, false, 30)) {
                    // line 31
                    echo "            <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["extension"], "install", [], "any", false, false, false, 31);
                    echo "\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["button_install"] ?? null);
                    echo "\" class=\"btn btn-success\"><i class=\"fa fa-plus-circle\"></i></a>
            ";
                } else {
                    // line 33
                    echo "            <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["extension"], "uninstall", [], "any", false, false, false, 33);
                    echo "\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["button_uninstall"] ?? null);
                    echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></a>
            ";
                }
                // line 34
                echo "</td>
        </tr>
        ";
                // line 36
                if (twig_get_attribute($this->env, $this->source, $context["extension"], "installed", [], "any", false, false, false, 36)) {
                    // line 37
                    echo "        ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["extension"], "store", [], "any", false, false, false, 37));
                    foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
                        // line 38
                        echo "        <tr>
          <td class=\"text-left\">&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;";
                        // line 39
                        echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 39);
                        echo "</td>
          <td class=\"text-left\">";
                        // line 40
                        echo twig_get_attribute($this->env, $this->source, $context["store"], "status", [], "any", false, false, false, 40);
                        echo "</td>
          <td class=\"text-right\"><a href=\"";
                        // line 41
                        echo twig_get_attribute($this->env, $this->source, $context["store"], "edit", [], "any", false, false, false, 41);
                        echo "\" data-toggle=\"tooltip\" title=\"";
                        echo ($context["button_edit"] ?? null);
                        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a></td>
        </tr>
        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 44
                    echo "        ";
                }
                // line 45
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 46
            echo "        ";
        } else {
            // line 47
            echo "        <tr>
          <td class=\"text-center\" colspan=\"3\">";
            // line 48
            echo ($context["text_no_results"] ?? null);
            echo "</td>
        </tr>
        ";
        }
        // line 51
        echo "      </tbody>
    </table>
  </div>
</fieldset>
<style type=\"text/css\">
  .adBanner {
      background-color: transparent;
      height: 1px;
      width: 1px;
  }
</style>
<div id=\"wrapTest\">
    <div class=\"adBanner\">
    </div>
</div>
<script type=\"text/javascript\">
  (function(\$) {
    \$(document).ready(function() {
      \$('#blockerError').toggle(\$(\"#wrapTest\").height() == 0);
    });
  })(jQuery);
</script>";
    }

    public function getTemplateName()
    {
        return "extension/extension/advertise.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 51,  172 => 48,  169 => 47,  166 => 46,  160 => 45,  157 => 44,  146 => 41,  142 => 40,  138 => 39,  135 => 38,  130 => 37,  128 => 36,  124 => 34,  116 => 33,  108 => 31,  106 => 30,  102 => 29,  99 => 28,  94 => 27,  92 => 26,  85 => 22,  81 => 21,  77 => 20,  71 => 16,  63 => 12,  60 => 11,  52 => 7,  50 => 6,  45 => 4,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/extension/advertise.twig", "");
    }
}
