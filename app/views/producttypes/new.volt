<form action="/producttypes/create" role="form" method="post">
    <ul class="nav row mb-3">
        <li class="col-md-6">
            {{ link_to("producttype", "&larr; Go Back") }}
        </li>
        <li class="col-md-6 text-end">
            {{ submit_button("保存", "class": "btn btn-success") }}
        </li>
    </ul>

    <div class="center scaffold">
        <h2 class="mb-4">创建产品类型</h2>
        <div class="mb-3">
            <label for="name" class="form-label">类型名称</label>
            {{ text_field("name", "size": 24, "maxlength": 70, "class": "form-control") }}
        </div>
    </div>
</form>
