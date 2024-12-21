<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR7</title>
    <link rel="stylesheet" href="/views/style.css">
</head>
<body>
<ul>
        <li>
            <a href="/">Студенти</a>
        </li>
        <li>  <a href="/index.php/subjects">Предмети</a>
        </li>
        <li>
        <a href="/index.php/uspishnist">Успішність</a>
        </li>
    </ul>
    <form action="/index.php/uspishnist/add" method="POST">
    <select name="sid" required>
            <option value="">---</option>
            <?php 
            if ($students) {
                foreach ($students as $s) { ?>
                    <option value="<?php echo $s['id']; ?>"><?php echo htmlspecialchars($s['name']); ?></option>
                <?php }
            } ?>
        </select>
        <br>

        <select name="pid" required>
            <option value="">---</option>
            <?php 
            if ($subjects) {
                foreach ($subjects as $s) { ?>
                    <option value="<?php echo $s['id']; ?>"><?php echo htmlspecialchars($s['name']); ?></option>
                <?php }
            } ?>
        </select>
        <br>
        <input type="number" name="mark" placeholder="Введіть оцінку" required /><br>
        <br>
        <input type="submit" value="Відправити" />
    </form>

    <hr>
    
    <form method="GET" action="/index.php/uspishnist/">
    <input 
        type="text" 
        name="search" 
        placeholder="Пошук студента за ім'ям" 
         
        value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" />
    <input type="submit" value="Пошук" />
    </form>
    <hr>

    <?php if ($uspishnist) { ?>
        <form method="POST" action="/index.php/uspishnist/actions">
            <table>
                <tr>
                    <th>Ім'я</th>
                    <th>Предмет</th>
                    <th>Оцінка</th>
                </tr>
                <?php foreach ($uspishnist as $u) { ?>
                    <tr>
                    <td>
<select name="sid[<?php echo $u['id']; ?>]">
    <?php 
    if ($students) {
        foreach ($students as $s) { ?>
            <option value="<?php echo $s['id']; ?>" <?php if ($u['sid'] == $s['id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($s['name']); ?>
            </option>
        <?php }
    } ?>
</select>
</td>
<td>
<select name="pid[<?php echo $u['id']; ?>]">
            <?php 
            if ($subjects) {
                foreach ($subjects as $s) { ?>
                    <option value="<?php echo $s['id']; ?>" <?php if ($u['pid'] == $s['id']) echo 'selected'; ?>><?php echo htmlspecialchars($s['name']); ?></option>
                <?php }
            } ?>
        </select>
</td>
                        <td>
                            <input 
                                type="number" 
                                name="mark[<?php echo $u['id']; ?>]" 
                                placeholder="Mark" 
                                required 
                                value="<?php echo htmlspecialchars(trim($u['mark'])); ?>" />
                        </td>
                        <td>
                            <button type="submit" name="update" value="<?php echo $u['id']; ?>">Update</button>
                            <button type="submit" name="delete" value="<?php echo $u['id']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    <?php } ?>
</body>
</html>
