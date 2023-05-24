                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add User</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <form class="user" id="formUser">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0 data-error">
                                        <input type="text" class="form-control form-control-user" id="input-firstname" name="firstname"
                                            placeholder="First Name">
                                        <div id="error"></div>
                                    </div>
                                    <div class="col-sm-6 data-error">
                                        <input type="text" class="form-control form-control-user" id="input-lastname" name="lastname"
                                            placeholder="Last Name">
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="form-group data-error">
                                    <input type="email" class="form-control form-control-user" id="input-email" name="email"
                                        placeholder="Email Address">
                                    <div id="error"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0 data-error">
                                        <input type="password" class="form-control form-control-user"
                                            id="input-password" name="password" placeholder="Password">
                                        <div id="error"></div>
                                    </div>
                                    <div class="col-sm-6 data-error">
                                        <input type="password" class="form-control form-control-user"
                                            id="input-repeat" name="repeat-password" placeholder="Repeat Password">
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <button type="submit" id="btn-submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
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