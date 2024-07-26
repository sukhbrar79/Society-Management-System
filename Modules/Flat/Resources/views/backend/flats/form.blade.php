<div class="row">
    <!-- Name Field -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'name';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = 'required';
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
        </div>
    </div>

    

    <!-- Status Field -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'status';
            $field_label = label_case($field_name);
            $field_placeholder = '-- Select an option --';
            $required = 'required';
            $select_options = [
                '1' => 'Published',
                '0' => 'Unpublished',
                '2' => 'Draft'
            ];
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control select2')->attributes([$required]) }}
        </div>
    </div>

    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'block_id';
            $field_label = label_case($field_name);
            $required = '';
            
            // Fetch blocks data
            $blocks = \Modules\Block\Models\Block::pluck('name', 'id')->prepend('Please select', '');
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->select($field_name, $blocks)->class('form-control select2')->attributes([$required]) }}
        </div>
    </div>
</div>



<div class="row">
   

    <!-- Floor Field -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'floor';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = 'required';
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->number($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
        </div>
    </div>

    <!-- Rooms Field -->
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'rooms';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = 'required';
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->number($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
        </div>
    </div>
</div>
<div class="row">
    <!-- Description Field -->
    <div class="col-12 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'description';
            $field_label = label_case($field_name);
            $field_placeholder = $field_label;
            $required = '';
            ?>
            {{ html()->label($field_label, $field_name)->class('form-label') }} {!! field_required($required) !!}
            {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes([$required]) }}
        </div>
    </div>
</div>
<!-- Include Select2 Script -->
<x-library.select2 />
