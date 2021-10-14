<h2 class="mb-3">更新您的个人资料</h2>

<form action="/invoices/profile" role="form" method="post" id="profileForm">
	<div class="mb-3">
		<label for="name" class="form-label">你的全名：</label>
		{{ text_field("name", "size": "30", "class": "form-control") }}
		<small class="form-text text-muted">
			<strong>警告！</strong> 请输入您的全名
		</small>
	</div>
	
	<div class="mb-3">
		<label for="name" class="form-label">电子邮箱：</label>
		{{ text_field("email", "size": "30", "class": "form-control") }}
		<small class="form-text text-muted">
			<strong>警告！</strong> 请输入您的电子邮箱
		</small>
	</div>
	
	<input type="button" value="更新" class="btn btn-primary btn-large btn-info" onclick="Profile.validate()" />
	{{ link_to('invoices/index', '取消') }}
</form>