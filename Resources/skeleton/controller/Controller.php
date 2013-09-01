<?php

namespace {{ namespace }}\Controller;

{% block use_statements %}
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
{% if 'annotation' == format.routing -%}
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
{% endif %}
{% endblock use_statements %}

{% block class_definition %}
class {{ controller }}Controller extends Controller
{% endblock class_definition %}
{
{% block class_body %}
{% for action in actions %}
    {% if 'annotation' == format.routing -%}
    /**
     * @Route("{{ action.route }}")
     {% if 'default' == action.template -%}
     * @Template()
     {% else -%}
     * @Template("{{ action.template }}")
     {% endif -%}
     */
    {% endif -%}
    public function {{ action.name }}(
        {%- if action.placeholders|length > 0 -%}
            ${{- action.placeholders|join(', $') -}}
        {%- endif -%})
    {
    }

{% endfor -%}
{% endblock class_body %}
}
