<div class="row mb-3">
    <div class="col-xs-12 col-md-6">
        <h2>搜索产品</h2>
    </div>
    <div class="col-xs-12 col-md-6 text-end">
        {{ link_to("products/new", "创建产品", "class": "btn btn-primary") }}
    </div>
</div>

<form action="/products/search" role="form" method="post">
    {% for element in form %}
        {% if is_a(element, "Phalcon\Forms\Element\Hidden") %}
            {{ element }}
        {% else %}
            <div class="mb-3">
                {{ element.label(["class": "form-label"]) }}
                <div class="controls">
                    {{ element.setAttribute("class", "form-control") }}
                </div>
            </div>
        {% endif %}
    {% endfor %}

    {{ submit_button("搜索", "class": "btn btn-primary") }}
</form>
