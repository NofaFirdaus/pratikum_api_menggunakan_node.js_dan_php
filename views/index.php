<?php
$url = 'https://jsonplaceholder.typicode.com/users';
$response = file_get_contents($url);
$data = json_decode($response, true);
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filteredData = [];

if ($search) {
    foreach ($data as $user) {
        if (stripos($user['id'], $search) !== false || stripos($user['name'], $search) !== false) {
            $filteredData[] = $user;
        }
    }
} else {
    $filteredData = $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./output.css" rel="stylesheet">
</head>

<body class="bg-slate-900">
    <main class="px-5  mt-[15vh]">
        <div class="flex justify-between">
            <h1 class="text-slate-50 font-semibold text-4xl mb-3">Data : </h1>
            <form>
                <input name="search"
                    class="text-slate-50 px-4 py-2 rounded-md bg-slate-950 placeholder:text-slate-50/70 outline-none focus:ring-2 focus:ring-sky-500 transition mr-4 focus:ease-out ease-in"
                    type="text" placeholder="Cari Data (berdasarkan id/nama)">
                <button
                    class="text-slate-50 bg-sky-600 font-semibold py-2 px-4 rounded-md transition hover:ease-in hover:bg-sky-400 ease-out">CARI</button>
            </form>
        </div>
        <table
            class="mt-4 text-slate-50 ring-2 ring-sky-500  w-full table-auto text-center overflow-hidden rounded-md ">
            <thead>
                <tr class="font-semibold text-xl   bg-sky-500 *:py-3 px-2">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Kota</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filteredData as $post): ?>
                    <tr class="odd:bg-slate-800 *:py-3 px-2 even:bg-slate-900">
                        <td><?= $post['id'] ?></td>
                        <td><?= $post['name'] ?></td>
                        <td><?= $post['username'] ?></td>
                        <td><?= $post['email'] ?></td>
                        <td><?= $post['address']['city'] ?></td>
                    </tr>

                <?php endforeach ?>
            </tbody>
        </table>
    </main>
</body>

</html>