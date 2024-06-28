<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Residents extends Component
{
    use WithPagination;

    public $searchTerm;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $users = User::whereHas('roles', function ($query) {
            $query->where('id',5);
        })
             ->where('name', 'like', $searchTerm)
            // ->orWhere('email', 'like', $searchTerm)
            ->orderBy('id', 'desc')
            ->with(['permissions', 'roles', 'providers'])
            ->paginate();
        return view('livewire.residents', compact('users'));
    }
}
