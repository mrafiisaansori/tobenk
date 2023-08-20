<style>
    .page-link {
        cursor: pointer !important;
    }
</style>
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">List Kerjaan</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">List Kerjaan</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-right d-none d-md-block">
                    <img src="<?php echo site_url('theme/loader.gif'); ?>" width="50px" style="display: none;" id="loading">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php if (!$data) {
                            echo "<center><h2 style='color:red;'>Belum Ada List Kerjaan</h2></center>";
                        } else { ?>
                            <div class="d-flex justify-content-center">
                                <div class="row">
                                    <?php foreach ($data as $dataVal) : ?>
                                        <div class="col-md-3">
                                            <a href="<?= base_url('produksi/detailList/' . base64_encode_fix($dataVal->ID)) ?>">
                                                <div class="card" style="border: 1px solid #6c757d;text-align:center;">
                                                    <div class="card-header text-align-center bg-primary">
                                                        <h4 style="color:white !important;">
                                                            No. <?php echo sprintf("%06d", $dataVal->ID); ?>
                                                        </h4>
                                                    </div>
                                                    <div class="card-body" style="border-top: 1px solid #6c757d;border-bottom: 1px solid #6c757d;">
                                                        <img class="img-fluid" src="<?= base_url('upload/mockup/' . $dataVal->MOCKUP) ?>" alt="img  <?php echo sprintf("%06d", $dataVal->ID); ?>">
                                                    </div>
                                                    <?php
                                                    //date diff
                                                    $date1 = new DateTime($dataVal->ESTIMASI_SELESAI);
                                                    $date2 = new DateTime(date('Y-m-d'));
                                                    $interval = $date1->diff($date2);
                                                    $selisih =  $interval->format('%R%a');
                                                    if ($selisih < -1) {
                                                        $color = 'bg-secondary';
                                                        $deadline = tgl_indo_lengkap($dataVal->ESTIMASI_SELESAI);
                                                    } else if ($selisih == -1) {
                                                        $color = 'bg-danger';
                                                        $deadline = 'BESOK';
                                                    } else if ($selisih == 0) {
                                                        $color = 'bg-success';
                                                        $deadline = 'HARI INI';
                                                    } else {
                                                        $color = 'bg-danger';
                                                        $deadline = 'LEWAT ' . $selisih . ' HARI';
                                                    }

                                                    ?>
                                                    <div class="card-footer <?= $color; ?>">
                                                        <h5 style="color:white !important;">
                                                            Deadline<br>
                                                            <?= $deadline; ?>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <nav aria-label="Page navigation example">
                                <form method="post" action="">
                                    <ul class="pagination justify-content-center">
                                        <p>
                                            <!-- If the current page is more than 1, show the First and Previous links -->
                                            <?php if ($current_page > 1) : ?>
                                                <li class="page-item">
                                                    <button class="page-link" name="page" type="submit" value="<?= $current_page - 1 ?>">Previous</button>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                            //setup starting point
                                            //$max is equal to number of links shown
                                            $max = 7;
                                            if ($current_page < $max)
                                                $sp = 1;
                                            elseif ($current_page >= ($total_page - floor($max / 2)))
                                                $sp = $total_page - $max + 1;
                                            elseif ($current_page >= $max)
                                                $sp = $current_page  - floor($max / 2);
                                            ?>
                                            <!-- If the current page >= $max then show link to 1st page -->
                                            <?php if ($current_page >= $max) : ?>
                                                <li class="page-item"><button class="page-link" name="page" type="submit" value="1">1</button></li>
                                            <?php endif; ?>
                                            <!-- Loop though max number of pages shown and show links either side equal to $max / 2 -->
                                            <?php for ($i = $sp; $i <= ($sp + $max - 1); $i++) : ?>
                                                <?php
                                                if ($i > $total_page)
                                                    continue;
                                                ?>
                                                <?php if ($current_page == $i) : ?>
                                                    <li class="page-item active"><button class="page-link" name="page" type="submit" value="<?= $i; ?>"><?= $i ?></button></li>
                                                <?php else : ?>
                                                    <li class="page-item"><button class="page-link" name="page" type="submit" value="<?= $i; ?>"><?= $i ?></button></li>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                            <!-- If the current page is less than say the last page minus $max pages divided by 2-->
                                            <?php if ($current_page < ($total_page - floor($max / 2))) : ?>
                                                <li class="page-item"><button class="page-link" name="page" type="submit" value="<?= $total_page; ?>"><?= $total_page ?></button></li>
                                            <?php endif; ?>
                                            <!-- Show last two pages if we're not near them -->
                                            <?php if ($current_page < $total_page) : ?>
                                                <li class="page-item">
                                                    <button class="page-link" name="page" type="submit" value="<?= $current_page + 1 ?>">Next</button>
                                                </li>
                                            <?php endif; ?>
                                        </p>
                                    </ul>
                                </form>
                            </nav>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>