<?php

namespace Crushjs\MiniDataTables;

class MiniDataTables
{
    protected $query;

    public static function of($query)
    {
        $instance = new static();

        $instance->query = $query;

        return $instance;
    }

    public function search($column, $value)
    {
        // checking if having column in instance
        if (!in_array($column, $this->query->getModel()->getFillable())) {
            return $this;
        }

        $this->query->where($column, 'like', '%' . $value . '%');
        return $this;
    }

    public function make()
    {
        return response()->json([
            'data' => $this->query->get()
        ]);
    }
}
