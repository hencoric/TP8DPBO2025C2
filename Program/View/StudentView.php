<?php
include_once("Template.php");
include_once("conf.php");
include_once("Model/Kelas.class.php");
include_once("Model/Jurusan.class.php");

class StudentView
{
    public function render($students, $kelasData, $jurusanData)
    {
        $no = 1;
        $studentData = '';
        foreach ($students as $student) {
            // Cari nama kelas dan jurusan berdasarkan id_kelas dan id_jurusan
            $kelasName = '';
            foreach ($kelasData as $kelas) {
                if ($kelas['id'] == $student['id_kelas']) {
                    $kelasName = $kelas['nama'];
                    break;
                }
            }

            $jurusanName = '';
            foreach ($jurusanData as $jurusan) {
                if ($jurusan['id'] == $student['id_jurusan']) {
                    $jurusanName = $jurusan['nama'];
                    break;
                }
            }

            $studentData .= "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . $student['name'] . "</td>
                                <td>" . $student['nim'] . "</td>
                                <td>" . $student['phone'] . "</td>
                                <td>" . $student['join_date'] . "</td>
                                <td>" . $kelasName . "</td>
                                <td>" . $jurusanName . "</td>
                                <td>
                                    <a href='student.php?action=edit&id=" . $student['id'] . "' class='btn btn-warning'>Edit</a>
                                    <a href='student.php?action=delete&id=" . $student['id'] . "' class='btn btn-danger'>Delete</a>
                                </td>
                            </tr>";
        }

        $tpl = new Template("Template/student_list.html");
        $tpl->replace("STUDENT_LIST", $studentData);
        $tpl->write();
    }


    public function renderForm($studentData = null, $isEdit = false, $kelasData = [], $jurusanData = [])
    {
        // Jika data kelas atau jurusan kosong, ambil dari database
        if (empty($kelasData) || empty($jurusanData)) {
            // Ambil data kelas
            $kelas = new Kelas(Conf::$DB_HOST, Conf::$DB_USER, Conf::$DB_PASS, Conf::$DB_NAME);
            $kelas->open();
            $kelasData = [];
            $kelasResult = $kelas->getKelas();
            while ($row = $kelas->getResult($kelasResult)) {
                array_push($kelasData, $row);
            }
            $kelas->close();
            
            // Ambil data jurusan
            $jurusan = new Jurusan(Conf::$DB_HOST, Conf::$DB_USER, Conf::$DB_PASS, Conf::$DB_NAME);
            $jurusan->open();
            $jurusanData = [];
            $jurusanResult = $jurusan->getJurusan();
            while ($row = $jurusan->getResult($jurusanResult)) {
                array_push($jurusanData, $row);
            }
            $jurusan->close();
        }

        $id = $studentData['id'] ?? '';
        $name = $studentData['name'] ?? '';
        $nim = $studentData['nim'] ?? '';
        $phone = $studentData['phone'] ?? '';
        $join_date = $studentData['join_date'] ?? date('Y-m-d'); 
        $kelas_id = $studentData['id_kelas'] ?? ''; 
        $jurusan_id = $studentData['id_jurusan'] ?? ''; 

        if (empty($join_date)) {
            $join_date = date('Y-m-d');
        }

        $formAction = $isEdit ? "student.php?action=edit" : "student.php?action=add";

        $kelasOptions = '';
        foreach ($kelasData as $kelas) {
            $selected = ($kelas['id'] == $kelas_id) ? 'selected' : '';
            $kelasOptions .= "<option value='{$kelas['id']}' {$selected}>{$kelas['nama']}</option>";
        }

        $jurusanOptions = '';
        foreach ($jurusanData as $jurusan) {
            $selected = ($jurusan['id'] == $jurusan_id) ? 'selected' : '';
            $jurusanOptions .= "<option value='{$jurusan['id']}' {$selected}>{$jurusan['nama']}</option>";
        }

        $tpl = new Template("Template/student_form.html");
        $tpl->replace("{{ID}}", $id);
        $tpl->replace("{{name}}", $name);
        $tpl->replace("{{nim}}", $nim);
        $tpl->replace("{{phone}}", $phone);
        $tpl->replace("{{join_date}}", $join_date);
        $tpl->replace("{{FORM_ACTION}}", $formAction);
        $tpl->replace("{{KELAS_OPTIONS}}", $kelasOptions); 
        $tpl->replace("{{JURUSAN_OPTIONS}}", $jurusanOptions);
        $tpl->write();
    }
}