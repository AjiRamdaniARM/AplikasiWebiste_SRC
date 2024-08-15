<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchableTable extends Component
{
    public $search = ''; // Pastikan ada nilai default
    public $race_id;

    protected $queryString = ['search'];

    public function render()
    {
        $query = DB::table('participants')
            ->join('invoices', 'participants.invoice_id', '=', 'invoices.id')
            ->join('users', 'invoices.user_id', '=', 'users.id')
            ->where('participants.race_id', $this->race_id)
            ->select('users.community', 'participants.name as peserta', 'users.address as maps');

        if ($this->search) {
            $query->where('participants.name', 'like', '%' . $this->search . '%');
        }

        $data = $query->paginate(10);

        return view('livewire.searchable-table', ['data' => $data]);
    }
}
