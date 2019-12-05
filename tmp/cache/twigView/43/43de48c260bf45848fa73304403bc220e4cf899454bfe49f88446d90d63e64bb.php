<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* C:\xampp\htdocs\dewtouch-innovations\vendor\cakephp\bake\src\Template\Bake\Element\Controller/index.twig */
class __TwigTemplate_2c2416c4d761837f96c7467267b926e03e07325c65195d5c1ec57cedc41ac406 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa = $this->env->getExtension("WyriHaximus\\TwigView\\Lib\\Twig\\Extension\\Profiler");
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa->enter($__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "C:\\xampp\\htdocs\\dewtouch-innovations\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/index.twig"));

        // line 16
        echo "    /**
     * Index method
     *
     * @return \\Cake\\Http\\Response|null
     */
    public function index()
    {
";
        // line 23
        $context["belongsTo"] = $this->getAttribute((isset($context["Bake"]) ? $context["Bake"] : null), "aliasExtractor", [0 => (isset($context["modelObj"]) ? $context["modelObj"] : null), 1 => "BelongsTo"], "method");
        // line 24
        if ((isset($context["belongsTo"]) ? $context["belongsTo"] : null)) {
            // line 25
            echo "        \$this->paginate = [
            'contain' => [";
            // line 26
            echo $this->getAttribute((isset($context["Bake"]) ? $context["Bake"] : null), "stringifyList", [0 => (isset($context["belongsTo"]) ? $context["belongsTo"] : null), 1 => ["indent" => false]], "method");
            echo "]
        ];
";
        }
        // line 29
        echo "        \$";
        echo twig_escape_filter($this->env, (isset($context["pluralName"]) ? $context["pluralName"] : null), "html", null, true);
        echo " = \$this->paginate(\$this->";
        echo twig_escape_filter($this->env, (isset($context["currentModelName"]) ? $context["currentModelName"] : null), "html", null, true);
        echo ");

        \$this->set(compact('";
        // line 31
        echo twig_escape_filter($this->env, (isset($context["pluralName"]) ? $context["pluralName"] : null), "html", null, true);
        echo "'));
    }
";
        
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa->leave($__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa_prof);

    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\dewtouch-innovations\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 31,  55 => 29,  49 => 26,  46 => 25,  44 => 24,  42 => 23,  33 => 16,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
#}
    /**
     * Index method
     *
     * @return \\Cake\\Http\\Response|null
     */
    public function index()
    {
{% set belongsTo = Bake.aliasExtractor(modelObj, 'BelongsTo') %}
{% if belongsTo %}
        \$this->paginate = [
            'contain' => [{{ Bake.stringifyList(belongsTo, {'indent': false})|raw }}]
        ];
{% endif %}
        \${{ pluralName }} = \$this->paginate(\$this->{{ currentModelName }});

        \$this->set(compact('{{ pluralName }}'));
    }
", "C:\\xampp\\htdocs\\dewtouch-innovations\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/index.twig", "C:\\xampp\\htdocs\\dewtouch-innovations\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/index.twig");
    }
}
