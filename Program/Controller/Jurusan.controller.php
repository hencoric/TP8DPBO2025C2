<?php
include_once("conf.php");
include_once("Model/Jurusan.class.php");
include_once("View/JurusanView.php");

class JurusanController
{
    private $jurusan;

    function __construct()
    {
        $this->jurusan = new Jurusan(Conf::$DB_HOST, Conf::$DB_USER, Conf::$DB_PASS, Conf::$DB_NAME);
    }

    public function index()
    {
        $this->jurusan->open();
        $this->jurusan->getJurusan();
        $data = array();
        while ($row = $this->jurusan->getResult()) {
            array_push($data, $row);
        }
        $this->jurusan->close();
        $view = new JurusanView();
        $view->render($data);
    }

    function add($data)
    {
        $this->jurusan->open();
        $this->jurusan->add($data);
        $this->jurusan->close();

        header("location:jurusan.php");
    }

    function edit($id)
    {
        $this->jurusan->open();
        $jurusanData = $this->jurusan->getById($id);
        $this->jurusan->close();

        $view = new JurusanView();
        $view->renderForm($jurusanData, $id);
    }

    function update($id, $data)
    {
        $this->jurusan->open();
        $this->jurusan->update($id, $data);
        $this->jurusan->close();

        header("location:jurusan.php");
    }

    function delete($id)
    {
        $this->jurusan->open();
        $this->jurusan->delete($id);
        $this->jurusan->close();

        header("location:jurusan.php");
    }
}
