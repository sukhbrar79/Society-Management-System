<?php
// Fetch data for select options
$parkings = \Modules\Parking\Models\Parking::pluck('spot_number', 'id')->toArray();
$residents = \App\Models\User::whereHas('roles', function($query) {
    $query->where('name', 'resident');
})->pluck('name', 'id')->toArray();
$blocks = \Modules\Block\Models\Block::pluck('name', 'id')->toArray();
?>

<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'parking_id';
            $field_label = label_case($field_name);
            $field_placeholder = "-- Select a parking spot --";
            $required = "required";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $parkings)->placeholder($field_placeholder)->class('form-control select2')->attributes([$required]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'resident_id';
            $field_label = label_case($field_name);
            $field_placeholder = "-- Select a resident --";
            $required = "required";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $residents)->placeholder($field_placeholder)->class('form-control select2')->attributes([$required]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'block_id';
            $field_label = label_case($field_name);
            $field_placeholder = "-- Select a block --";
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $blocks)->placeholder($field_placeholder)->class('form-control select2')->attributes([$required, 'id' => 'block_id']) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'flat_id';
            $field_label = label_case($field_name);
            $field_placeholder = "-- Select a flat --";
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, [])->placeholder($field_placeholder)->class('form-control select2')->attributes([$required, 'id' => 'flat_id']) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'allocation_date';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'expiration_date';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->date($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'status';
            $field_label = label_case($field_name);
            $field_placeholder = "-- Select a status --";
            $required = "required";
            $select_options = [
                'Expired' => 'Expired',
                'Active' => 'Active',
                'Upcoming' => 'Upcoming',
                'Pending' => 'Pending',
                'Approved' => 'Approved',
                'Rejected' => 'Rejected'
            ];
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes([$required]) }}
        </div>
    </div>
</div>

<x-library.select2 />


