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

/* extension/extension/module.twig */
class __TwigTemplate_7c9f91294acab16a6bf10d44ca6d9bca8de7dc9fca36dd99e4e58efa90017ef2 extends \Twig\Template
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
        echo ($context["promotion"] ?? null);
        echo "
<fieldset>
  <legend>";
        // line 3
        echo ($context["heading_title"] ?? null);
        echo "</legend>
  ";
        // line 4
        if (($context["error_warning"] ?? null)) {
            // line 5
            echo "  <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>
  ";
        }
        // line 9
        echo "  ";
        if (($context["success"] ?? null)) {
            // line 10
            echo "  <div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>
  ";
        }
        // line 14
        echo "  <div class=\"alert alert-info\"><i class=\"fa fa-info-circle\"></i> ";
        echo ($context["text_layout"] ?? null);
        echo "</div>
  <div class=\"table-responsive\">
    <table class=\"table table-bordered table-hover\">
      <thead>
        <tr>
          <td class=\"text-left\">";
        // line 19
        echo ($context["column_name"] ?? null);
        echo "</td>
          <td class=\"text-left\">";
        // line 20
        echo ($context["column_status"] ?? null);
        echo "</td>
          <td class=\"text-right\">";
        // line 21
        echo ($context["column_action"] ?? null);
        echo "</td>
        </tr>
      </thead>
      <tbody>
      
      ";
        // line 26
        if (($context["extensions"] ?? null)) {
            // line 27
            echo "      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["extensions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                // line 28
                echo "      <tr>
        <td><b>";
                // line 29
                echo twig_get_attribute($this->env, $this->source, $context["extension"], "name", [], "any", false, false, false, 29);
                echo "</b></td>
        <td>";
                // line 30
                echo twig_get_attribute($this->env, $this->source, $context["extension"], "status", [], "any", false, false, false, 30);
                echo "</td>
        <td class=\"text-right\">";
                // line 31
                if (twig_get_attribute($this->env, $this->source, $context["extension"], "installed", [], "any", false, false, false, 31)) {
                    // line 32
                    echo "          ";
                    if (twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 32)) {
                        echo " <a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["extension"], "edit", [], "any", false, false, false, 32);
                        echo "\" data-toggle=\"tooltip\" title=\"";
                        echo ($context["button_add"] ?? null);
                        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></a> ";
                    } else {
                        echo " <a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["extension"], "edit", [], "any", false, false, false, 32);
                        echo "\" data-toggle=\"tooltip\" title=\"";
                        echo ($context["button_edit"] ?? null);
                        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a> ";
                    }
                    // line 33
                    echo "          ";
                } else {
                    // line 34
                    echo "          <button type=\"button\" class=\"btn btn-primary\" disabled=\"disabled\"><i class=\"fa fa-pencil\"></i></button>
          ";
                }
                // line 36
                echo "          ";
                if ( !twig_get_attribute($this->env, $this->source, $context["extension"], "installed", [], "any", false, false, false, 36)) {
                    echo "<a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["extension"], "install", [], "any", false, false, false, 36);
                    echo "\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["button_install"] ?? null);
                    echo "\" class=\"btn btn-success\"><i class=\"fa fa-plus-circle\"></i></a> ";
                } else {
                    echo " <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["extension"], "uninstall", [], "any", false, false, false, 36);
                    echo "\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["button_uninstall"] ?? null);
                    echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></a>";
                }
                echo "</td>
      </tr>
      ";
                // line 38
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["extension"], "module", [], "any", false, false, false, 38));
                foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                    // line 39
                    echo "      <tr>
        <td class=\"text-left\">&nbsp;&nbsp;&nbsp;<i class=\"fa fa-folder-open\"></i>&nbsp;&nbsp;&nbsp;";
                    // line 40
                    echo twig_get_attribute($this->env, $this->source, $context["module"], "name", [], "any", false, false, false, 40);
                    echo "</td>
        <td class=\"text-left\">";
                    // line 41
                    echo twig_get_attribute($this->env, $this->source, $context["module"], "status", [], "any", false, false, false, 41);
                    echo "</td>
        <td class=\"text-right\"><a href=\"";
                    // line 42
                    echo twig_get_attribute($this->env, $this->source, $context["module"], "edit", [], "any", false, false, false, 42);
                    echo "\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["button_edit"] ?? null);
                    echo "\" class=\"btn btn-info\"><i class=\"fa fa-pencil\"></i></a> <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["module"], "delete", [], "any", false, false, false, 42);
                    echo "\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["button_delete"] ?? null);
                    echo "\" class=\"btn btn-warning\"><i class=\"fa fa-trash-o\"></i></a></td>
      </tr>
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 45
                echo "      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 46
            echo "      ";
        } else {
            // line 47
            echo "      <tr>
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
";
    }

    public function getTemplateName()
    {
        return "extension/extension/module.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  200 => 51,  194 => 48,  191 => 47,  188 => 46,  182 => 45,  167 => 42,  163 => 41,  159 => 40,  156 => 39,  152 => 38,  134 => 36,  130 => 34,  127 => 33,  112 => 32,  110 => 31,  106 => 30,  102 => 29,  99 => 28,  94 => 27,  92 => 26,  84 => 21,  80 => 20,  76 => 19,  67 => 14,  59 => 10,  56 => 9,  48 => 5,  46 => 4,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/extension/module.twig", "");
    }
}
