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
                                            <form action="<?php echo site_url('kasir/changePass') ?>" method="post">
                                                <div class="form-group row">
                                                    <label for="example-url-input" class="col-md-4 col-form-label">Name</label>
                                                    <div class="col-md-8" style="margin-top:10px">
                                                        <?php echo $data->NAMA; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-url-input" class="col-md-4 col-form-label">Old Password</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="old_password" id="old_password" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-url-input" class="col-md-4 col-form-label">New Password</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="new_password" id="new_password" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-url-input" class="col-md-4 col-form-label">Re-Password</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="re_password" id="re_password" required="" onkeyup="cek_password();">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12" id="kembali">
                                                       
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-url-input" class="col-md-4 col-form-label"></label>
                                                    <div class="col-md-8">
                                                        <input type="submit" value="Save" class="btn btn-success" style="float: right;">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <script type="text/javascript">
                    function cek_password()
                    {
                        if($("#new_password").val()==$("#re_password").val())
                        {
                            $("#kembali").html(' <div class="alert alert-info" role="alert">Password Valid</div>');
                        }
                        else
                        {
                            $("#kembali").html(' <div class="alert alert-danger" role="alert">Password Not Valid</div>');
                        }
                    }
                    </script>