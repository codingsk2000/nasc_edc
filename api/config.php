<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class db
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db_name = 'nasc_edc';
    public $con;

    function __construct()
    {
        $this->con = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
        if ($this->con->connect_error) {
            die('connection failed');
        }
    }
}

class API extends db
{


    public function get_safe_value($str)
    {
        $str = trim($str);
        $str = mysqli_real_escape_string($this->con, $str);
        $str = htmlentities($str);
        $str = htmlspecialchars($str);
        return $str;
    }

    public function redirect($link)
    {
        echo "<script>
            window.location.href = '" . $link . "'
        </script>";
        die();
    }

    // getData function
    public function getData($table, $field = '*', $condition_arr = array(''), $order_by_field = '', $order_by_type = 'desc', $limit = '')
    {
        $sql = "select  $field from $table";

        if ($condition_arr != array('')) {
            $sql .= ' where ';
            $c = count($condition_arr);
            $i = 1;
            foreach ($condition_arr as $key => $val) {
                if ($i == $c) {
                    $sql .= "$key = '$val' ";
                } else {
                    $sql .= "$key = '$val' and ";
                }
                $i++;
            }
        }

        if ($order_by_field != '') {
            $sql .= " order by $order_by_field $order_by_type ";
        }

        if ($limit != '') {
            $sql .= " limit $limit ";
        }
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }

    // insert data fuction
    public function insertData($table, $condition_arr)
    {

        if ($condition_arr != '') {

            foreach ($condition_arr as $key => $val) {
                $fieldArr[] = $key;
                $valArr[] = $val;
            }
            $field = implode(",", $fieldArr);
            $value = implode("','", $valArr);
            $value = "'" . $value . "'";
            $sql = "insert into $table($field) values($value)";
        }
        $result = $this->con->query($sql);
        if ($result) {
            return array('status' => 1, 'insert_id' => $this->con->insert_id);
        } else {
            return 0;
        }
    }

    //delete data
    public function deleteData($table, $condition_arr)
    {

        if ($condition_arr != '') {

            $sql = "delete from $table where ";
            $c = count($condition_arr);
            $i = 1;
            foreach ($condition_arr as $key => $val) {
                if ($i == $c) {
                    $sql .= "$key = '$val' ";
                } else {
                    $sql .= "$key = '$val' and ";
                }
                $i++;
            }
        }
        $result = $this->con->query($sql);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

    // update data

    public function updateData($table, $condition_arr, $where_field, $where_value)
    {

        if ($condition_arr != '') {

            $sql = "update $table set ";
            $c = count($condition_arr);
            $i = 1;
            foreach ($condition_arr as $key => $val) {
                if ($i == $c) {
                    $sql .= " $key = '$val' ";
                } else {
                    $sql .= " $key = '$val' , ";
                }
                $i++;
            }
            $sql .= " where $where_field = '$where_value'";
        }

        $result = $this->con->query($sql);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

    // login function
    public function login($username, $password, $department = '')
    {
        $password = md5($password);
        $condition_arr = array('username' => $username, 'password' => $password);
        if ($department != '') {
            $condition_arr = array('username' => $username, 'password' => $password, 'department' => $department);
        }
        $row = $this->getData('department_head', 'id,isAdmin', $condition_arr);
        if ($row) {
            $token = openssl_random_pseudo_bytes(16);
            $token = bin2hex($token);
            $condition_arr = array('token' => $token);
            $this->updateData('department_head', $condition_arr, 'id', $row[0]['id']);
            $_SESSION['token'] = $token;
            return array('isAdmin'=>$row[0]['isAdmin'],'status'=>'success');
        } else {
            return 0;
        }
    }
}
