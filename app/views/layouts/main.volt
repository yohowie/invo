{%
set topMenu = [
	'index': [
		'title': '首页',
		'uri': '/index'
	],
	'invoices': [
        'title': '发票',
        'uri': '/invoices/index'
    ],
    'about': [
        'title': '关于团队',
        'uri': '/about/index'
    ],
    'contact': [
        'title': '联系我们',
        'uri': '/contact/index'
    ]
]
%}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
	<div class="container">
		<a class="navbar-brand" href="/">INVO</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="navbar-toggler-icon"></span>
	    </button>
	    
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<ul class="navbar-nav me-auto">
	    		{% for controller, menu in topMenu %}
					<li class="nav-item">
						<a class="nav-link" href="{{ menu['uri'] }}">{{ menu['title'] }}</a>
					</li>
	    		{% endfor %}
	    	</ul>
	    	
	    	<div class="my-2 my-lg-0">
	    		<ul class="navbar-nav mr-auto">
	    			<li class="nav-item">
	    				<!-- <a class="nav-link" href="/session/end">退出</a> -->
	    				<a class="nav-link" href="/session/index">登录 / 注册</a>
	    			</li>
	    		</ul>
	    	</div>
	    </div>
    </div>
</nav>

<div class="container">
	{{ flash.output() }}
	{{ content() }}
	<hr>
	<footer>
		<p>&copy; Company {{ date('Y') }}</p>
	</footer>
<div>