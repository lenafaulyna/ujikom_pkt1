<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penulis</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- Load jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Load DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom styles -->
    <style>
        /* Your custom CSS styles */
    </style>
</head>
<body>
    <main class="container-fluid">
        <div class="container">
            <h2 class="mt-4">Data Penulis</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Data Penulis</li>
            </ol>

            <!-- Your PHP alert messages -->
            <?php
            //Validasi untuk menampilkan pesan pemberitahuan saat user menambah penulis
            if (isset($_GET['add'])) {
                if ($_GET['add']=='berhasil'){
                    echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data Penulis telah ditambah!</div>";
                }else if ($_GET['add']=='gagal'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data Penulis gagal ditambahkan!</div>";
                }    
            }

            if (isset($_GET['edit'])) {
                if ($_GET['edit']=='berhasil'){
                    echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data Penulis telah diupdate!</div>";
                }else if ($_GET['edit']=='gagal'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data Penulis gagal diupdate!</div>";
                }    
            }
            if (isset($_GET['hapus'])) {
                if ($_GET['hapus']=='berhasil'){
                    echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data Penulis telah dihapus!</div>";
                }else if ($_GET['hapus']=='gagal'){
                    echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data Penulis gagal dihapus!</div>";
                }    
            }
        ?>

            <div class="card mb-4">
                <div class="card-header py-3">
                    <button class="btn-tambah btn btn-dark btn-icon-split"><span class="text">Tambah</span></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel_penulis">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Penulis</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // Your PHP data fetching and rendering here
                                        // include database
                              
    $host="localhost";
    $user="root";
    $password="";
    $db="db_perpustakaan";
    
    $kon = mysqli_connect($host,$user,$password,$db);
    if (!$kon){
          die("Koneksi gagal:".mysqli_connect_error());
    }
                              // perintah sql untuk menampilkan daftar penulis yang berelasi dengan tabel penulis
                              $sql="select * from penulis order by id_penulis desc";
                              $hasil=mysqli_query($kon,$sql);
                              $no=0;
                              //Menampilkan data dengan perulangan while
                              while ($data = mysqli_fetch_array($hasil)):
                              $no++;
                          ?>
                          <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $data['kode_penulis']; ?></td>
                              <td><?php echo $data['nama_penulis']; ?></td>
                              <td>
                                  <button class="btn-edit btn btn-warning btn-circle" id_penulis="<?php echo $data['id_penulis']; ?>" kode_penulis="<?php echo $data['kode_penulis']; ?>"><i class="fas fa-edit"></i></button>
                                  <a href="pustaka/penulis/hapus-penulis.php?id_penulis=<?php echo $data['id_penulis']; ?>" class="btn-hapus btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
                              </td>
                          </tr>
                          <!-- bagian akhir (penutup) while -->
                          <?php endwhile; ?>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
    $(document).ready(function(){
        $('#tabel_penulis').DataTable();
    });
</script>

<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" id="judul"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
            <div id="tampil_data">
                 <!-- Data akan di load menggunakan AJAX -->                   
            </div>  
        </div>
  
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>

<script>

    // Tambah penulis
    $('.btn-tambah').on('click',function(){
        var level = $(this).attr("level");
        $.ajax({
            url: 'petugas/penulis/tambah-penulis.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Penulis';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });


    // fungsi edit penulis
    $('.btn-edit').on('click',function(){

        var id_penulis = $(this).attr("id_penulis");
        var kode_penulis = $(this).attr("kode_penulis");
        $.ajax({
            url: 'petugas/penulis/edit-penulis.php',
            method: 'post',
            data: {id_penulis:id_penulis},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Penulis #'+kode_penulis;
            }
        });
            // Membuka modal
        $('#modal').modal('show');
    });


    // fungsi hapus penulis
    $('.btn-hapus').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus penulis ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
