<?php
    include('db.php');
    $info = json_decode(file_get_contents("php://input"));
    if (count($info) > 0) {
        $firstname = $info->firstname;
        $lastname = $info->lastname;
        $btn_name = $info->btnAction;
        if ($btn_name == "Save") {
            if ($connect->query("INSERT INTO tbl_customer (Firstname, Lastname) values ('$firstname', '$lastname')")) {
                echo "Customer Added Successfully";
            } else {
                echo 'Failed';
            }
        }
        if ($btn_name == "Update") {
            $id    = $info->id;
            if ($connect->query("UPDATE tbl_customer SET Firstname='$firstname', Lastname='$lastname' where ID='$id'")) {
                echo 'Customer Updated Successfully';
            } else {
                echo 'Failed';
            }
        }
    }
?>