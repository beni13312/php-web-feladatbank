<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* server/binlog/index.twig */
class __TwigTemplate_c56998e8e55c5e9e4d039a1cad191626 extends Template
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
        yield "<h2>
  ";
        // line 2
        yield PhpMyAdmin\Html\Generator::getImage("s_tbl");
        yield "
  ";
yield _gettext("Binary log");
        // line 4
        yield "</h2>

<form action=\"";
        // line 6
        yield PhpMyAdmin\Url::getFromRoute("/server/binlog");
        yield "\" method=\"post\">
  ";
        // line 7
        yield PhpMyAdmin\Url::getHiddenInputs(($context["url_params"] ?? null));
        yield "
  <fieldset class=\"pma-fieldset\">
    <legend>
      ";
yield _gettext("Select binary log to view");
        // line 11
        yield "    </legend>

    ";
        // line 13
        $context["full_size"] = 0;
        // line 14
        yield "    <select name=\"log\">
      ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["binary_logs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["each_log"]) {
            // line 16
            yield "        <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_0 = $context["each_log"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["Log_name"] ?? null) : null), "html", null, true);
            yield "\"";
            // line 17
            yield ((((($__internal_compile_1 = $context["each_log"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["Log_name"] ?? null) : null) == ($context["log"] ?? null))) ? (" selected") : (""));
            yield ">
          ";
            // line 18
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_2 = $context["each_log"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["Log_name"] ?? null) : null), "html", null, true);
            yield "
          ";
            // line 19
            if (CoreExtension::getAttribute($this->env, $this->source, $context["each_log"], "File_size", [], "array", true, true, false, 19)) {
                // line 20
                yield "            (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join(PhpMyAdmin\Util::formatByteDown((($__internal_compile_3 = $context["each_log"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["File_size"] ?? null) : null), 3, 2), " "), "html", null, true);
                yield ")
            ";
                // line 21
                $context["full_size"] = (($context["full_size"] ?? null) + (($__internal_compile_4 = $context["each_log"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["File_size"] ?? null) : null));
                // line 22
                yield "          ";
            }
            // line 23
            yield "        </option>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['each_log'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        yield "    </select>
    ";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["binary_logs"] ?? null)), "html", null, true);
        yield "
    ";
yield _gettext("Files");
        // line 27
        yield ",
    ";
        // line 28
        if ((($context["full_size"] ?? null) > 0)) {
            // line 29
            yield "      ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join(PhpMyAdmin\Util::formatByteDown(($context["full_size"] ?? null)), " "), "html", null, true);
            yield "
    ";
        }
        // line 31
        yield "  </fieldset>

  <fieldset class=\"pma-fieldset tblFooters\">
    <input class=\"btn btn-primary\" type=\"submit\" value=\"";
yield _gettext("Go");
        // line 34
        yield "\">
  </fieldset>
</form>

";
        // line 38
        yield ($context["sql_message"] ?? null);
        yield "

<table class=\"table table-striped table-hover align-middle\" id=\"binlogTable\">
  <thead>
    <tr>
      <td colspan=\"6\" class=\"text-center\">
        ";
        // line 44
        if (($context["has_previous"] ?? null)) {
            // line 45
            yield "          ";
            if (($context["has_icons"] ?? null)) {
                // line 46
                yield "            <a href=\"";
                yield PhpMyAdmin\Url::getFromRoute("/server/binlog");
                yield "\" data-post=\"";
                yield PhpMyAdmin\Url::getCommon(($context["previous_params"] ?? null), "", false);
                yield "\" title=\"";
yield _pgettext("Previous page", "Previous");
                // line 47
                yield "\">
              &laquo;
            </a>
          ";
            } else {
                // line 51
                yield "            <a href=\"";
                yield PhpMyAdmin\Url::getFromRoute("/server/binlog");
                yield "\" data-post=\"";
                yield PhpMyAdmin\Url::getCommon(($context["previous_params"] ?? null), "", false);
                yield "\">
              ";
yield _pgettext("Previous page", "Previous");
                // line 52
                yield " &laquo;
            </a>
          ";
            }
            // line 55
            yield "          -
        ";
        }
        // line 57
        yield "
        ";
        // line 58
        if (($context["is_full_query"] ?? null)) {
            // line 59
            yield "          <a href=\"";
            yield PhpMyAdmin\Url::getFromRoute("/server/binlog");
            yield "\" data-post=\"";
            yield PhpMyAdmin\Url::getCommon(($context["full_queries_params"] ?? null), "", false);
            yield "\" title=\"";
yield _gettext("Truncate shown queries");
            yield "\">
            <img src=\"";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['PhpMyAdmin\Twig\AssetExtension']->getImagePath("s_partialtext.png"), "html", null, true);
            yield "\" alt=\"";
yield _gettext("Truncate shown queries");
            yield "\">
          </a>
        ";
        } else {
            // line 63
            yield "          <a href=\"";
            yield PhpMyAdmin\Url::getFromRoute("/server/binlog");
            yield "\" data-post=\"";
            yield PhpMyAdmin\Url::getCommon(($context["full_queries_params"] ?? null), "", false);
            yield "\" title=\"";
yield _gettext("Show full queries");
            yield "\">
            <img src=\"";
            // line 64
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['PhpMyAdmin\Twig\AssetExtension']->getImagePath("s_fulltext.png"), "html", null, true);
            yield "\" alt=\"";
