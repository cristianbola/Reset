<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 05/12/2017
 * Time: 08:33 PM
 */
require_once 'gets.php';

if ($_GET){
    switch ($_GET['source']){
        case 'deleteNotis' :
            session_start();
            if(isset($_SESSION["us_id"])) {

                $id_user = $_SESSION['us_id'];
                gets::sinNoti($id_user);
                echo json_encode(array(
                    'response' => 'success'
                ));
            }

            break;
    }
}