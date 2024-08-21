<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\ProjectOnlines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class GdDrive extends Controller
{
    public function UpDrive(Request $request, $id)
    {
        $drive = ProjectOnlines::where('id_participants', $id)->first();
        $up = Participant::findOrFail($id);

        if (! $drive) {
            return redirect()->back()->with('error', 'Drive not found.');
        }

        $up->id_upload = $drive->id;

        $participants = Participant::where('participants.id', $id)
            ->join('races', 'participants.race_id', '=', 'races.id')
            ->select('participants.*', 'races.name as race_name', 'races.id as race_id', 'participants.name as namePeserta')
            ->first();
        if (! $participants) {
            return redirect()->back()->with('error', 'Participant not found.');
        }

        $drive->status = 'sudah upload';

        $image = $request->file('name_project');

        // === Membuat nama file dengan format yang diinginkan === //
        $imageName = $participants->namePeserta.'-'.$participants->race_name.'.'.$image->getClientOriginalExtension();

        // === Memindahkan file ke direktori yang diinginkan === //
        $image->move(public_path('upload'), $imageName);

        // === Simpan nama file dalam database === //
        $drive->name_project = $imageName;

        $drive->save();
        $up->save();

        return redirect('particpants/'.$participants->invoice_id)->with('success', 'File uploaded successfully.');
    }
    public function upload2(Request $request)
    {

        if (! $request->file('file')) {
            return redirect()->back()->with('error', 'Drive not found.');
        }
        $drive =  new ProjectOnlines();
        $drive->status = 'sudah upload';
        $image = $request->file('file');
        $fileProject = $request->input('name');

        $timestamp = now()->format('Ymd_His');
        // === Membuat nama file dengan format yang diinginkan === //
        $imageName = $fileProject.'_'.$timestamp.'.'.$image->getClientOriginalExtension();

        // === Memindahkan file ke direktori yang diinginkan === //
        $image->move(public_path('upload'), $imageName);

        // === Simpan nama file dalam database === //
        $drive->name_project = $imageName;
        $drive->seleksi = 2;
        $drive->id_user = Auth::user()->id;
        $drive->save();

        return response()->json($drive);
    }

    public function Upload($id)
    {
        $getData = new ProjectOnlines;
        $getData->status = 'belum upload';
        $getData->id_participants = $id;
        $getData->save();

        return redirect('particpants/upload/project/'.$id);

        // return view('dashboard.participant.upload', compact('datas'));
    }

    public function getUpload($id)
    {
        $datas = Participant::where('id', $id)
            ->with(['race.category'])
            ->first();

        return view('dashboard.participant.upload', compact('datas'));
    }
}
