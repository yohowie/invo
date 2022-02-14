<div class="row mb-3">
    <div class="col-xs-12 col-md-6">
        <h2>搜索产品类型</h2>
    </div>
    <div class="col-xs-12 col-md-6 text-end">
        {{ link_to("productTypes/new", "创建产品类型", "class": "btn btn-primary") }}
    </div>
</div>

<form action="/producttypes/search" role="form" method="post">
    <div class="mb-3">
        <label for="id" class="form-label">Id</label>
        {{ numeric_field("id", "size": 10, "maxlength": 10, "class": "form-control") }}
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">类型名称</label>
        {{ text_field("name", "size": 24, "maxlength": 70, "class": "form-control") }}
    </div>

    {{ submit_button("搜索", "class": "btn btn-primary") }}
</form>
