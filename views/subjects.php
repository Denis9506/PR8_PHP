<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR7</title>
    <link rel="stylesheet" href="../views/style.css">
</head>
<body>
<ul>
    <li><a href="/">Студенти</a></li>
    <li><a href="/index.php/subjects">Предмети</a></li>
    <li><a href="/index.php/uspishnist">Успішність</a></li>
</ul>

<form action="/index.php/subjects/addSubject" method="POST">
    <input type="text" name="name" placeholder="Введіть назву предмета" required />
    <input type="submit" value="Відправити" />
</form>

<hr>

<?php if ($subjects) { ?>
    <form method="POST" action="/index.php/subjects/actions">
        <table>
            <tr>
                <th>Ім'я</th>
                <th>Дія</th>
            </tr>
            <?php foreach ($subjects as $s) { ?>
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
