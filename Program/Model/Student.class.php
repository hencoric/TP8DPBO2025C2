<?php

include_once __DIR__ . '/DB.class.php';

class Student extends DB
{
    function getStudents()
    {
        $query = "SELECT students.*, kelas.nama AS nama_kelas, jurusan.nama AS nama_jurusan
                FROM students
                LEFT JOIN kelas ON students.id_kelas = kelas.id
                LEFT JOIN jurusan ON students.id_jurusan = jurusan.id";
        return $this->execute($query);
    }

    function add($data)
    {
        $name = $data['name'];
        $nim = $data['nim'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];
        $id_kelas = $data['id_kelas'];
        $id_jurusan = $data['id_jurusan'];

        $query = "INSERT INTO students (name, nim, phone, join_date, id_kelas, id_jurusan) 
                  VALUES ('$name', '$nim', '$phone', '$join_date', '$id_kelas', '$id_jurusan')";

        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM students WHERE id = '$id'";
        return $this->execute($query);
    }

    function update($id, $data)
    {
        $name = $data['name'];
        $nim = $data['nim'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];
        $id_kelas = $data['id_kelas'];
        $id_jurusan = $data['id_jurusan'];

        $query = "UPDATE students 
                  SET name = '$name', nim = '$nim', phone = '$phone', join_date = '$join_date',
                      id_kelas = '$id_kelas', id_jurusan = '$id_jurusan'
                  WHERE id = '$id'";

        return $this->execute($query);
    }

    function getById($id)
    {
        $query = "SELECT * FROM students WHERE id = '$id'";
        $result = $this->execute($query);
        return mysqli_fetch_array($result);
    }
}
