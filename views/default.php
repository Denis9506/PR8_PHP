<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR7</title>
    <link rel="stylesheet" href="views/style.css">
</head>
<body>
<ul>
    <li><a href="/">Студенти</a></li>
    <li><a href="/index.php/subjects">Предмети</a></li>
    <li><a href="/index.php/uspishnist">Успішність</a></li>
</ul>
    <form action="index.php/students/addStudent" method="POST">
        <input type="text" name="name" placeholder="Name" required /><br>
        <select name="group_id" required>
            <option value="">---</option>
            <?php 
            if ($groups) {
                foreach ($groups as $g) { ?>
                    <option value="<?php echo $g['id']; ?>"><?php echo htmlspecialchars($g['name']); ?></option>
                <?php }
            } ?>
        </select>
        <br>
        <br>
        <!-- <input type="number" name="group_id" placeholder="Group id" min="1" max="2" require /><br> -->
        <input type="submit" value="Відправити" />
    </form>

    <hr>
    <?php 
        if($students){?>
        <form method="POST" action="index.php/students/actions">
            <table>
                <tr>
                    <th>Ім'я</th>
                    <th>Група</th>
                    <th>Дія</th>
                </tr>
                <?php foreach ($students as $s) { ?>
                    <tr>

                        <td>
                            <input 
                                type="text" 
                                name="name[<?php echo $s['id']; ?>]" 
                                placeholder="Name" 
                                required 
                                value="<?php echo htmlspecialchars(trim($s['name'])); ?>" />
                        </td>

                        <td>
                            <select name="group_id[<?php echo $s['id']; ?>]">
                                <?php 
                                if ($groups) {
                                    foreach ($groups as $g) { ?>
                                        <option 
                                            value="<?php echo $g['id']; ?>" 
                                            <?php if ($s['group_id'] == $g['id']) echo 'selected'; ?>>
                                            <?php echo htmlspecialchars($g['name']); ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>
                        </td>
                        <td>
                            <button type="submit" name="update" value="<?php echo $s['id']; ?>">Update</button>
                            <button type="submit" name="delete" value="<?php echo $s['id']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    <?php } ?>
</body>
</html>
