                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Announcement</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                        <?= $this->session->flashdata('alert'); ?>
                            <form class="user" method="post" action="<?= base_url('Announcement/send');?>">
                                <div class="form-group row">
                                    <label for="input-title" class="col-sm-2 col-form-label">Title: </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="input-title" name="title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="select-user" class="col-sm-2 col-form-label">Select User: </label>
                                    <div class="col-sm-10">
                                        <select multiple class="form-control" id="select-user" name="select-user">
                                            <option value="all">All User</option>
                                            <?php
                                                foreach($list_user as $row_user)
                                                {
                                                    ?>
                                                    <option value="<?=$row_user->id;?>"><?=$row_user->first_name;?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-content" class="col-sm-2 col-form-label">Content Announcement: </label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control texteditor" id="input-content" rows="10" name="content"></textarea>
                                    </div>
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