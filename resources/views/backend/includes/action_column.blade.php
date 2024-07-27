<div class="text-end">
    @can('edit_'.$module_name)
    <x-backend.buttons.edit route='{!!route("backend.$module_name.edit", $data)!!}' title="{{__('Edit')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
    @endcan
    @can('delete_'.$module_name)
    <x-backend.buttons.delete route='{!!route("backend.$module_name.destroy", $data)!!}' title="{{__('Delete')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
    @endcan
    <!-- <x-backend.buttons.show route='{!!route("backend.$module_name.show", $data)!!}' title="{{__('Show')}} {{ ucwords(Str::singular($module_name)) }}" small="true" /> -->
</div>
