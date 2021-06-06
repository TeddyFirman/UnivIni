<?php
session_start();
require 'koneksi.php';
require 'data.php'; //simpan
require 'dataup.php'; //update
require 'dataAl.php';
require 'dataalup.php';
require 'dataS.php';
require 'datasup.php';
require 'upload.php';

// CHECK USER IF LOGGED IN
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {

  $username = $_SESSION['username'];
  $userid = (int) $_SESSION['userid'];
  $get_user_data = mysqli_query($db_connection, "SELECT * FROM `login` WHERE username = '$username'");
  $userData =  mysqli_fetch_assoc($get_user_data);
} else {
  header('Location: mahasiswa.php');
  exit;
}
if (isset($_POST['upload'])) {
  $imgFile = $_FILES['file'];

  $allowedImgExtension = ["jpg",  "jpeg", "png"];
  $extension = explode('.', $imgFile['name']);
  $extension = end($extension);
  $extension = strtolower($extension);

  if (in_array($extension, $allowedImgExtension)) {
    $uniqId = uniqid();
    $newFileName = "$uniqId.$extension";
    $tmpFile = $imgFile['tmp_name'];
    move_uploaded_file($tmpFile, "./Images/UserImg/$newFileName");

    $userid = (int) $_SESSION['userid'];
    $sql = "UPDATE biodata SET gambar = '$newFileName' WHERE loginid = '$userid' ";
    mysqli_query($db_connection, $sql);
  }
}
$sql = "SELECT gambar
FROM biodata WHERE loginid = '$userid'";

$query = mysqli_query($db_connection, $sql);


