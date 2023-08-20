<!-- Page-Title -->
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1"></h4>
                <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active"></li>
                </ol>
            </div>
        </div>

    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="page-content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-10">

                                                    <div class="card border mt-4">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <div class="icons-xl uim-icon-primary my-4">
                                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-primary" d="M10.3125,16.09375a.99676.99676,0,0,1-.707-.293L6.793,12.98828A.99989.99989,0,0,1,8.207,11.57422l2.10547,2.10547L15.793,8.19922A.99989.99989,0,0,1,17.207,9.61328l-6.1875,6.1875A.99676.99676,0,0,1,10.3125,16.09375Z" opacity=".99"></path><path class="uim-tertiary" d="M12,2A10,10,0,1,0,22,12,10.01146,10.01146,0,0,0,12,2Zm5.207,7.61328-6.1875,6.1875a.99963.99963,0,0,1-1.41406,0L6.793,12.98828A.99989.99989,0,0,1,8.207,11.57422l2.10547,2.10547L15.793,8.19922A.99989.99989,0,0,1,17.207,9.61328Z"></path></svg></span>
                                                                </div>
                                                                <h4 class="alert-heading font-size-20">Transaksi Berhasil</h4>
                                                                <p class="text-muted">silahkan pilih jenis nota yang anda inginkan </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-lg-6">
                                                            <div class="card border shadow-none" style="border: 1px solid #2fa97c!important;">
                                                                <div class="card-body">
                                                                    <div class="media">
                                                                        <div class="icons-md mr-3">
                                                                            <i class="mdi mdi-printer" style='font-size:22pt;color:#2fa97c'></i>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <h5 class="mb-1">Cetak Fisik</h5>
                                                                            <p class="text-muted">Cetak pada printer yang disediakan oleh toko</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
        
                                                                <div class="card-footer text-center" style="background-color:#2fa97c;border-top:0 solid #2fa97c;color:white">
                                                                    <a style="color:white;font-size:14pt" target="_blank" href="<?php echo site_url('kasir/cetak/'.base64_encode_fix($id).'/'.base64_encode_fix($bayar)); ?>">Cetak</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-lg-6">
                                                            <div class="card border shadow-none" style="border: 1px solid #2fa97c!important;">
                                                                <div class="card-body">
                                                                    <div class="media">
                                                                        <div class="icons-md mr-3">
                                                                            <i class="mdi mdi-whatsapp" style='font-size:22pt;color:#2fa97c'></i>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <h5 class="mb-1">Kirim Ke WhatsApp</h5>
                                                                            <p class="text-muted">Pembeli akan mendapatkan Nota melalui WhatsApp</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
        
                                                                <div class="card-footer text-center" style="background-color:#2fa97c;border-top:0 solid #2fa97c;color:white">
                                                                    <a style="color:white;font-size:14pt" href="javascript:void(0);" data-toggle="modal" data-target=".bs-example-modal-sm">Kirim</a>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-lg-6">
                                                            <div class="card border shadow-none" style="border: 1px solid #2fa97c!important;">
                                                                <div class="card-body">
                                                                    <div class="media">
                                                                        <div class="icons-md mr-3">
                                                                            <i class="mdi mdi-home" style='font-size:22pt;color:#2fa97c'></i>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <h5 class="mb-1">Ke Menu Utama</h5>
                                                                            <p class="text-muted">Kembali ke menu utama atau tanpa nota</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
        
                                                                <div class="card-footer text-center" style="background-color:#2fa97c;border-top:0 solid #2fa97c;color:white">
                                                                    <a style="color:white;font-size:14pt" href="<?php echo site_url('transaksi-full.html'); ?>">Kembali</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- end row -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                        </div>
                        <!-- end container-fluid -->
                    </div> 
                    <!--  Modal content for the above example -->
                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Kirim Ke WhatsApp</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo site_url('kasir/kirimWa') ?>" method="post">
                                        <input type="hidden" class="form-control" name="parse" id="parse" value="<?php echo $parse; ?>">
                                        <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder='Contoh : 08xxx' required value="<?php echo $transaksi->NO_TELP; ?>">
                                        <br>
                                        <input type="submit" class="btn btn-primary" style="width:100%" value="Kirim Nota">
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <script>
                        // Restricts input for the given textbox to the given inputFilter function.
                        function setInputFilter(textbox, inputFilter, errMsg) {
                        [ "input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout" ].forEach(function(event) {
                            textbox.addEventListener(event, function(e) {
                            if (inputFilter(this.value)) {
                                // Accepted value.
                                if ([ "keydown", "mousedown", "focusout" ].indexOf(e.type) >= 0){
                                this.classList.remove("input-error");
                                this.setCustomValidity("");
                                }

                                this.oldValue = this.value;
                                this.oldSelectionStart = this.selectionStart;
                                this.oldSelectionEnd = this.selectionEnd;
                            }
                            else if (this.hasOwnProperty("oldValue")) {
                                // Rejected value: restore the previous one.
                                this.classList.add("input-error");
                                this.setCustomValidity(errMsg);
                                this.reportValidity();
                                this.value = this.oldValue;
                                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                            }
                            else {
                                // Rejected value: nothing to restore.
                                this.value = "";
                            }
                            });
                        });
                        }
                        setInputFilter(document.getElementById("no_hp"), function(value) {
                        return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp.
                        }, "Only digits and '.' are allowed");
                    </script>