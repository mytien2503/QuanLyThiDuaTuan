<div class="btn-group" role="group" aria-label="Basic example" style="width:100%">
    <!--<a style="width:33%;" type="button" class="btn btn-secondary"  href="nam.php?location=nam">Xem năm học</a> -->
    <div style="width:33%;">
        <form method="POST">
            <input type="hidden" name="action" value="xemnam">
            <input type="submit" style="width:100%;" class="btn btn-secondary" value="Xem năm học">
        </form>
    </div>
    <div style="width:33%;">
        <form method="POST">
            <input type="hidden" name="action" value="xemkhoi">
            <input type="submit" style="width:100%;" class="btn btn-secondary" value="Xem khối">
        </form>
    </div>
    
    <div style="width:33%;">
        <form method="POST">
            <input type="hidden" name="action" value="xemlop">
            <input type="submit" style="width:100%;" class="btn btn-secondary" value="Xem Lớp">
        </form>
    </div>
</div>
<hr/>
<div class="btn-group" role="group" aria-label="Basic example" style="width:100%">
    <?php if (isset($location)) {
        $L = $location;
    ?>
        <?php if ($L == "nam") {
        ?>
            <a style="width:33%;" type="button" class="btn btn-warning mb-2"  id="buttonthem">Thêm năm học</a>
        <?php
        } else if ($L == "khoi") { ?>
            <a style="width:33%;" type="button" class="btn btn-warning mb-2"id="buttonthem">Thêm khối</a>
        <?php
        } else if ($L = "lop") {
        ?>
            <a style="width:33%;" type="button" class="btn btn-warning mb-2" id="buttonthem">Thêm lớp</a>
        <?php } ?>
    <?php
    } ?>

</div>