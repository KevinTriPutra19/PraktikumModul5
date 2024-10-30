<?php
// Array untuk menyimpan data barang
$barang = [
    ['id' => 1, 'nama' => 'Buku', 'kategori' => 'Alat Tulis', 'harga' => 20000],
    ['id' => 2, 'nama' => 'Pulpen', 'kategori' => 'Alat Tulis', 'harga' => 5000]
];

// Variabel untuk menyimpan data yang sedang diedit
$barang_edit = null;

// Menambah barang baru
if (isset($_POST['tambah'])) {
    $id = count($barang) + 1;
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $barang[] = ['id' => $id, 'nama' => $nama, 'kategori' => $kategori, 'harga' => $harga];
}

// Mengedit barang
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    foreach ($barang as $item) {
        if ($item['id'] == $id) {
            $barang_edit = $item;
            break;
        }
    }
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    foreach ($barang as &$item) {
        if ($item['id'] == $id) {
            $item['nama'] = $_POST['nama'];
            $item['kategori'] = $_POST['kategori'];
            $item['harga'] = $_POST['harga'];
            break;
        }
    }
}

// Menghapus barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    foreach ($barang as $key => $item) {
        if ($item['id'] == $id) {
            unset($barang[$key]);
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Barang</title>
</head>
<body>
    <h2><?php echo $barang_edit ? 'Edit Barang' : 'Tambah Barang'; ?></h2>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $barang_edit ? $barang_edit['id'] : ''; ?>">
        <label>Nama Barang:</label><br>
        <input type="text" name="nama" value="<?php echo $barang_edit ? $barang_edit['nama'] : ''; ?>" required><br>
        <label>Kategori Barang:</label><br>
        <input type="text" name="kategori" value="<?php echo $barang_edit ? $barang_edit['kategori'] : ''; ?>" required><br>
        <label>Harga Barang:</label><br>
        <input type="number" name="harga" value="<?php echo $barang_edit ? $barang_edit['harga'] : ''; ?>" required><br><br>
        <button type="submit" name="<?php echo $barang_edit ? 'simpan' : 'tambah'; ?>">
            <?php echo $barang_edit ? 'Simpan Perubahan' : 'Tambah Barang'; ?>
        </button>
    </form>
    

    <h2>Daftar Barang</h2>
    <table cellspacing="1" cellpadding ="30" border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($barang as $item) : ?>
        <!-- <tr> -->
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['nama']; ?></td>
            <td><?php echo $item['kategori']; ?></td>
            <td><?php echo $item['harga']; ?></td>
            <td>
                <a href="?edit=<?php echo $item['id']; ?>">Edit</a> | 
                <a href="?hapus=" onclick="return confirm('apakah anda ingin menhapuss barang ini?');" href="?hapus=<?php echo $item['id']; ?>">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>