yield _gettext("Show full queries");
            yield "\">
          </a>
        ";
        }
        // line 67
        yield "
        ";
        // line 68
        if (($context["has_next"] ?? null)) {
            // line 69
            yield "          -
          ";
            // line 70
            if (($context["has_icons"] ?? null)) {
                // line 71
                yield "            <a href=\"";
                yield PhpMyAdmin\Url::getFromRoute("/server/binlog");
                yield "\" data-post=\"";
                yield PhpMyAdmin\Url::getCommon(($context["next_params"] ?? null), "", false);
                yield "\" title=\"";
yield _pgettext("Next page", "Next");
                // line 72
                yield "\">
              &raquo;
            </a>
          ";
            } else {
                // line 76
                yield "            <a href=\"";
                yield PhpMyAdmin\Url::getFromRoute("/server/binlog");
                yield "\" data-post=\"";
                yield PhpMyAdmin\Url::getCommon(($context["next_params"] ?? null), "", false);
                yield "\">
              ";
yield _pgettext("Next page", "Next");
                // line 77
                yield " &raquo;
            </a>
          ";
            }
            // line 80
            yield "        ";
        }
        // line 81
        yield "      </td>
    </tr>
    <tr class=\"text-nowrap\">
      <th>";
yield _gettext("Log name");
        // line 84
        yield "</th>
      <th>";
yield _gettext("Position");
        // line 85
        yield "</th>
      <th>";
yield _gettext("Event type");
        // line 86
        yield "</th>
      <th>";
yield _gettext("Server ID");
        // line 87
        yield "</th>
      <th>";
yield _gettext("Original position");
        // line 88
        yield "</th>
      <th>";
yield _gettext("Information");
        // line 89
        yield "</th>
    </tr>
  </thead>

  <tbody>
    ";
        // line 94
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["values"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["value"]) {
            // line 95
            yield "      <tr class=\"noclick\">
        <td>";
            // line 96
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_5 = $context["value"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["Log_name"] ?? null) : null), "html", null, true);
            yield "</td>
        <td class=\"text-end\">";
            // line 97
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_6 = $context["value"]) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["Pos"] ?? null) : null), "html", null, true);
            yield "</td>
        <td>";
            // line 98
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_7 = $context["value"]) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["Event_type"] ?? null) : null), "html", null, true);
            yield "</td>
        <td class=\"text-end\">";
            // line 99
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_8 = $context["value"]) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["Server_id"] ?? null) : null), "html", null, true);
            yield "</td>
        <td class=\"text-end\">";
            // line 101
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["value"], "Orig_log_pos", [], "array", true, true, false, 101)) ? ((($__internal_compile_9 = $context["value"]) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["Orig_log_pos"] ?? null) : null)) : ((($__internal_compile_10 = $context["value"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["End_log_pos"] ?? null) : null))), "html", null, true);
            // line 102
            yield "</td>
        <td>";
            // line 103
            yield PhpMyAdmin\Html\Generator::formatSql((($__internal_compile_11 = $context["value"]) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["Info"] ?? null) : null),  !($context["is_full_query"] ?? null));
            yield "</td>
      </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 106
        yield "  </tbody>
</table>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "server/binlog/index.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  328 => 106,  319 => 103,  316 => 102,  314 => 101,  310 => 99,  306 => 98,  302 => 97,  298 => 96,  295 => 95,  291 => 94,  284 => 89,  280 => 88,  276 => 87,  272 => 86,  268 => 85,  264 => 84,  258 => 81,  255 => 80,  250 => 77,  242 => 76,  236 => 72,  229 => 71,  227 => 70,  224 => 69,  222 => 68,  219 => 67,  211 => 64,  202 => 63,  194 => 60,  185 => 59,  183 => 58,  180 => 57,  176 => 55,  171 => 52,  163 => 51,  157 => 47,  150 => 46,  147 => 45,  145 => 44,  136 => 38,  130 => 34,  124 => 31,  118 => 29,  116 => 28,  113 => 27,  108 => 26,  105 => 25,  98 => 23,  95 => 22,  93 => 21,  88 => 20,  86 => 19,  82 => 18,  78 => 17,  74 => 16,  70 => 15,  67 => 14,  65 => 13,  61 => 11,  54 => 7,  50 => 6,  46 => 4,  41 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "server/binlog/index.twig", "D:\\Apache24\\php-web-feladatbank\\phpmyadmin\\templates\\server\\binlog\\index.twig");
    }
}
