<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex justify-content-center">

        <?php
        $koneksi = mysqli_connect("sql109.infinityfree.com", "if0_35295262", "2J5oguklsoq4TTj", "if0_35295262_restoran");

        $id = $_POST['id'];

        $query = "SELECT * FROM menu WHERE idmenu = $id";
        $result = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_assoc($result);

        mysqli_close($koneksi);
        ?>
        <form action="proses_edit.php" method="post" enctype="multipart/form-data">
            <h1 class="mt-3 d-flex justify-content-center">Edit Menu</h1>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="kategroi" value="<?php echo $data['kategori']; ?>">
            <div class="mb-3" style="width: 350px;">
                <label class="form-label h6">Nama Menu</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $data['namamenu']; ?>">
            </div>
            <div class="mb-3" style="width: 350px;">
                <label class="form-label h6">Harga</label>
                <input type="number" class="form-control" name="harga" value="<?php echo $data['harga']; ?>">
            </div>
            <div class="mb-3" style="width: 350px;">
                <label class="form-label h6">Deskripsi</label>
                <textarea class="form-control" id="floatingTextarea" rows="4" name="deskripsi"><?php echo $data['deskripsi']; ?></textarea>
            </div>
            <div class="mb-3" style="width: 350px;">
                <label for="formFile" class="form-label">Foto</label>
                <input class="form-control" type="file" name="foto" id="formFile">
                <img src="<?php echo $data['foto']; ?>" alt="Foto" class="mt-2" style="width:200px; margin-left:75px;">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" style="width: 150px;">Edit</button>
            </div>
        </form>
    </div>
</body>

</html>