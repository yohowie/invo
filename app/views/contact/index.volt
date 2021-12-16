<div class="mb-4">
    <h2>联系我们</h2>
</div>

<p>给我们发送消息，让我们知道我们如何提供帮助。请尽可能描述清楚，因为这将有助于我们更好地为您服务。</p>

<form action="/contact/send" role="form" method="post">
    <fieldset>
        <div class="mb-3">
            {{ form.label("name", ["class": "form-label"]) }}
            {{ form.render("name", ["class": "form-control"]) }}
        </div>
        <div class="mb-3">
            {{ form.label("email", ["class": "form-label"]) }}
            {{ form.render("email", ["class": "form-control"]) }}
        </div>
        <div class="mb-3">
            {{ form.label("comments", ["class": "form-label"]) }}
            {{ form.render("comments", ["class": "form-control"]) }}
        </div>
        <div class="mb-3">
            {{ submit_button("发送", "class": "btn btn-primary btn-large") }}
        </div>
    </fieldset>
</form>