<?php

include_once __DIR__ . '/DB.class.php';

class Kelas extends DB
{
    function getKelas()
    {
        $query = "SELECT * FROM kelas";
        return $this->execute($query);
    }

    function add($data)
    {
        $nama = $data['nama'];

        $query = "INSERT INTO kelas (nama) VALUES ('$nama')";
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM kelas WHERE id = '$id'";
        return $this->execute($query);
    }

    function update($id, $data)
    {
        $nama = $data['nama'];

        $query = "UPDATE kelas SET nama = '$nama' WHERE id = '$id'";
        return $this->execute($query);
    }

    function getById($id)
    {
        $query = "SELECT * FROM kelas WHERE id = '$id'";
        $result = $this->execute($query);
        return mysqli_fetch_array($result);
    }
}
