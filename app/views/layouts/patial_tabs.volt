{%
set tabs = [
	[
        'controller': 'invoices',
        'action': 'index',
        'title': '发票',
        'uri': '/invoices/index'
    ],
    [
        'controller': 'companies',
        'action': 'index',
        'title': '公司',
        'uri': '/companies/index'
    ],
    [
        'controller': 'products',
        'action': 'index',
        'title': '产品',
        'uri': '/products/index'
    ],
    [
        'controller': 'producttypes',
        'action': 'index',
        'title': '产品类型',
        'uri': '/producttypes/index'
    ],
    [
        'controller': 'invoices',
        'action': 'profile',
        'title': '你的个人资料',
        'uri': '/invoices/profile'
    ]
]
%}

<ul class="nav nav-tabs mb-3">
	{% for controller, tab in tabs %}
	<li class="nav-item">
		<a class="nav-link {% if tab['controller'] == dispatcher.getControllerName()|lower and tab['action'] == dispatcher.getActionName() %}active{% endif %}" href="{{ tab['uri'] }}">
            {{ tab['title'] }}
        </a>
	</li>
	{% endfor %}
</ul>