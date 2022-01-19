<ul class="nav row mb-3">
    <li class="col-md-6">
        {{ link_to("companies/index", "&larr; Go Back") }}
    </li>
    <li class="col-md-6 text-end">
        {{ link_to("companies/new", "创建公司", "class": "btn btn-primary") }}
    </li>
</ul>

{% for company in page.items %}
{% if loop.first %}
<table class="table table-bordered table-striped table-hover align-middle">
    <thead class="table-primary">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>电话</th>
        <th>地址</th>
        <th>城市</th>
        <th colspan="2">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    {% endif %}
    <tr>
        <td>{{ company['id'] }}</td>
        <td>{{ company['name'] }}</td>
        <td>{{ company['telephone'] }}</td>
        <td>{{ company['address'] }}</td>
        <td>{{ company['city'] }}</td>
        <td class="text-center col-1">
            {{ link_to("/companies/edit/" ~ company['id'], "<i class='icon-edit'></i> 编辑", "class": "btn btn-primary btn-sm") }}
        </td>
        <td class="text-center col-1">
            {{ link_to("/companies/delete/" ~ company['id'], "<i class='icon-remove'></i> 删除", "class": "btn btn-primary btn-sm") }}
        </td>
    </tr>
    {% if loop.last %}
    </tbody>
    <tfoot>
    <tr>
        <td colspan="7">
            <ul class="pagination mb-0 justify-content-end">
                <li class="page-item">
                    {{ link_to("/companies/search", "<i class='icon-fast-backward'></i> 首页", "class": "page-link") }}
                </li>
                <li class="page-item">
                    {{ link_to("/companies/search?page=" ~ page.previous, "<i class='icon-step-backward'></i> 上一页", "class": "page-link") }}
                </li>
                <li class="page-item">
                    {{ link_to("/companies/search?page=" ~ page.next, "<i class='icon-step-forward'></i> 下一页", "class": "page-link") }}
                </li>
                <li class="page-item">
                    {{ link_to("/companies/search?page=" ~ page.last, "<i class='icon-fast-forward'></i> 末页", "class": "page-link") }}
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