$row = mysqli_fetch_assoc($query);
if ($row || $row['gambar'] != '') {
  $gambar = $row['gambar'];
} else {
  $gambar = 'Default.png';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="CSS/Style.CSS">
  <link rel="stylesheet" href="CSS/BootStrap.CSS" />
  <link rel="icon" href="Images/Icon.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
  <script>
    $(document).ready(function() {
      bsCustomFileInput.init()
    })
  </script>
  <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
  <title>Universitas Ini</title>
</head>

<body>
  <!-- Mulai Navbar -->
  <header>
    <nav class="Navbar" id="Navbar">
      <div class="Logo">
        <h2>Universitas Ini</h2>
      </div>
      <ul class="Navbar-Menu">
        <li class="Navbar-Item"><a href="beranda.php">Beranda</a></li>
        <li class="Navbar-Item"><a href="mahasiswa.php">Data Mahasiswa</a></li>
        <li class="Navbar-Item"><a href="transkrip.php">Transkrip Niai</a></li>
        <li class="Navbar-Item"><a href="UKT.php">Informasi UKT</a></li>
        <li class="Navbar-Item"><a href="KRS.php">KRS Online</a></li>
        <li class="Navbar-Item"><a href="logout.php">Logout</a></li>
      </ul>
      <div class="Burger-Menu">
        <div class="Icon-Open Fade"><img src="Images/Icon/Open-Menu.PNG"></div>
        <div class="Icon-Close Fade"><img src="Images/Icon/Close-Menu.PNG"></div>
      </div>
    </nav>
  </header>
  <!-- Akhir Navbar -->
  <!-- Mulai Content -->
  <main>
    <div class="Profile-Lengkap">
      <div class="Box-Photo">

        <div class="Box-Overview">

            <div class="image_area">

                <label for="upload_image">

                  <img src="Images/userImg/<?= $gambar ?>" id="uploaded_image" />
                  <div class="overlay">
                    <button type="button" data-toggle="modal" data-target="#exampleModal">
                      <div class="text">Ubah Foto</div>
                    </button>
                  </div>
                  <form method="post" enctype="multipart/form-data" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah Foto Profil</h5>
                          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button> -->
                        </div>
                        <div class="modal-body">
                            <div class="file-upload">
                              <div class="file-select">
                                <div class="file-select-button" id="fileName">Pilih Foto</div>
                                <div class="file-select-name" id="noFile">Belum Ada Foto...</div> 
                                <input type="file" name="file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                              </div>
                            </div>
                            <p id="Keterangan-Text">*Gunakan Foto Dengan Rasio 1:1 (Rekomendasi)</p>
                            <script>
                            $('#inputGroupFile01').bind('change', function () {
                              var filename = $("#chooseFile").val();
                              if (/^\s*$/.test(filename)) {
                                $(".file-upload").removeClass('active');
                                $("#noFile").text("No file chosen..."); 
                              }
                              else {
                                $(".file-upload").addClass('active');
                                $("#noFile").text(filename.replace("C:\\fakepath\\", "")); 
                              }
                            });
                            </script>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary" name="upload">Simpan</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </label>
            </div>
            <div class="Overview">
            <?php

            $sql = "SELECT nama, prodi
            FROM biodata WHERE loginid = '$userid'";

            $query = mysqli_query($db_connection, $sql);


            while ($row = mysqli_fetch_array($query)) {
              echo '<p>' . $row['nama'] . '</p>
            <p>' . $row['prodi'] . '</p>';
            }
            ?>

          </div>
        </div>
      </div>
      <div class="Box-Biodata">
        <div class="Box-Form">
          <!-- Card Biodata -->
          <div class="Form Biodata">
            <div class="Title">Biodata</div>
            <form class="Biodata" action="" method="post">
              <div class="Input-Box">
                <span class="Details">
                  <p>Nama Mahasiswa</p>
                </span>
                <?php
                $sql = "SELECT nama
                FROM biodata WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="nama" value="' . $row['nama'] . '"   required>';
                } else {
                  echo '<input type="text" name="nama"    required>';
                }
                ?>

              </div>
              <div class="Input-Box">
                <span class="Details">
                  <p>Kewarganegaraan</p>
                </span>
                <?php
                $sql = "SELECT kwn
                FROM biodata WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="kwn" value="' . $row['kwn'] . '"   required>';
                } else {
                  echo '<input type="text" name="kwn"    required>';
                }
                ?>
              </div>

              <div class="Input-Box">
                <span class="Details">
                  <p>Tempat Lahir</p>
                </span>
                <?php
                $sql = "SELECT tempat
                FROM biodata WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="tempat" value="' . $row['tempat'] . '"   required>';
                } else {
                  echo '<input type="text" name="tempat"    required>';
                }
                ?>

                <div class="Input-Box">
                  <span class="Details">
                    <p>Tanggal Lahir</p>
                  </span>
                  <?php
                  $sql = "SELECT ttl
                  FROM biodata WHERE loginid = '$userid'";

                  $query = mysqli_query($db_connection, $sql);


                  $row = mysqli_fetch_assoc($query);
                  if ($row) {
                    $time = strtotime($row['ttl']);

                    $newformat = date('Y-m-d', $time);
                    echo '<input type="date" name="ttl" value="' . $newformat . '"   required>';
                  } else {
                    echo '<input type="date" name="ttl"    required>';
                  }
                  ?>
                </div>
              </div>


              <div class="Input-Box">
                <span class="Details">
                  <p>Agama</p>
                </span>
                <?php
                $sql = "SELECT agama
                FROM biodata WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="agama" value="' . $row['agama'] . '"   required>';
                } else {
                  echo '<input type="text" name="agama"    required>';
                }
                ?>
              </div>
              <div class="Input-Box">
                <span class="Details">
                  <p>No. Identitas</p>
                </span>
                <?php
                $sql = "SELECT nid
                FROM biodata WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="nid" value="' . $row['nid'] . '"   required>';
                } else {
                  echo '<input type="text" name="nid"    required>';
                }
                ?>
              </div>

              <div class="Input-Box">
                <span class="Details">
                  <p>Jenis Kelamin</p>
                </span>
                <?php
                $sql = "SELECT jk
                FROM biodata WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="jk" value="' . $row['jk'] . '"   required>';
                } else {
                  echo '<input type="text" name="jk"    required>';
                }
                ?>
              </div>

              <div class="Input-Box">
                <span class="Details">
                  <p>NIM</p>
                </span>
                <?php
                $sql = "SELECT nim
                FROM biodata WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="nim" value="' . $row['nim'] . '"   required>';
                } else {
                  echo '<input type="text" name="nim"    required>';
                }
                ?>
              </div>

              <div class="Input-Box">
                <span class="Details">
                  <p>Program Studi</p>
                </span>
                <?php
                $sql = "SELECT prodi
                FROM biodata WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="prodi" value="' . $row['prodi'] . '"   required>';
                } else {
                  echo '<input type="text" name="prodi"    required>';
                }
                ?>
              </div>

              <div class="Input-Box">
                <span class="Details">
                  <p>Angkatan</p>
                </span>
                <?php
                $sql = "SELECT angkatan
                FROM biodata WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="angkatan" value="' . $row['angkatan'] . '"   required>';
                } else {
                  echo '<input type="text" name="angkatan"    required>';
                }
                ?>
              </div>

              <div class="Input-Box">
                <span class="Details">
                  <p>Jalur Penerimaan</p>
                </span>
                <?php
                $sql = "SELECT jalur
                FROM biodata WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="jalur" value="' . $row['jalur'] . '"   required>';
                } else {
                  echo '<input type="text" name="jalur"    required>';
                }
                ?>
              </div>

              <?php
              if ($row)
                echo '<input class="Buttons-Form" type="submit" name="btn" value="Update">';
              else echo '<input class="Buttons-Form" type="submit" name="btn" value="Simpan">';

              if (isset($success_message)) {
                echo '<div class="success_message">' . $success_message . '</div>';
              }
              if (isset($error_message)) {
                echo '<div class="error_message">' . $error_message . '</div>';
              }
              ?>

            </form>
          </div>

          <!-- Card Alamat -->
          <div class="Form Address">
            <div class="Title">Alamat</div>
            <form class="Biodata" action="" method="post">
              <div class="Input-Box">
                <span class="Details">
                  <p>Provinsi</p>
                </span>
                <?php
                $sql = "SELECT prov
                FROM alamat WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="prov" value="' . $row['prov'] . '"   required>';
                } else {
                  echo '<input type="text" name="prov"    required>';
                }
                ?>
              </div>
              <div class="Input-Box">
                <span class="Details">
                  <p>Kabupaten/Kota</p>
                </span>
                <?php
                $sql = "SELECT kab
                FROM alamat WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="kab" value="' . $row['kab'] . '"   required>';
                } else {
                  echo '<input type="text" name="kab"    required>';
                }
                ?>
              </div>
              <div class="Input-Box">
                <span class="Details">
                  <p>Kecamatan</p>
                </span>
                <?php
                $sql = "SELECT kec
                FROM alamat WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="kec" value="' . $row['kec'] . '"   required>';
                } else {
                  echo '<input type="text" name="kec"    required>';
                }
                ?>
              </div>
              <div class="Input-Box">
                <span class="Details">
                  <p>Desa</p>
                </span>
                <?php
                $sql = "SELECT desa
                FROM alamat WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="desa" value="' . $row['desa'] . '"   required>';
                } else {
                  echo '<input type="text" name="desa"    required>';
                }
                ?>
              </div>
              <div class="Input-Box">
                <span class="Details">
                  <p>Jalan</p>
                </span>
                <?php
                $sql = "SELECT jln
                FROM alamat WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="jln" value="' . $row['jln'] . '"   required>';
                } else {
                  echo '<input type="text" name="jln"    required>';
                }
                ?>
              </div>

              <?php
              if ($row)
                echo '<input class="Buttons-Form" type="submit" name="btn" value="Update">';
              else echo '<input class="Buttons-Form" type="submit" name="btn" value="Simpan">';

              if (isset($success_message)) {
                echo '<div class="success_message">' . $success_message . '</div>';
              }
              if (isset($error_message)) {
                echo '<div class="error_message">' . $error_message . '</div>';
              }
              ?>
            </form>
          </div>
          <!-- Card Asal Sekolah -->
          <div class="Form Origin">
            <div class="Title">Asal Sekolah</div>
            <form class="Biodata" action="" method="post">
              <div class="Input-Box">
                <span class="Details">
                  <p>Provinsi</p>
                </span>
                <?php
                $sql = "SELECT prov
                FROM sekolah WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="prov" value="' . $row['prov'] . '"   required>';
                } else {
                  echo '<input type="text" name="prov"    required>';
                }
                ?>
              </div>
              <div class="Input-Box">
                <span class="Details">
                  <p>Kabupaten</p>
                </span>
                <?php
                $sql = "SELECT kab
                FROM sekolah WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="kab" value="' . $row['kab'] . '"   required>';
                } else {
                  echo '<input type="text" name="kab"    required>';
                }
                ?>
              </div>
              <div class="Input-Box">
                <span class="Details">
                  <p>Kecamatan</p>
                </span>
                <?php
                $sql = "SELECT kec
                FROM sekolah WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="kec" value="' . $row['kec'] . '"   required>';
                } else {
                  echo '<input type="text" name="kec"    required>';
                }
                ?>
              </div>
              <div class="Input-Box">
                <span class="Details">
                  <p>Nama Sekolah</p>
                </span>
                <?php
                $sql = "SELECT nama
                FROM sekolah WHERE loginid = '$userid'";

                $query = mysqli_query($db_connection, $sql);


                $row = mysqli_fetch_assoc($query);
                if ($row) {
                  echo '<input type="text" name="nama" value="' . $row['nama'] . '"   required>';
                } else {
                  echo '<input type="text" name="nama"    required>';
                }
                ?>
              </div>

              <?php
              if ($row)
                echo '<input class="Buttons-Form" type="submit" name="btn" value="Update">';
              else echo '<input class="Buttons-Form" type="submit" name="btn" value="Simpan">';

              if (isset($success_message)) {
                echo '<div class="success_message">' . $success_message . '</div>';
              }
              if (isset($error_message)) {
                echo '<div class="error_message">' . $error_message . '</div>';
              }
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Konten -->
  </main>
