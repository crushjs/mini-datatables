<?php

namespace Crushjs\MiniDataTables;

class MiniDataTables
{
    protected $query;
    protected $result;
    protected $addColumns = [];
    protected $editColumns = [];
    protected $rawColumns = [];
    public static function of($query)
    {
        $instance = new static();

        $instance->query = $query;

        return $instance;
    }
    // Sort
    public function sort()
    {
        if (empty($this->query->getModel()->getFillable())) {
            return $this;
        }
        $this->query->orderBy($this->query->getModel()->getTable() . '.id', 'desc');
        return $this;
    }
    // Search
    public function search($column, $value)
    {
        // checking if having column in instance
        if (!in_array($column, $this->query->getModel()->getFillable())) {
            return $this;
        }

        // checking if $value is empty
        if (empty($value)) {
            return $this;
        }

        $this->query->where($column, 'like', '%' . $value . '%');
        return $this;
    }

    public function paginate($perPage = 10)
    {
        $this->result = $this->query->paginate($perPage);

        return $this;
    }

    public function make()
    {
        $data = $this->result
            ? $this->result->items()
            : $this->query->get();

        $data = collect($data)->map(function ($row) {

            // edit existing columns
            foreach ($this->editColumns as $name => $callback) {

                $value = $callback($row);

                // escape if NOT raw
                if (!in_array($name, $this->rawColumns)) {
                    $value = e($value);
                }

                $row->$name = $value;
            }

            // add new columns
            foreach ($this->addColumns as $name => $callback) {

                $value = $callback($row);

                // escape if NOT raw
                if (!in_array($name, $this->rawColumns)) {
                    $value = e($value);
                }

                $row->$name = $value;
            }

            return $row;
        });

        return response()->json([
            'data' => $data
        ]);
    }


    // Add custom column
    public function addColumn($name, $callback)
    {
        $this->addColumns[$name] = $callback;

        return $this;
    }
    // Edit column
    public function editColumn($name, $callback)
    {
        $this->editColumns[$name] = $callback;

        return $this;
    }

    public function rawColumns(array $columns)
    {
        $this->rawColumns = $columns;

        return $this;
    }
}
