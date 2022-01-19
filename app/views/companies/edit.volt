<form action="/companies/save" role="form" method="post">
    <ul class="nav row mb-3">
        <li class="col-md-6">
            {{ link_to("companies", "&larr; Go Back") }}
        </li>
        <li class="col-md-6 text-end">
            {{ submit_button("保存", "class": "btn btn-success") }}
        </li>
    </ul>

    <h2>编辑公司</h2>

    <fieldset>
        {% for element in form %}
            {% if is_a(element, "phalcon\Forms\Element\Hidden") %}
                {{ element }}
            {% else %}
        <div class="mb-3">
            {{ element.label(["class": "form-label"]) }}
            {{ element.render(["class": "form-control"]) }}
        </div>
            {% endif %}
        {% endfor %}
    </fieldset>
</form>
