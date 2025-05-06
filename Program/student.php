<?php
include_once("conf.php");
include_once("Model/Student.class.php");
include_once("View/StudentView.php");
include_once("Controller/Student.controller.php");

$controller = new StudentController();
$view = new StudentView();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->add($_POST);
        } else {
            $view->renderForm();
        }
        break;
        
    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->update($_POST['id'], $_POST);
        } else {
            $controller->edit($_GET['id']);
        }
        break;
        
    case 'delete':
        $controller->delete($_GET['id']);
        break;
        
    default:
        $controller->index();
        break;
}
?>
