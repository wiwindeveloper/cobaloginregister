                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Send Message</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <form class="user" id="formEmail">
                                <div class="form-group row data-error">
                                    <label for="input-subject" class="col-sm-2 col-form-label">Subject: </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="input-subject" name="subject">
                                    </div>
                                    <div id="error"></div>
                                </div>
                                <div class="form-group row data-error">
                                    <label for="input-to" class="col-sm-2 col-form-label">To: </label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="input-to" name="to">
                                    </div>
                                    <div id="error"></div>
                                </div>
                                <div class="form-group row data-error">
                                    <label for="input-write" class="col-sm-2 col-form-label">Write: </label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control texteditor" id="input-write" rows="10" name="write"></textarea>
                                    </div>
                                    <div id="error"></div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary" id="btn-email">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->