<table id="mini-datatable" class="mini-datatable dt-container display table" data-url="{{ $ajaxUrl }}">

    <thead>
        <tr>
            @foreach (json_decode($columns, true) as $column)
                <th data-column="{{ $column['data'] }}">
                    {{ $column['title'] }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody></tbody>
</table>
