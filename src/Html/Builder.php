<?php

namespace Crushjs\MiniTables\Html;

class Builder
{
    protected array $columns = [];

    public function columns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    public function render()
    {
        $html = '<table class="table">';

        $html .= '<thead><tr>';

        foreach ($this->columns as $column) {
            $html .= "<th>{$column['title']}</th>";
        }

        $html .= '</tr></thead>';

        $html .= '</table>';

        return $html;
    }
}
