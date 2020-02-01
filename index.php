<!DOCTYPE HTML>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<style>
    .action_style {
        width: 100px;
        cursor: pointer;
    }
    .action_style:hover {
        background: aqua;
        color: darkblue;
    }
    form {
        position: absolute;
        top: 20px;
        right:50%;
    }
</style>
<script>
    function edit(){
        var name_count = Number($(".action_style").last().attr("data-id")) + 1;
        var x = '][9999999999]" title="кликните, чтобы отредактировать" class="action_style"><br><br>';
        $('#container').append('<input type="text" value="ВВЕДИТЕ ЧТО!НИБУДЬ" data-id="' +name_count+ '" name="task[' + name_count + x);
    }
</script>
<form action="#" method="post" enctype="application/x-www-form-urlencoded">
    <input type="button" value="добавить действие" onclick="edit();"><br><br>
    <div id="container">
        <?php
        $mysqli = new mysqli("localhost", "brainsof_olegtut", "iwrestlinger131", "brainsof_olegtut");
        /* проверка соединения */
        if ($mysqli->connect_errno) {
            printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
            exit();
        }
        for($i=1; $i<=count($_POST["task"]); $i++){
            if(isset($_POST["task"][$i])){
                if(isset($_POST["task"][$i][9999999999])){
                    $mysqli->query("INSERT INTO `action`(`name`) VALUES ('" . $_POST["task"][$i][9999999999] . "');");
                }else{
                    $mysqli->query("UPDATE `action` SET `name`='" . $_POST["task"][$i] . "' WHERE id=" . $i);
                }
            }
        }
        $res = $mysqli->query("SELECT * FROM `action`");
        while($row = mysqli_fetch_array($res)){
            echo '<input type="text" value="' . $row["name"] . '" name="task[' . $row["id"] .']" data-id="' . $row["id"] . '" title="кликните, чтобы отредактировать" class="action_style"><br><br>';
        }
        mysqli_close($link);
        ?>
    </div>
    <input type="submit" value="СОХРАНИТЬ">
</form>
</body>
</html>
