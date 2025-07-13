<?php

namespace App\Exports;

use App\Models\presensiPKLModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PresensiPKLExport implements FromView
{
    public function view(): View
    {
        return view('admin.pkl.pklExport', [
            'presensiPKLModel' => presensiPKLModel::all()
        ]);
    }
}
