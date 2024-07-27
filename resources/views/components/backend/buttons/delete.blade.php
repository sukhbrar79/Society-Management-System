@props(['route' => '', 'icon' => 'fas fa-pencil', 'title', 'small' => '', 'class' => ''])

<a class="btn btn-danger {{ $small == 'true' ? 'btn-sm' : '' }} {{ $class }} m-1"
   data-method="DELETE"
   data-token="{{ csrf_token() }}"
   data-toggle="tooltip"
   data-confirm="Are you sure?"
   href="{{ $route }}"
   title="{{ $title }}">
    <i class="fas fa-trash-alt fa-fw"></i>
    {!! ($slot != "") ? '&nbsp;' . $slot : '' !!}
</a>