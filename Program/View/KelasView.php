<?php
include_once("Template.php");

class KelasView
{
    public function render($kelas)
    {
        $no = 1;
        $kelasData = '';
        foreach ($kelas as $k) {
            $kelasData .= "<tr>
                               <td>" . $no++ . "</td>
                               <td>" . $k['nama'] . "</td>
                               <td>
                                   <a href='kelas.php?action=edit&id=" . $k['id'] . "' class='btn btn-warning'>Edit</a>
                                   <a href='kelas.php?action=delete&id=" . $k['id'] . "' class='btn btn-danger'>Delete</a>
                               </td>
                            </tr>";
        }

        $tpl = new Template("Template/kelas_list.html");
        $tpl->replace("{{KELAS_LIST}}", $kelasData);
        $tpl->write();
    }

    public function renderForm($kelasData = null, $isEdit = false)
    {
        $id = $kelasData['id'] ?? '';
        $nama = $kelasData['nama'] ?? '';

        $formAction = $isEdit ? "kelas.php?action=edit" : "kelas.php?action=add";

        $tpl = new Template("Template/kelas_form.html");
        $tpl->replace("{{ID}}", $id);
        $tpl->replace("{{nama}}", $nama);
        $tpl->replace("{{FORM_ACTION}}", $formAction);
        $tpl->write();
    }
}
