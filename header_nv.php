<header>
    <div class="logo">
        <a href="/CDTN/index_none.php" class="row">
            <img src="/CDTN/images/logo.jpeg" alt="">
            <h2>GIÀY ĐẸP NT</h2>
        </a>
    </div>
    <div class="search">
        <form action="/CDTN/shoe/grid.php" method="get">
            <input type="text" placeholder="Tìm kiếm..." name="TenGiay">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="avatar">
        <img src="/CDTN/employee/images/avatar_nam.jpeg" alt="">
        <i class="fa-solid fa-caret-down"></i>
    </div>
</header>
<div class="sub-header">
    <div class="menu">
        <li><a href="">TRANG CHỦ</a></li>
        <li><a href="/CDTN/shoe/grid.php">SẢN PHẨM</a></li>
        <?php 
        require ("connect.php");
        $sql = "SELECT MaLG, TenLG
                FROM LoaiGiay";
        $result = mysqli_query($conn, $sql);

        $sql1 = "SELECT DISTINCT LoaiGiay.MaLG, TenHG
                        FROM HangGiay, LoaiGiay, Giay
                        WHERE HangGiay.MaHG = Giay.MaHG AND LoaiGiay.MaLG = Giay.MaLG";
        $result1 = mysqli_query($conn, $sql1);
        
        if (mysqli_num_rows($result) <> 0 && mysqli_num_rows($result1) <> 0) {
            while ($rows = mysqli_fetch_row($result)) {
                echo "<li><a href=''>$rows[1]</a>";
                    echo "<ul class='sub-menu'>";
                        while ($rows1 = mysqli_fetch_row($result1)) {
                            if ($rows1[0] == $rows[0])
                                echo "<li><a href=''>$rows1[1]</a></li>";
                        }
                    echo "</ul>";
                echo "</li>";
            }
        }
        ?>
        <li><a href="/CDTN/receipt/list.php">QUẢN LÝ HOÁ ĐƠN</a></li>
    </div>
</div>