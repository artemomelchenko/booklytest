<?php
require_once("class/DB.php");
require_once("class/Tree.php");

$tree = new Tree();

if (isset($_POST['add'])) {

    $tree->add($table = 'tree', $fields = 'parent', (int)$_POST['add']);
} elseif ($_POST['delete']) {

    $tree->delete($table = 'tree', (int)$_POST['delete']);
}

$allData = $tree->getAll();
$data = $tree->buildTree($allData);

?>
<form method="post" action="">
    root
    <button name="add" value="0">+</button>
    <?php foreach ($data as $key => $value): ?>

        <br/>
        &nbsp;&nbsp;&nbsp;<?= $value['tab'] ?>node
        <button name="add" value="<?= $value['id'] ?>">+</button>
        <button name="delete" value="<?= $value['id'] ?>">-</button>

    <?php endforeach; ?>
</form>

<br/>
DB print_r:
<pre>
    <?php print_r($allData) ?>
</pre>