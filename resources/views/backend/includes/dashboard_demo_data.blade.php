<!-- Dashboard Cards -->
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{ $totalComplaints }}</div>
                <div>Total Complaints</div>
                <div class="progress progress-thin my-2">
                    <?php $progress = ($totalComplaints > 0) ? (25) : (0); ?>
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- <small class="text-medium-emphasis">Widget helper text</small> -->
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{ $pendingComplaints }}</div>
                <div>Pending Complaints</div>
                <div class="progress progress-thin my-2">
                    <?php $progress = ($totalComplaints > 0) ? (25) : (0); ?>
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- <small class="text-medium-emphasis">Widget helper text</small> -->
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{ $resolvedComplaints }}</div>
                <div>Resolved Complaints</div>
                <div class="progress progress-thin my-2">
                    <?php $progress = ($totalComplaints > 0) ? (25) : (0); ?>
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- <small class="text-medium-emphasis">Widget helper text</small> -->
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{ $closedComplaints }}</div>
                <div>Closed Complaints</div>
                <div class="progress progress-thin my-2">
                    <?php $progress = ($totalComplaints > 0) ? (25) : (0); ?>
                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- <small class="text-medium-emphasis">Widget helper text</small> -->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{ $totalResidents }}</div>
                <div>Total Residents</div>
                <div class="progress progress-white progress-thin my-2">
                    <?php $progress = ($totalResidents > 0) ? (25) : (0); ?>
                    <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- <small class="text-medium-emphasis-inverse">Widget helper text</small> -->
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{ $freeParkings }}</div>
                <div>Free Parkings</div>
                <div class="progress progress-white progress-thin my-2">
                    <?php $progress = ($freeParkings > 0) ? (25) : (0); ?>
                    <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- <small class="text-medium-emphasis-inverse">Widget helper text</small> -->
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{ $pendingInvoices }}</div>
                <div>Pending Invoices</div>
                <div class="progress progress-white progress-thin my-2">
                    <?php $progress = ($pendingInvoices > 0) ? (25) : (0); ?>
                    <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- <small class="text-medium-emphasis-inverse">Widget helper text</small> -->
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{ $overdueInvoices }}</div>
                <div>Overdue Invoices</div>
                <div class="progress progress-white progress-thin my-2">
                    <?php $progress = ($overdueInvoices > 0) ? (25) : (0); ?>
                    <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- <small class="text-medium-emphasis-inverse">Widget helper text</small> -->
            </div>
        </div>
    </div>
</div>

<!-- <div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div class="align-self-center">
                <h4 class="card-title mb-0">Notice Board</h4>
            </div>
            <div class="btn-toolbar d-block text-end" role="toolbar" aria-label="Toolbar with buttons">
                <button class="btn btn-outline-primary mb-1" type="button" data-toggle="tooltip" data-coreui-placement="top" aria-label="Tooltip" data-coreui-original-title="Tooltip">
                    <i class="fa-solid fa-bullhorn"></i>
                </button>
            </div>
        </div>
        <hr>
        <!-- Dashboard Content Area -->
        <!-- / Dashboard Content Area -->
    <!-- </div> -->
<!-- </div>  -->
