<?php

class MySQL
{
    private $link; // 连接数据库

    function __construct($host, $user, $pwd, $database) {
        $this->link = mysqli_connect($host, $user, $pwd, $database);
        return $this->link;
    }


    public function select($table, $fields = '*', $where = '') {
        $sql_str = 'select ' . $fields . ' from ' . $table;
        
        if ($where) {
            $sql_str .= ' where ' . $where;
        }
        // echo $sql_str;
        $result = mysqli_query($this->link, $sql_str);
        $arr = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $arr;
    }

    /**
     * 取出指定字段的值
     * @param $table string 表名
     * @param $fields string 字段名
     * @param $where string 条件
     * @return mixed 返回指定字段的值
     */
    public function find($table, $fields, $where) {
        $sql_str = 'select ' . $fields . ' from ' . $table . ' where ' .$where;
        // echo $sql_str;
        $result = mysqli_query($this->link, $sql_str);
        $arr = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $arr[$fields];
    }

    public function update($table, $data, $where = ''){
        $sql_str = "UPDATE {$table} SET ";
        foreach($data as $key => $value){
            $sql_str .= "{$key} = '{$value}',";
        }
        $sql_str = rtrim($sql_str,',');
        if($where){
            $sql_str .= " where " . $where;
        }else{
            echo '警告：没有条件约束';
            return false;
        }
//        echo $sql_str;
        $result = mysqli_query($this->link, $sql_str);
        $rows = mysqli_affected_rows($this->link);
        var_dump($rows);
        if($rows){
            return true;
        }elseif($rows === (int)0){
            echo '数据未改变';
            return true;
        }else{
            return false;
        }
    }

    public function insert($table, $data){
        $sql_str = "INSERT INTO $table (";
        $arr_key = array_keys($data);
        $arr_val = array_values($data);
        $sql_str .= implode(',',$arr_key);
        $sql_str .=") VALUES (";
        $sql_str .= "'".implode("','", $arr_val)."')";
        // echo $sql_str;
        $res = mysqli_query($this->link, $sql_str);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function query($sql_str){
       $result = mysqli_query($this->link, $sql_str);
       $data = array();
       if ($result && mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    return $data;
}

    // 清空表
    public function truncate($table_name){
        $sql_str = "truncate table $table_name";
       $result = mysqli_query($this->link, $sql_str);
       return $result;
    }

    /**
     * [getOne 获取一条数据]
     * @param  [string] $sql [description]
     * @return [type]      [description]
     */
    public function getOne($sql_str){
        $result = mysqli_query($this->link, $sql_str);
        $arr = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $arr;
    }


}

// $sql_obj = new MySQL('localhost', 'root', 'root', 'lzf_shop');
// $sql_obj -> insert('goods',array('name'=>'美版山寨', 'sale_price'=>112.4));
// $arr = $sql_obj->select('goods');
// $find_result1 = $sql_obj -> find('goods','name','id =1');
// $update_arr = ['name' => '国产神机'];
// $update_result = $sql_obj -> update('goods', $update_arr, 'id =1');
// $find_result2 = $sql_obj -> find('goods','name','id =1');
// print_r($arr);
// echo '修改前：';
// print_r($find_result1);
// var_dump($update_result);
// echo '修改后：';
// print_r($find_result2);