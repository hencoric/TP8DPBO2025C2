<?php
include_once("conf.php");
include_once("Model/Student.class.php");
include_once("Model/Kelas.class.php");  // Pastikan model Kelas sudah ada
include_once("Model/Jurusan.class.php");  // Pastikan model Jurusan sudah ada
include_once("View/StudentView.php");

class StudentController
{
  private $student;
  private $kelas;
  private $jurusan;

  function __construct()
  {
    $this->student = new Student(Conf::$DB_HOST, Conf::$DB_USER, Conf::$DB_PASS, Conf::$DB_NAME);
    $this->kelas = new Kelas(Conf::$DB_HOST, Conf::$DB_USER, Conf::$DB_PASS, Conf::$DB_NAME);
    $this->jurusan = new Jurusan(Conf::$DB_HOST, Conf::$DB_USER, Conf::$DB_PASS, Conf::$DB_NAME);
  }

  public function index()
  {
    $this->student->open();
    $this->student->getStudents();
    $data = array();
    while ($row = $this->student->getResult()) {
      array_push($data, $row);
    }
    $this->student->close();

    $this->kelas->open();
    $kelasData = $this->kelas->getKelas();
    $this->kelas->close();

    $this->jurusan->open();
    $jurusanData = $this->jurusan->getJurusan();
    $this->jurusan->close();

    $view = new StudentView();
    $view->render($data, $kelasData, $jurusanData);
  }

  function add($data)
  {
    $this->student->open();
    $this->student->add($data);
    $this->student->close();

    header("location:student.php");
  }

  function edit($id)
  {
    $this->student->open();
    $studentData = $this->student->getById($id);
    $this->student->close();

    $this->kelas->open();
    $kelasData = $this->kelas->getKelas();
    $this->kelas->close();

    $this->jurusan->open();
    $jurusanData = $this->jurusan->getJurusan();
    $this->jurusan->close();

    $view = new StudentView();
    $view->renderForm($studentData, true, $kelasData, $jurusanData);
  }

  function update($id, $data)
  {
    $this->student->open();
    $this->student->update($id, $data);
    $this->student->close();

    header("location:student.php");
  }

  function delete($id)
  {
    $this->student->open();
    $this->student->delete($id);
    $this->student->close();

    header("location:student.php");
  }

  function getById($id)
  {
    $query = "SELECT * FROM students WHERE id = '$id'";
    $result = $this->execute($query);
    return mysqli_fetch_array($result);
  }
}
