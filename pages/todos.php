<?php

include_once('config.php');
$todos_query = mysqli_query($link, 'SELECT * FROM todos WHERE user_id = ' . $_SESSION['id']);
$todos = mysqli_fetch_all($todos_query);
if (isset($_POST['submit'])) {
    $todo_upload = mysqli_real_escape_string($link, $_POST['todo']);

    if ($todo_upload != "") {
        $result = mysqli_query($link, "INSERT INTO `todos`(`user_id`, `task`) VALUES ('" . $_SESSION['id'] . "','$todo_upload')")
            or die("Could not execute the insert query. <br/> <a href='/'>Go back</a>");
        Header('Location: /');
    }
} elseif (isset($_POST['delete'])) {
    $result = mysqli_query($link, "DELETE FROM `todos` WHERE `id` = " . $_POST['id'])
        or die("Could not execute the delete query. <br/> <a href='/'>Go back</a>");
    Header('Location: /');
} elseif (isset($_POST['toggle'])) {
    $result = mysqli_query($link, "UPDATE `todos` SET `is_completed`='" . ($_POST['is_completed'] ? "0" : "1") . "' WHERE `id`=" . $_POST['id']);
    Header('Location: /');
} elseif (isset($_POST['edit']) && $_POST['todo'] != "") {
    $result = mysqli_query($link, "UPDATE `todos` SET `task`='" . $_POST['todo'] . "' WHERE `id`=" . $_POST['id']);
    Header('Location: /');
}
?>

<script>
    function toggleHide(x) {
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

<div class="container">
    <h1 class="text-center">Todo App</h1>
    <div class="row">
        <form id="input-todo" class="was-validated" method="POST" action="">
            <div class="mb-3">
                <label for="validationTextarea" class="form-label">Todo</label>
                <textarea class="form-control" id="validationTextarea" name="todo" placeholder="Makan siang" required></textarea>
                <div class="invalid-feedback">
                    Ketik hal yang akan dikerjakan.
                </div>
            </div>
            <div class="mb-3">
                <input name="submit" type="submit" value="Submit" class="btn btn-primary"></input>
            </div>
        </form>
    </div>
    <div class="row">
        <table id="tabel todo" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Todo (click to edit) </th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="css-serial">
                <?php
                $no = 1;
                ?>
                <?php
                foreach ($todos as $todo => $value) {
                    $current = $no++;
                ?>
                    <form id="<?= $current ?>" action="" method="post">

                        <input name="id" type="hidden" value="<?= $value[0] ?>" class="form-control"></input>
                        <input name="is_completed" type="hidden" value="<?= $value[3] ?>" class="form-control"></input>
                        <tr>
                            <th scope="row"> </th>
                            <td class='<?= $value[3] ? "done" : "not-done" ?>'>
                                <input id="result_<?= $value[0] ?>" type="hidden" name="todo" value="<?= $value[2] ?>">
                                <div id="source_<?= $value[0] ?>" contenteditable="true" oninput="
                                    document.getElementById('result_<?= $value[0] ?>').value = this.innerText;
                                    if (this.innerText == '<?= $value[2] ?>' || this.innerText == '') {
                                        document.getElementById('edit_<?= $value[0] ?>').hidden = true;
                                    } else {
                                        document.getElementById('edit_<?= $value[0] ?>').hidden = false;
                                    }
                                ">
                                    <?= $value[2] ?>
                                </div>
                                <input hidden id="edit_<?= $value[0] ?>" name="edit" type="submit" value="Submit Edit" class="btn btn-warning btn-sm " role="button" input>
                            </td>
                            <td>
                                <input name="toggle" type="submit" value="Toggle" class="btn btn-success btn-sm " role="button"></input>
                                <input name="delete" type="submit" value="Hapus" class="btn btn-danger btn-sm " role="button"></input>
                            </td>
                        </tr>
                    </form>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>