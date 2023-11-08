
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout');?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="hdnSession" data-value="<?= $this->session->userdata('userid'); ?>" />

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="<?= base_url('assets/'); ?>js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url('assets/'); ?>js/demo/chart-pie-demo.js"></script> -->
    <script src="<?= base_url('assets/'); ?>js/sweetalert2.all.min.js"></script>
    <!-- panggil ckeditor.js -->
    <script type="text/javascript" src="<?= base_url('assets/'); ?>ckeditor/ckeditor.js"></script>
    <!-- panggil adapter jquery ckeditor -->
    <script type="text/javascript" src="<?= base_url('assets/'); ?>ckeditor/adapters/jquery.js"></script>

    <!-- <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
    <script src="<?= base_url('assets/'); ?>datatables/datatables.min.js"></script>
    
    <!-- pusher -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script type="text/javascript">
        // datatable
        // $(document).ready(function() {
        //     $('#dataTable').DataTable();
        // });

        var table;
        $(document).ready(function() {

        //datatables
        table = $('#dataTable').DataTable({ 
    
                "processing": true, 
                "serverSide": true, 
                "order": [], 
                
                "ajax": {
                    "url": "<?php echo base_url('Announcement/get_data_announcement')?>",
                    "type": "POST"
                },
    
                
                "columnDefs": [
                { 
                    "targets": [ 0 ], 
                    "orderable": false, 
                },
                ],
    
            });
    
        });

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('83737de8d744dc180234', {
            cluster: 'ap1'
        });

        var channel_announcement = pusher.subscribe('channel-announcement');
        channel_announcement.bind('event-annountcement', function(data) {
            // alert(JSON.stringify(data));
            var user = data.user;
            var sessionValue = $("#hdnSession").data('value');


            if (user == sessionValue) {
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('announcement/list'); ?>",
                    data: {user: user},
                    success: function(response) {
                        $('#list-announcement').html(response);
                    }
                });
            }
        });

        $("#formUser").submit(function (e) 
        {
            e.preventDefault();
            var getUrl = window.location;
            var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
            var url = baseUrl + "/user/inputUser";

            $.ajax({
                url: url,
                type: 'POST',
                data: $("#formUser").serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $("#btn-submit").replaceWith("<button type='submit' id='btn-submit' class='btn btn-secondary btn-user btn-block' disabled>Sending Data....</button>");
                },
                error: function (error) {
                    $("#btn-submit").replaceWith("<button type='submit' id='btn-submit' class='btn btn-primary btn-user btn-block'>Register Account</button>");
                    Swal.fire('Error', error, 'failed');
                },
                success: function (response) {
                    $("#btn-submit").replaceWith("<button type='submit' id='btn-submit' class='btn btn-primary btn-user btn-block'>Register Account</button>");

                    $.each(response, function (key, value) {
                        $('#input-' + key).parents('.data-error').find('#error').html(value);
                        
                        if (key == 'success') 
                        {
                            // alert('sukses insert');
	           			    Swal.fire('Success', value, 'success');

                            $('#input-firstname').parents('.data-error').find('#error').html(" ");
                            $('#input-lastname').parents('.data-error').find('#error').html(" ");
                            $('#input-email').parents('.data-error').find('#error').html(" ");
                            $('#input-password').parents('.data-error').find('#error').html(" ");
                            $('#input-repeat').parents('.data-error').find('#error').html(" ");
    
                            $('#formUser')[0].reset();
                        }
                        else if(key == 'failed')
                        {
                            Swal.fire('Failed', value, 'failed');
                        }
                    });
                }
            });

            $('#formUser input').on('keyup', function () {
                $(this).parents('.data-error').find('#error').html(" ");
            });
        });

        //send email
        $("#formEmail").submit(function (e) 
        {
            e.preventDefault();
            var getUrl = window.location;
            var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
            var url = baseUrl + "/Mailbox/sendEmail";

            $.ajax({
                url: url,
                type: 'POST',
                data: $("#formEmail").serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $("#btn-email").replaceWith("<button type='submit' class='btn btn-secondary' id='btn-email'>Sending Email...</button>");
                },
                error: function (error) {
                    $("#btn-email").replaceWith("<button type='submit' class='btn btn-primary' id='btn-email'>Send</button>");
                    Swal.fire('Error', error, 'failed');
                },
                success: function (response) {
                    $("#btn-email").replaceWith("<button type='submit' class='btn btn-primary' id='btn-email'>Send</button>");

                    $.each(response, function (key, value) {
                        $('#input-' + key).parents('.data-error').find('#error').html(value);
                        
                        if (key == 'success') 
                        {
                            // alert('sukses insert');
	           			    Swal.fire('Success', value, 'success');

                            $('#input-subject').parents('.data-error').find('#error').html(" ");
                            $('#input-to').parents('.data-error').find('#error').html(" ");
                            $('#input-write').parents('.data-error').find('#error').html(" ");
    
                            $('#formEmail')[0].reset();
                        }
                        else if(key == 'failed')
                        {
                            Swal.fire('Failed', value, 'failed');
                        }
                    });
                }
            });

            $('#formUser input').on('keyup', function () {
                $(this).parents('.data-error').find('#error').html(" ");
            });
        });

        $('textarea.texteditor').ckeditor();
    </script>
</body>

</html>