<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--title -->
    <title>Pembayaran</title>
    <!-- google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,900' rel='stylesheet' type='text/css'>
    <!-- stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/flexslider.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/style1.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/responsive.css'); ?>" type="text/css" />
    <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script defer src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
</head>

<body>
<header>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('img/PolinemaXX_logo.png');?>" class="logo-hdr" width="300">
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="<?php echo base_url(); ?>member"><img src="<?php echo base_url('img/movie_black.png');?>" width="35px" height="30px"><br>
                            <span><br>Tayang</span></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>member/theater"><img src="<?php echo base_url('img/theater_black.png'); ?>" width="35px" height="30px"><br>
                            <span><br>Theater</span></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>member/wilayah"><img src="<?php echo base_url('img/location.png');?>" width="30px" height="30px"><br>
                            <span><br>Wilayah</span></a>
                        </li>
                        <li class="last-child">
                            <a href="<?php echo base_url();?>polinemaxx/logout"><img src="<?php echo base_url('img/user.png');?>" width="30px" height="30px"><br>
                            <span><br>Logout</span></a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    <li style="padding-top: 18px">
                            <div class="btn-group">
                              <a class="btn btn-primary" href="#"><i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata("nama");?></a>
                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="fa fa-caret-down" title="Toggle dropdown menu"></span>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url();?>member/profile"><i class="fa fa-pencil fa-fw"></i> Profile</a></li>
                                <li><a href="<?php echo base_url();?>polinemaxx/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                              </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>
    </header>
    <!-- header -->

    <div class="ser-list">
        <div class="container">
            <div class="row">
            <h3 style="color: #000066">Transaksi Tiket Bioskop<br><br></h3>
        
                <table class="table table-bordered table-hover table-striped" id="theater" width="70%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="text-center info">Nama</th>
                      <th class="text-center info">Judul Film</th>
                      <th class="text-center info">Bioskop</th>
                      <th class="text-center info">Jam</th>
                      <th class="text-center info">Jumlah Tiket</th>
                      <th class="text-center info">Kursi</th>
                      <th class="text-center info">Harga</th>
                      <th class="text-center info">Bayar</th>
                      <th class="text-center info">Total</th>
                    </tr>
                  </thead>
                  <tbody align="center">
                  <?php
                    foreach($pembayaran as $b):?>
                    <tr>
                      <td><?php echo $this->session->userdata("nama");?></td>
                      <td><?= $b['film']; ?></td>
                      <td><?= $b['bioskop']; ?></td>
                      <td><?= $b['jam']; ?></td>
                      <td><?= $b['jumlah']; ?></td>
                      <td><?= $b['kursi']; ?></td>
                      <td><?= $b['harga']; ?></td>
                      <td><?= $b['bayar']; ?></td>
                      <td><?= $b['total']; ?></td>
                    </tr><?php
                    endforeach; ?>
                  </tbody>
                </table>
        </div>  
                <a href="<?php echo base_url(); ?>member"><button class="btn btn-danger">Kembali</button></a>
            </div>
        </div>
    </div>

    <br><br><br><br>
    <!-- footer -->
     <footer>
        <div class="container">
            <div class="footer-line">
                <h4> Copyrights &copy 2020 <a href="#">PolinemaXX</a>. All Right Reserved</h4>
            </div>
        </div>
    </footer>
    <!-- footer -->

   <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script defer src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
    
    
</body>

</html>