<div class="row">
	<div class="col-md-6">
		<div class="page-header">
			<h2>登录</h2>
		</div>
		
		<form action="/session/start" role="form" method="post">
			<fieldset>
				<div class="mb-3">
					<label for="email" class="form-label">用户名 / 电子邮箱</label>
					<div class="controls">
						{{ text_field('email', 'class': 'form-control') }}
					</div>
				</div>
				<div class="mb-3">
					<label for="password" class="form-label">密码</label>
					<div class="controls">
						{{ password_field('password', 'class': 'form-control') }}
					</div>
				</div>
				<div class="mb-3">
					{{ submit_button('登录', 'class': 'btn btn-primary btn-large') }}
				</div>
			</fieldset>
		</form>
	</div>
	<div class="col-md-6">
		<div class="page-header">
			<h2>还没有账号？</h2>
		</div>
		
		<p>创建帐户具有以下优势：</p>
		<ul>
			<li>在线创建、跟踪和导出您的发票</li>
			<li>获得有关您的业务运作方式的重要见解</li>
			<li>随时了解促销和特别套餐</li>
		</ul>
		
		<div class="clearfix center">
			{{ link_to('register', '注册', 'class': 'btn btn-primary btn-large btn-success') }}
		</div>
	</div>
</div>