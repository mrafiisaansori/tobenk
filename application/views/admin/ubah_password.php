<!-- Page-Title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Ubah Password</h4>
                <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Ubah Password</li>
                </ol>
            </div>
        </div>

    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo site_url('admin/ubahPassword') ?>" method="post">
                            <div class="form-group row">
                                <label for="example-url-input" class="col-md-4 col-form-label">Name</label>
                                <div class="col-md-8" style="margin-top:10px">
                                    <?php echo $user->NAMA; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-url-input" class="col-md-4 col-form-label">Password Lama</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="password_lama" id="password_lama" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-url-input" class="col-md-4 col-form-label">Password Baru</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="password_baru" id="password_baru" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-url-input" class="col-md-4 col-form-label">Ulangi Password</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="ulangi_password" id="ulangi_password" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-url-input" class="col-md-4 col-form-label"></label>
                                <div class="col-md-8">
                                    <input type="submit" value="Ubah" class="btn btn-success" style="float: right;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 