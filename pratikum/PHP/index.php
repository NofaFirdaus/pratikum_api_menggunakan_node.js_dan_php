<?php
$url = 'https://jsonplaceholder.typicode.com/posts';
$response = file_get_contents($url);
$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>DATA : </h1>
    <table>

        <thead>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>body</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $post) : ?>
            <tr>
                <td><?= $post['id'] ?></td>
                <td><?= $post['title'] ?></td>
                <td><?= $post['body'] ?></td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>


</body>

</html>