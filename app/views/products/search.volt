<ul class="nav row mb-3">
    <li class="col-md-6">
        {{ link_to("products", "&larr; Go Back") }}
    </li>
    <li class="col-md-6 text-end">
        {{ link_to("products/new", "创建产品", "class": "btn btn-primary") }}
    </li>
</ul>

{% for product in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped table-hover align-middle">
    <thead class="table-primary">
        <tr>
            <td>id</td>
            <td>产品类型</td>
            <td>产品名称</td>
            <td>产品价格</td>
            <td>活跃</td>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
    <tr>
        <td>{{ product.id }}</td>
        <td>{{ product.getProductTypes().name }}</td>
        <td>{{ product.name }}</td>
        <td>{{ "%.2f"|format(product.price) }}</td>
        <td>{{ product.getActiveDetail() }}</td>
        <td class="text-center col-1">
            {{ link_to("products/edit/" ~ product.id, "<i class='icon-edit'></i> 编辑", "class": "btn btn-primary btn-sm") }}
        </td>
        <td class="text-center col-1">
            {{ link_to("products/delete/" ~ product.id, "<i class='icon-remove'></i> 删除", "class": "btn btn-primary btn-sm") }}
        </td>
    </tr>
    {% if loop.last %}
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7" align="right">
                <ul class="pagination mb-0 justify-content-end">
                    <li class="page-item">
                        {{ link_to("/products/search", "<i class='icon-fast-backward'></i> 首页", "class": "page-link") }}
                    </li>
                    <li class="page-item">
                        {{ link_to("/products/search?page=" ~ page.previous, "<i class='icon-step-backward'></i> 上一页", "class": "page-link") }}
                    </li>
                    <li class="page-item">
                        {{ link_to("/products/search?page=" ~ page.next, "<i class='icon-step-forward'></i> 下一页", "class": "page-link") }}
                    </li>
                    <li class="page-item">
                        {{ link_to("/products/search?page=" ~ page.last, "<i class='icon-fast-forward'></i> 末页", "class": "page-link") }}
                    </li>
                    <li class="page-item disabled">
                        <a class="page-link">{{ page.current }}/{{ page.last }}</a>
                    </li>
                </ul>
            </td>
        </tr>
    </tfoot>
</table>
    {% endif %}
{% endfor %}
