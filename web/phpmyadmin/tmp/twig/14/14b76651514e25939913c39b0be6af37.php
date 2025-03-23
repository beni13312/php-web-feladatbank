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

/* server/user_groups/user_groups.twig */
class __TwigTemplate_e67b28203b8f28b6ffbbc3a064bbe6a6 extends Template
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
        yield "<div class=\"row\"><h2>";
yield _gettext("User groups");
        yield "</h2></div>
";
        // line 2
        if (($context["has_rows"] ?? null)) {
            // line 3
            yield "    <form name=\"userGroupsForm\" id=\"userGroupsForm\" action=\"";
            yield ($context["action"] ?? null);
            yield "\" method=\"post\">
        ";
            // line 4
            yield ($context["hidden_inputs"] ?? null);
            yield "
        <table class=\"table table-striped table-hover\">
            <thead>
                <tr class=\"text-nowrap\">
                    <th scope=\"col\">
                        ";
yield _gettext("User groups");
            // line 10
            yield "                    </th>
                    <th scope=\"col\">
                        ";
yield _gettext("Server level tabs");
            // line 13
            yield "                    </th>
                    <th scope=\"col\">
                        ";
yield _gettext("Database level tabs");
            // line 16
            yield "                    </th>
                    <th scope=\"col\">
                        ";
yield _gettext("Table level tabs");
            // line 19
            yield "                    </th>
                    <th scope=\"col\">
                        ";
yield _gettext("Action");
            // line 22
            yield "                    </th>
                </tr>
            </thead>
            <tbody>
                ";
            // line 26
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["user_groups_values"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["groupName"]) {
                // line 27
                yield "                    <tr>
                        <td>";
                // line 28
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["groupName"], "name", [], "any", false, false, false, 28), "html", null, true);
                yield "</td>
                        <td>";
                // line 29
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["groupName"], "serverTab", [], "any", false, false, false, 29), "html", null, true);
                yield "</td>
                        <td>";
                // line 30
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["groupName"], "dbTab", [], "any", false, false, false, 30), "html", null, true);
                yield "</td>
                        <td>";
                // line 31
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["groupName"], "tableTab", [], "any", false, false, false, 31), "html", null, true);
                yield "</td>
                        <td class=\"text-nowrap\">
                            <a class=\"\" href=\"";
                // line 33
                yield CoreExtension::getAttribute($this->env, $this->source, $context["groupName"], "userGroupUrl", [], "any", false, false, false, 33);
                yield "\" data-post=\"";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["groupName"], "viewUsersUrl", [], "any", false, false, false, 33);
                yield "\">";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["groupName"], "viewUsersIcon", [], "any", false, false, false, 33);
                yield "</a>
                            &nbsp;&nbsp;
                            <a class=\"\" href=\"";
                // line 35
                yield CoreExtension::getAttribute($this->env, $this->source, $context["groupName"], "userGroupUrl", [], "any", false, false, false, 35);
                yield "\" data-post=\"";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["groupName"], "editUsersUrl", [], "any", false, false, false, 35);
                yield "\">";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["groupName"], "editUsersIcon", [], "any", false, false, false, 35);
                yield "</a>
                          <button type=\"button\" class=\"btn btn-link\" data-bs-toggle=\"modal\" data-bs-target=\"#deleteUserGroupModal\" data-user-group=\"";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["groupName"], "name", [], "any", false, false, false, 36), "html", null, true);
                yield "\">
                            ";
                // line 37
                yield PhpMyAdmin\Html\Generator::getIcon("b_drop", _gettext("Delete"));
                yield "
                          </button>
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['groupName'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 42
            yield "            </tbody>
        </table>
    </form>

  <div class=\"modal fade\" id=\"deleteUserGroupModal\" tabindex=\"-1\" aria-labelledby=\"deleteUserGroupModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-centered\">
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h5 class=\"modal-title\" id=\"deleteUserGroupModalLabel\">";
yield _gettext("Delete user group");
            // line 50
            yield "</h5>
          <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"";
yield _gettext("Close");
            // line 51
            yield "\"></button>
        </div>
        <div class=\"modal-body\"></div>
        <div class=\"modal-footer\">
          <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">";
yield _gettext("Close");
            // line 55
            yield "</button>
          <button type=\"button\" class=\"btn btn-danger\" id=\"deleteUserGroupConfirm\">";
yield _gettext("Delete");
            // line 56
            yield "</button>
        </div>
      </div>
    </div>
  </div>
";
        }
        // line 62
        yield "<div class=\"row\">
    <fieldset class=\"pma-fieldset\" id=\"fieldset_add_user_group\">
        <a href=\"";
        // line 64
        yield ($context["add_user_url"] ?? null);
        yield "\">";
        yield ($context["add_user_icon"] ?? null);
yield _gettext("Add user group");
        yield "</a>
    </fieldset>
</div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "server/user_groups/user_groups.twig";
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
        return array (  179 => 64,  175 => 62,  167 => 56,  163 => 55,  156 => 51,  152 => 50,  141 => 42,  130 => 37,  126 => 36,  118 => 35,  109 => 33,  104 => 31,  100 => 30,  96 => 29,  92 => 28,  89 => 27,  85 => 26,  79 => 22,  74 => 19,  69 => 16,  64 => 13,  59 => 10,  50 => 4,  45 => 3,  43 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "server/user_groups/user_groups.twig", "D:\\Apache24\\php-web-feladatbank\\phpmyadmin\\templates\\server\\user_groups\\user_groups.twig");
    }
}
