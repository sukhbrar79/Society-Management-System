<?php
$flats = \Modules\Flat\Models\Flat::pluck('name', 'id')->toArray();
$blocks = \Modules\Block\Models\Block::pluck('name', 'id')->toArray();
$users = \App\Models\User::whereHas('roles', function($query) {
    $query->where('name', 'resident');
})->pluck('name', 'id')->toArray();

$assigned_to_users = \App\Models\User::whereHas('roles', function($query) {
    $query->where('name', 'service-staff');
})->pluck('name', 'id')->toArray();

?>

<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'user_id';
            $field_label = label_case($field_name);
            $field_placeholder = "-- Select a user --";
            $required = "required";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $users)->placeholder($field_placeholder)->class('form-control select2')->attributes([$required]) }}
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
            {{ html()->select($field_name, $blocks)->placeholder($field_placeholder)->class('form-control select2')->attributes([$required]) }}
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
            {{ html()->select($field_name, $flats)->placeholder($field_placeholder)->class('form-control select2')->attributes([$required]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'subject';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
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
                'pending' => 'Pending',
                'in_progress' => 'In Progress',
                'resolved' => 'Resolved',
                'closed' => 'Closed',
            ];
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes([$required]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'priority';
            $field_label = label_case($field_name);
            $field_placeholder = "-- Select a priority --";
            $required = "required";
            $select_options = [
                'low' => 'Low',
                'medium' => 'Medium',
                'high' => 'High',
            ];
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes([$required]) }}
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'assigned_to';
            $field_label = label_case($field_name);
            $field_placeholder = "-- Select a user to assign --";
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $assigned_to_users)->placeholder($field_placeholder)->class('form-control select2')->attributes([$required]) }}
        </div>
    </div>
    <div class="col-8 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'description';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = "";
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
        </div>
    </div>
</div>

<x-library.select2 />
