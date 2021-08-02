<?php

class Tree
{

    public function getAll($table = 'tree')
    {

        return DB::getAll($table);
    }

    public function add($table = 'tree', $fields = 'parent', $value)
    {

        return DB::add($table, $fields, $value);
    }

    public function delete($table = 'tree', $value)
    {

        return DB::delete($table, $value);
    }

    public function buildTree($data, $parentId = 0, $tab = '')
    {


        $result = [];
        if ($parentId > 0) {
            $tab .= '&nbsp;&nbsp;&nbsp;';
        }
        foreach ($data as $key => $value) {
            if ($parentId == $value['parent']) {

                $result[$key]['id'] = $value['id'];
                $result[$key]['tab'] = $tab;
                $result += $this->buildTree($data, $value['id'], $tab);
            }
        }
        return $result;
    }
}