</body>
<script src="JavaScript/JavaScript_Base.JS">
</script>
<script src="JavaScript/script.js"></script>

</html>

<!-- <div id="insertimageModal" class="modal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Crop & Insert Image</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-8 text-center">
                      <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>
                    <div class="col-md-4" style="padding-top:30px;">
                      <br />
                      <br />
                      <br />
                      <button class="btn btn-success crop_image">Crop & Insert Image</button>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <script>
            $(document).ready(function() {

              $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                  width: 200,
                  height: 200,
                  type: 'square' //circle
                },
                boundary: {
                  width: 300,
                  height: 300
                }
              });

              $('#insert_image').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(event) {
                  $image_crop.croppie('bind', {
                    url: event.target.result
                  }).then(function() {
                    console.log('jQuery bind complete');
                  });
                }
                reader.readAsDataURL(this.files[0]);
                $('#insertimageModal').modal('show');
              });

              $('.crop_image').click(function(event) {
                $image_crop.croppie('result', {
                  type: 'canvas',
                  size: 'viewport'
                }).then(function(response) {
                  $.ajax({
                    url: 'insert.php',
                    type: 'POST',
                    data: {
                      "image": response
                    },
                    success: function(data) {
                      $('#insertimageModal').modal('hide');
                      load_images();
                      alert(data);
                    }
                  })
                });
              });

              load_images();

              function load_images() {
                $.ajax({
                  url: "fetch_images.php",
                  success: function(data) {
                    $('#store_image').html(data);
                  }
                })
              }

            });
          </script> -->

