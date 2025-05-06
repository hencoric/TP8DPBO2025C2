<?php

include_once __DIR__ . '/DB.class.php';

class Jurusan extends DB
{
    function getJurusan()
    {
        $query = "SELECT * FROM jurusan";
        return $this->execute($query);
    }

    function add($data)
    {
        $nama = $data['nama'];

        $query = "INSERT INTO jurusan (nama) VALUES ('$nama')";
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM jurusan WHERE id = '$id'";
        return $this->execute($query);
    }

    function update($id, $data)
    {
        $nama = $data['nama'];

        $query = "UPDATE jurusan SET nama = '$nama' WHERE id = '$id'";
        return $this->execute($query);
    }

    function getById($id)
    {
        $query = "SELECT * FROM jurusan WHERE id = '$id'";
        $result = $this->execute($query);
        return mysqli_fetch_array($result);
    }
}
