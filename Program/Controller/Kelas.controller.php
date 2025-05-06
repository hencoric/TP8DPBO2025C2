<?php
include_once("conf.php");
include_once("Model/Kelas.class.php");
include_once("View/KelasView.php");

class KelasController
{
    private $kelas;

    function __construct()
    {
        $this->kelas = new Kelas(Conf::$DB_HOST, Conf::$DB_USER, Conf::$DB_PASS, Conf::$DB_NAME);
    }

    public function index()
    {
        $this->kelas->open();
        $this->kelas->getKelas();
        $data = array();
        while ($row = $this->kelas->getResult()) {
            array_push($data, $row);
        }
        $this->kelas->close();
        $view = new KelasView();
        $view->render($data);
    }

    function add($data)
    {
        $this->kelas->open();
        $this->kelas->add($data);
        $this->kelas->close();

        header("location:kelas.php");
    }

    function edit($id)
    {
        $this->kelas->open();
        $kelasData = $this->kelas->getById($id);
        $this->kelas->close();

        $view = new KelasView();
        $view->renderForm($kelasData, $id);
    }

    function update($id, $data)
    {
        $this->kelas->open();
        $this->kelas->update($id, $data);
        $this->kelas->close();

        header("location:kelas.php");
    }

    function delete($id)
    {
        $this->kelas->open();
        $this->kelas->delete($id);
        $this->kelas->close();

        header("location:kelas.php");
    }
}
