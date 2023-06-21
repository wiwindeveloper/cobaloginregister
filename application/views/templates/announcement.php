
<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-bell fa-fw"></i>
    <!-- Counter - Alerts -->
    <?php
        if($amount_annount > 0){
    ?>
        <span class="badge badge-danger badge-counter"><?=$amount_annount;?></span>
    <?php
        }
    ?>
</a>
<!-- Dropdown - Alerts -->
<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
    aria-labelledby="alertsDropdown">
    <h6 class="dropdown-header">
        Announcement
    </h6>
    <?php
        foreach($list_annount as $row_list)
        {
    ?>
    <a class="dropdown-item d-flex align-items-center" href="#">
        <div class="mr-3">
            <div class="icon-circle bg-warning">
                <i class="fas fa-exclamation-triangle text-white"></i>
            </div>
        </div>
        <div>
            <div class="small text-gray-500"><?= $row_list->date; ?></div>
            <?= $row_list->title; ?>
        </div>
    </a>
    <?php
        }

        if($amount_annount > 0)
        {
    ?>
    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Announcement</a>
    <?php
        }
    ?>
</div>