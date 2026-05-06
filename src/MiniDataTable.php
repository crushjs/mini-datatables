<?php

namespace Crushjs\MiniDataTables;

abstract class MiniDataTable
{
    protected $style = 'default';

    abstract public function query();

    abstract public function columns();
    public function style($style)
    {
        $this->style = $style;

        return $this;
    }

    public function ajax()
    {
        $query = $this->query();

        // total records
        $total = $query->count();

        // search
        $search = request('search.value');

        if ($search) {

            foreach ($this->columns() as $column) {

                if (!isset($column['data'])) {
                    continue;
                }

                $query->orWhere(
                    $column['data'],
                    'LIKE',
                    "%{$search}%"
                );
            }
        }

        // filtered count
        $filtered = $query->count();

        // pagination
        $start = request('start', 0);

        $length = request('length', 10);

        $query->skip($start)->take($length);

        return response()->json([
            'draw' => intval(request('draw')),
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => $query->get(),
        ]);
    }

    public function table()
    {
        $columns = json_encode($this->columns());

        $ajaxUrl = url()->current();

        return view(
            'mini-datatables::table',
            compact('columns', 'ajaxUrl')
        );
    }

    public function styles()
    {
        // DataTables.net
        if ($this->style === 'datatables') {

            return '
            <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css" />

        ';
        }

        // default style
        return '
        <link rel="stylesheet"
              href="/vendor/mini-datatables/table.css">
    ';
    }

    public function scripts()
    {
        // DataTables.net
        if ($this->style === 'datatables') {

            return '
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
            <script>
                $(document).ready(function () {
                    $("#mini-datatable").DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: $("#mini-datatable").data("url")
                        },
                        columns: ' . json_encode($this->columns()) . '
                    });

                });
            </script>
        ';
        }

        // default JS
        return '
        <script src="/vendor/mini-datatables/table.js"></script>
    ';
    }

    public function render($view, $data = [])
    {
        $data['datatable'] = $this;

        return view($view, $data);
    }
}
