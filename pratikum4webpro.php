<?php
// Array untuk menyimpan informasi produk
$products = [
    ['id' => 1, 'name' => 'Buku', 'category' => 'Alat Tulis', 'price' => 20000],
    ['id' => 2, 'name' => 'Pulpen', 'category' => 'Alat Tulis', 'price' => 5000]
];

// Variabel untuk menyimpan data produk yang sedang diedit
$current_product = null;

// Menambahkan produk baru
if (isset($_POST['add'])) {
    $id = count($products) + 1;
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $products[] = ['id' => $id, 'name' => $name, 'category' => $category, 'price' => $price];
}

// Mengedit produk
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    foreach ($products as $item) {
        if ($item['id'] == $id) {
            $current_product = $item;
            break;
        }
    }
}

if (isset($_POST['save'])) {
    $id = $_POST['id'];
    foreach ($products as &$item) {
        if ($item['id'] == $id) {
            $item['name'] = $_POST['name'];
            $item['category'] = $_POST['category'];
            $item['price'] = $_POST['price'];
            break;
        }
    }
}

// Menghapus produk
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    foreach ($products as $key => $item) {
        if ($item['id'] == $id) {
            unset($products[$key]);
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Produk</title>
</head>
<body>
    <h2><?php echo $current_product ? 'Edit Produk' : 'Tambah Produk'; ?></h2>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $current_product ? $current_product['id'] : ''; ?>">
        <label>Nama Produk:</label><br>
        <input type="text" name="name" value="<?php echo $current_product ? $current_product['name'] : ''; ?>" required><br>
        <label>Kategori Produk:</label><br>
        <input type="text" name="category" value="<?php echo $current_product ? $current_product['category'] : ''; ?>" required><br>
        <label>Harga Produk:</label><br>
        <input type="number" name="price" value="<?php echo $current_product ? $current_product['price'] : ''; ?>" required><br><br>
        <button type="submit" name="<?php echo $current_product ? 'save' : 'add'; ?>">
            <?php echo $current_product ? 'Simpan Perubahan' : 'Tambah Produk'; ?>
        </button>
    </form>
    

    <h2>Daftar Produk</h2>
    <table cellspacing="1" cellpadding="30" border="1">
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($products as $item) : ?>
        <tr>
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['category']; ?></td>
            <td><?php echo $item['price']; ?></td>
            <td>
                <a href="?edit=<?php echo $item['id']; ?>">Edit</a> | 
                <a href="?delete=<?php echo $item['id']; ?>" onclick="return confirm('Apakah Anda ingin menghapus produk ini?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
