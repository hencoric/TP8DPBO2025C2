<?php
include_once("Template.php");

class JurusanView
{
    public function render($jurusan)
    {
        $no = 1;
        $jurusanData = '';
        foreach ($jurusan as $j) {
            $jurusanData .= "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . $j['nama'] . "</td>
                                <td>
                                    <a href='jurusan.php?action=edit&id=" . $j['id'] . "' class='btn btn-warning'>Edit</a>
                                    <a href='jurusan.php?action=delete&id=" . $j['id'] . "' class='btn btn-danger'>Delete</a>
                                </td>
                             </tr>";
        }

        $tpl = new Template("Template/jurusan_list.html");
        $tpl->replace("{{JURUSAN_LIST}}", $jurusanData);
        $tpl->write();
    }

    public function renderForm($jurusanData = null, $isEdit = false)
    {
        $id = $jurusanData['id'] ?? '';
        $nama = $jurusanData['nama'] ?? '';

        $formAction = $isEdit ? "jurusan.php?action=edit" : "jurusan.php?action=add";

        $tpl = new Template("Template/jurusan_form.html");
        $tpl->replace("{{ID}}", $id);
        $tpl->replace("{{nama}}", $nama);
        $tpl->replace("{{FORM_ACTION}}", $formAction);
        $tpl->write();
    }
}
