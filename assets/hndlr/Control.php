<?php
if (isset($_POST['fetchlist'])) {
    require './db.php';

    $stmnt = "SELECT * FROM list ORDER BY title ASC;";
    $query = $db->prepare($stmnt);
    $query->execute();
    $count = $query->rowCount();
    if ($count <= 0) {
        echo "err:fetchlist";
        exit();
    } elseif ($count > 0) {
        $dbData = [];
        foreach ($query as $data) {
            $list_id = $data['ls_id'];
            $title = $data['title'];
            // $created_at = date('jS M Y \a\t h:i A', strtotime($data['created_at']));
            $dbData[] = ['list_id' => $list_id, 'title' => $title];
        }
        $arrObject = json_encode($dbData);
        echo $arrObject;
    }
}

if (isset($_POST['fetchnames'])) {
    require './db.php';

    $selected = $_POST['fetchnames'];

    $stmnt = "SELECT * FROM names WHERE ls_id = ? ORDER BY nm_id DESC;";
    $query = $db->prepare($stmnt);
    $param = [$selected];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count <= 0) {
        echo "err:fetchnames";
        exit();
    } elseif ($count > 0) {
        $dbData = [];
        foreach ($query as $data) {
            $name_id = $data['nm_id'];
            $given = $data['given'];
            $surname = $data['surname'];
            $status = $data['status'] == '1' ? 'WINNER' : '<small><i>waiting</i></small>';
            // $created_at = date('jS M Y \a\t h:i A', strtotime($data['created_at']));

            $dbData[] = ['name_id' => $name_id, 'given' => $given, 'surname' => $surname, 'status' => $status];
        }
        $arrObject = json_encode($dbData);
        echo $arrObject;
    }
}

if (isset($_POST['toggle'])) {
    require './db.php';

    $id = $_POST['toggle'];

    $stmnt = "SELECT status FROM names WHERE nm_id = ? ;";
    $query = $db->prepare($stmnt);
    $param = [$id];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        foreach ($query as $data) {
            $status = $data['status'];
            $toggle_to = '';

            if ($status == '1') {
                $toggle_to = '0';
            } elseif ($status == '0') {
                $toggle_to = '1';
            }

            $db->beginTransaction();
            $stmnt = "UPDATE names SET status = ? WHERE nm_id = ? ;";
            $query = $db->prepare($stmnt);
            $param = [$toggle_to, $id];
            $query->execute($param);
            $count = $query->rowCount();
            if ($count > 0) {
                $db->commit();
                echo "true";
                exit();
            } else {
                $db->rollBack();
                echo "err:toggle";
                exit();
            }
        }
    }
}

if (isset($_POST['act']) && isset($_POST['id'])) {
    require './db.php';

    $action = $_POST['act'];
    $id = $_POST['id'];
    $main_stmnt = "";
    $main_param = [];

    $db->beginTransaction();

    switch ($action) {
        case 'del_name':
            $main_stmnt = "DELETE FROM names WHERE nm_id = ? ;";
            $main_param = [$id];
            break;
        case 'reset_all':
            $main_stmnt = "UPDATE names SET status = '0' WHERE ls_id = ? ;";
            $main_param = [$id];
            break;
        case 'delete_list':
            $main_stmnt = "DELETE FROM list WHERE ls_id = ? ;";
            $main_param = [$id];
            break;
    }

    $query = $db->prepare($main_stmnt);
    $query->execute($main_param);
    $count = $query->rowCount();
    if ($count > 0) {
        $db->commit();
        echo "true";
        exit();
    } else {
        $db->rollBack();
        echo "err:action";
        exit();
    }
}

if (isset($_POST['nsurname']) && isset($_POST['to_list'])) {
    require './db.php';

    $given = $_POST['ngiven'];
    $surname = $_POST['nsurname'];
    $id = $_POST['to_list'];

    $db->beginTransaction();
    $stmnt = "INSERT INTO names (ls_id, given, surname) VALUES (?, ?, ?) ;";
    $query = $db->prepare($stmnt);
    $param = [$id, $given, $surname];
    $query->execute($param);
    $count = $query->rowCount();
    if ($count > 0) {
        $db->commit();
        echo "true";
        exit();
    } else {
        $db->rollBack();
        echo "err:insert";
        exit();
    }
}

if (isset($_POST['title'])) {
    require './db.php';

    $title = $_POST['title'];

    $db->beginTransaction();
    $stmnt = "INSERT INTO list (title) VALUES (?);";
    $query = $db->prepare($stmnt);
    $param = [$title];
    $query->execute($param);
    $count = $query->rowCount();
    $lid = $db->lastInsertId();
    if ($count > 0) {
        $db->commit();
        echo $lid;
        exit();
    } else {
        $db->rollBack();
        echo "err:list";
        exit();
    }
}

if (isset($_POST['dummy']) && isset($_POST['to_list'])) {
    require './db.php';

    $to_list = $_POST['to_list'];
    $file_size = $_FILES["csv"]["size"];
    $file_tmp = $_FILES["csv"]["tmp_name"];

    if ($file_size > 0) {
        $handle = fopen($file_tmp, "r");
        $param = [];
        $for_count = [];

        // ignore first line
        fgets($handle);

        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $param[] = $to_list;
            $param[] = $data[0];
            $param[] = $data[1];
            $for_count[] = $data;
        }

        $count = count($for_count);
        $stmnt = "INSERT INTO names (ls_id, given, surname) VALUES (?, ?, ?)";
        for ($i = 1; $i < $count ; $i++) {
            $stmnt .= ", (?, ?, ?)";
        }

        $db->beginTransaction();
        $query = $db->prepare($stmnt);
        $query->execute($param);
        $count = $query->rowCount();
        if ($count > 0) {
            $db->commit();
            echo "true";
            exit();
        } else {
            $db->rollBack();
            echo "err:names";
            exit();
        }
    } else {
        $db->rollBack();
        echo "err:file";
        exit();
    }
}
