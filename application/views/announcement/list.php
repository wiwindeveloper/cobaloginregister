                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">List of Announcement</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <?php
                             echo $this->session->flashdata('alert'); 
                            ?> 
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </tfoot>
                                    <!-- <tbody>
                                        <?php
                                            foreach($list_ann as $row)
                                            {
                                        ?>
                                        <tr>
                                            <td><?= $row->title; ?></td>
                                            <td><?= $row->content; ?></td>
                                            <td><?= $row->status == '0' ? 'unread' : 'read'; ?></td>
                                            <td><?= $row->date; ?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody> -->
                                </table>
                            </div>
                        </div>
                    </div>
                            
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