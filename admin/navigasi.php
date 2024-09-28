<form method="post" action="perhitungan.php">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#"><img src="../img/logo.png" width="50"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav" style="margin: 10px;">
                <a class="nav-link active" href="index.php">
                    <font size="4"><b>Beranda</b> </font>
                </a>
                <a class="nav-link" href="data_kriteria.php">
                    <font size="4"><b>Data Kritria</b></font>
                </a>
                <a class="nav-link" href="data_guru.php">
                    <font size="4"><b>Data Guru</b></font>
                </a>
                <a class="nav-link" href="#">
                    <font size="4"><b><button type="submit" name="perhitungan" class="btn btn-primary" style="font-size: 20px; margin-top: -10px;"><b>Perhitungan</b></button></b></font>
                </a>
                <a class="nav-link" href="laporan.php">
                    <font size="4"><b>Laporan</b></font>
                </a>
                <a class="nav-link" href="setting_akun.php">
                    <font size="4"><b>Setting Akun</b></font>
                </a>

            </div>

            <div class="navbar-nav ms-auto" style="margin: 10px;">
                <a href="" type="button" class="log nav-link m-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <font size="4"><b>Logout</b></font>
                    <img src="../img/logout.png" width="30">
                </a>
            </div>

        </div>
    </nav>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin keluar ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="../logout.php" type="button" class="btn btn-danger">Keluar</a>
                </div>
            </div>
        </div>
    </div>
</form>