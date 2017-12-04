<?php
//header("content-Type: text/html; charset=utf-8");
header("content-Type:text/html; charset=utf-8");

class mysqlDb {

    private $localhost = "localhost";
    private $user = "root";
    private $pwd = "111444le";
    public $db;
    public $charset = "utf8";
    //结果
    public static $con;
    //错误信息
    private $error;

    public function __construct($db, $localhost = "localhost", $user = "root", $pwd = "111444le", $charset = "utf8") {
        $this->db = $db;
        $this->localhost = $localhost;
        $this->user = $user;
        $this->pwd = $pwd;
        $this->charset = $charset;

        $this->connect();
        $this->charset();
    }

    //连接数据库
    public function connect() {
        self::$con = mysqli_connect($this->localhost, $this->user, $this->pwd, $this->db);
        if (!self::$con) {
            $this->error = "连接数据库失败" . mysqli_connect_errno();
        }
    }

    //校验编码
    public function charset() {
        mysqli_set_charset(self::$con, $this->charset);
    }

    public function querysql($sql) {
        if ($sql == "") {
            $this->error = "sql 语句为空";
            return false;
        }
        $result = mysqli_query(self::$con, $sql);
        if ($result == false) {
            $this->error = "sql语句执行失败" . mysqli_errno($this->error);
        }
        return $result;
    }

    //查询结果
    public function select($sql) {
        $result = $this->querysql($sql);
        if ($result == false) {
            return array();
        }
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
        return $arr;
    }

    //获取错误信息
    public function getError() {
        return $this->error;
    }

    //关闭数据库
    public function __destruct() {
        mysqli_close(self::$con);
    }

}

$select = new mysqlDb("huaban");
$sql = "select * from user limit 10";
$list = $select->select($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>调取数据</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="../js/jquery-1.12.3.min.js"></script>
    </head>
    <body>
        <div style="width:780px;margin: 0 auto">
            <table border="1">
                <tr>
                    <td>id</td>
                    <td>username</td>
                    <td>H_portrait</td>
                    <td>sex</td>
                    <td>birthday</td>
                    <td>brief</td>
                    <td>brief</td>

                </tr>
                <?php if ($list != "") { ?>
                    <?php foreach ($list as $k => $v) { ?>
                        <tr>
                            <td><?php echo $v["id"] ?></td>
                            <td><?php echo $v["username"] ?></td>
                            <td><?php echo $v["H_portrait"] ?></td>
                            <td><?php echo $v["sex"] ?></td>
                            <td><?php echo $v["birthday"] ?></td>
                            <td><?php echo $v["brief"] ?></td>
                            <td><?php echo $v["username"] ?></td>
                            <td><?php echo $v["brief"] ?></td>
                        </tr>
                    <?php } ?>

                <?php } else { ?>
                    <?php echo "暂无数据" ?>
                <?php } ?>
            </table>
            <div class="button" style="width:780px;">
                <button value="上一页" style="margin-left: 40%;" >上一页</button>
                <button value="下一页" style="margin: 0 atuo;">下一页</button>
            </div>
        </div>
    </body>
</html>

