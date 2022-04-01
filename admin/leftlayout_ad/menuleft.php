<style>
    .content.active{
        background-color: var(--primary);
        color: var(--light) !important;
        border-radius: .25rem;
        box-shadow: .25rem .25rem .5rem #0005;
    }
    .content.active a{
       color: inherit;
    }
</style>
    
<br>

<h3><span class="badge badge-pill badge-primary">Bảng điều khiển</span></h3>
<ul class="nav flex-column nav-fill">
    <li class=" content <?php echo $_SERVER["SCRIPT_NAME"]=="/admin/noiquy/index.php"?"active":""  ?>">
        <a class="nav-link" href="../noiquy/index.php">Nội quy</a>
    </li>
    <li class="content  <?php echo $_SERVER["SCRIPT_NAME"]=="/admin/tructuan/index.php"?"active":""  ?>" >
        <a class="nav-link" href="../tructuan/index.php">Trực tuần</a>
    </li>
    <li class="content  <?php echo $_SERVER["SCRIPT_NAME"]=="/admin/tongkettuan/index.php"?"active":""  ?>" >
        <a class="nav-link" href="../tongkettuan/index.php">Tổng kết tuần</a>
    </li>
    <li class="content  <?php echo $_SERVER["SCRIPT_NAME"]=="/admin/hocsinh/index.php"?"active":""  ?>" >
        <a class="nav-link" href="../hocsinh/index.php">Học sinh</a>
    </li>
    <li class="content  <?php echo $_SERVER["SCRIPT_NAME"]=="/admin/thongke/index.php"?"active":""  ?>" >
        <a class="nav-link" href="../thongke/index.php">Thống kê vi phạm</a>
    </li>
    <li class="content  <?php echo $_SERVER["SCRIPT_NAME"]=="/admin/daunam/index.php"?"active":""  ?>" >
        <a class="nav-link" href="../daunam/index.php">Dữ liệu đầu năm</a>
    </li>
    <li class="content  <?php echo $_SERVER["SCRIPT_NAME"]=="/admin/qlnguoidung/index.php"?"active":""  ?>" >
        <a class="nav-link" href="../qlnguoidung/index.php">Quản lý người dùng</a>
    </li>
</ul>
<br>