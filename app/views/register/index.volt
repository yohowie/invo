<div class="page-header">
    <h2>注册 INVO</h2>
</div>

<form action="/register" role="form" method="post" id="registerForm">
	<fieldset>
		<div class="mb-3">
			{{ form.label('name', ['class': 'form-label']) }}
			<div class="controls">
				{{ form.render('name', ['class': 'form-control']) }}
				<p class="help-block">(必须)</p>
				<div class="alert alert-warning" id="name_alert">
					<strong>警告！</strong> 请输入您的全名
				</div>
			</div>
		</div>
		
		<div class="mb-3">
			{{ form.label('username', ['class': 'form-label']) }}
			<div class="controls">
				{{ form.render('username', ['class': 'form-control']) }}
				<p class="help-block">(必须)</p>
				<div class="alert alert-warning" id="username_alert">
					<strong>警告！</strong> 请输入您想要的用户名
				</div>
			</div>
		</div>
		
		<div class="mb-3">
			{{ form.label('email', ['class': 'form-label']) }}
			<div class="controls">
				{{ form.render('email', ['class': 'form-control']) }}
				<p class="help-block">(必须)</p>
				<div class="alert alert-warning" id="email_alert">
					<strong>警告！</strong> 请输入您的电子邮箱
				</div>
			</div>
		</div>
		
		<div class="mb-3">
			{{ form.label('password', ['class': 'form-label']) }}
			<div class="controls">
				{{ form.render('password', ['class': 'form-control']) }}
				<p class="help-block">(最少 8 个字符)</p>
				<div class="alert alert-warning" id="password_alert">
					<strong>警告！</strong> 请提供有效密码
				</div>
			</div>
		</div>
		
		<div class="mb-3">
			{{ form.label('repeatPassword', ['class': 'form-label']) }}
			<div class="controls">
				{{ password_field('repeatPassword', 'class': 'form-control') }}
				<div class="alert alert-warning" id="repeatPassword_alert">
					<strong>警告！</strong> 密码不匹配
				</div>
			</div>
		</div>
		
		<div class="form-actions mb-3">
			{{ submit_button('注册', 'class': 'btn btn-primary mb-3', 'onclick': 'return SignUp.validate();') }}
			<p class="help-block">注册即表示您接受使用条款和隐私政策。</p>
		</div>
	</fieldset>
</form>