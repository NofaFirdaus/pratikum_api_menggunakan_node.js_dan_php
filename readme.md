# **Konsumsi API dengan PHP**

**Mengambil data API dengan PHP**

```php
<?php
   $url  = 'https://jsonplaceholder.typicode.com/posts';
   $response  = file_get_contents($url);
   $data = json_decode($response,true);
?>
```

**Menampilkan data dalam tabel dengan menggunakan PHP**

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>

  <body>
    <h1>DATA :</h1>
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
```

**Menambahkan CSS untuk php**

```css
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 20px;
}

h1 {
  text-align: center;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
  background-color: #fff;
}

table,
th,
td {
  border: 1px solid #ddd;
}

th,
td {
  padding: 12px;
  text-align: left;
}

th {
  background-color: #4caf50;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #ddd;
}
```

# **Konsumsi API dengan node js**

**Mengambil data API dengan node js**

```js
const express = require("express");
const axios = require("axios");
const path = require("path");

const app = express();
const port = 4000;

app.use(express.static(path.join(__dirname, "public")));

app.get("/", async (req, res) => {
  try {
    const resource = req.query.resource || "posts";
    const response = await axios.get(
      `https://jsonplaceholder.typicode.com/${resource}`
    );
    let data = response.data;

    const { id, title } = req.query;
    if (id) {
      data = data.filter((item) => item.id == id);
    }
    if (title) {
      data = data.filter((item) => item.title && item.title.includes(title));
    }

    let tableHTML = `
       <!DOCTYPE html>
       <html lang="en">
       <head>
           <meta charset="UTF-8">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <title>Data ${resource.toUpperCase()} (Node.js)</title>
           <link rel="stylesheet" href="/styles.css"> <!-- Pastikan path sesuai -->
       </head>
       <body>
           <h1>Data ${resource.toUpperCase()} dari JSONPlaceholder API (Node.js)</h1>
           <table border="1" cellpadding="10" cellspacing="0">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Title</th>
                       <th>Body</th>
                   </tr>
               </thead>
               <tbody>
       `;

    data.forEach((item) => {
      tableHTML += `
           <tr>
               <td>${item.id}</td>
               <td>${item.title || item.name}</td>
               <td>${item.body || item.email}</td>
           </tr>`;
    });

    tableHTML += `
               </tbody>
           </table>
       </body>
       </html>`;

    res.send(tableHTML);
  } catch (error) {
    res.status(500).send("Error fetching data");
  }
});

// Menjalankan server
app.listen(port, () => {
  console.log(`Server berjalan di http://localhost:${port}`);
});
```

# **Tugas Pratikum**

**1. Mengambil data dari resources lain**
saya menggunkan data **users**

code :

```php
$response = file_get_contents($url);
$url = 'https://jsonplaceholder.typicode.com/users';
```

**2. Menambhakan fitur filter berdasarkan id atau nama**

code untuk form filter:
```html
<form>
  <input
    name="search"
    class="text-slate-50 px-4 py-2 rounded-md bg-slate-950 placeholder:text-slate-50/70 outline-none focus:ring-2 focus:ring-sky-500 transition mr-4 focus:ease-out ease-in"
    type="text"
    placeholder="Cari Data (berdasarkan id/nama)"
  />
  <button
    class="text-slate-50 bg-sky-600 font-semibold py-2 px-4 rounded-md transition hover:ease-in hover:bg-sky-400 ease-out"
  >
    CARI
  </button>
</form>
```

code untuk php :
```php
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
```

**3. Untuk css saya menggunakan Tailwind framework css**


**Link Code:** ['index.php'](views/index.php)