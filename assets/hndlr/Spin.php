<?php

if (isset($_POST['qty']) && isset($_POST['spinlist_selected'])) {
    require './db.php';

    $qty = $_POST['qty'];
    $list = $_POST['spinlist_selected'];

    $stmnt = "SELECT * FROM names WHERE ls_id = :list AND status != '1' ORDER BY RAND() LIMIT :lmt ;";
    $query = $db->prepare($stmnt);
    $query->bindValue(':list', $list);
    $query->bindValue(':lmt', (int) $qty, PDO::PARAM_INT);
    $query->execute();
    $count = $query->rowCount();
    if ($count <= 0) {
        echo "err:spin";
        exit();
    } elseif ($count > 0) {
        $dbData = [];
        foreach ($query as $data) {
            $name_id = $data['nm_id'];
            $given = $data['given'];
            $surname = $data['surname'];
            $dbData[] = ['name_id' => $name_id, 'given' => $given, 'surname' => $surname];
        }
        $arrObject = json_encode($dbData);
        echo $arrObject;
    }
}

if (isset($_POST['winner'])) {
    require './db.php';

    $id = $_POST['winner'];

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
                echo "err:winner";
                exit();
            }
        }
    }
}
