<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParticipantExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping
{
    use Exportable;

    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return Participant::query()
            ->with([
                'invoice',
            ])
            ->where('race_id', $this->id);
    }

    public function headings(): array
    {
        return [
            'Invoice ID',
            'Name',
        ];
    }

    public function map($participant): array
    {

        return [
            $participant->invoice->name,
            $participant->name,
        ];
    }
}