<!-- <script>
  $(document).ready(function() {

    var $modal = $('#modal');

    var image = document.getElementById('sample_image');

    var cropper;

    $('#upload_image').change(function(event) {
      var files = event.target.files;

      var done = function(url) {
        image.src = url;
        $modal.modal('show');
      };

      if (files && files.length > 0) {
        reader = new FileReader();
        reader.onload = function(event) {
          done(reader.result);
        };
        reader.readAsDataURL(files[0]);
      }
    });

    $modal.on('shown.bs.modal', function() {
      cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
        preview: '.preview'
      });
    }).on('hidden.bs.modal', function() {
      cropper.destroy();
      cropper = null;
    });

    $('#crop').click(function() {
      canvas = cropper.getCroppedCanvas({
        width: 400,
        height: 400
      });

      canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function() {
          var base64data = reader.result;
          $.ajax({
            url: 'upload.php',
            method: 'POST',
            data: {
              image: base64data
            },
            success: function(data) {
              $modal.modal('hide');
              $('#uploaded_image').attr('src', data);
            }
          });
        };
      });
    });

  });
</script> -->

<!--<script>
  $(document).ready(function() {

    var $modal = $('#modal');

    var image = document.getElementById('sample_image');

    var cropper;

    $('#upload_image').change(function(event) {
      var files = event.target.files;

      var done = function(url) {
        image.src = url;
        $modal.modal('show');
      };

      if (files && files.length > 0) {
        reader = new FileReader();
        reader.onload = function(event) {
          done(reader.result);
        };
        reader.readAsDataURL(files[0]);
      }
    });

    $modal.on('shown.bs.modal', function() {
      cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
        preview: '.preview'
      });
    }).on('hidden.bs.modal', function() {
      cropper.destroy();
      cropper = null;
    });

    $('#crop').click(function() {
      canvas = cropper.getCroppedCanvas({
        width: 400,
        height: 400
      });

      canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function() {
          var base64data = reader.result;
          $.ajax({
            url: 'upload.php',
            method: 'POST',
            data: {
              image: base64data
            },
            success: function(data) {
              $modal.modal('hide');
              $('#uploaded_image').attr('src', data);
            }
          });
        };
      });
    });

  });
</script> -->