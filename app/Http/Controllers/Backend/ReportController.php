<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function donationVerification()
    {
        // Logika untuk laporan verifikasi transfer dana donasi
        return view('admin.reports.donations_verification');
    }

    public function donations()
    {
        // Logika untuk laporan donasi yang masuk
        return view('admin.reports.donations');
    }

    public function exportDonations($format)
    {
        // Logika untuk export laporan donasi ke PDF atau Excel
        if ($format == 'pdf') {
            // Generate PDF
        } elseif ($format == 'excel') {
            // Generate Excel
        }
        return redirect()->back()->with('message', 'Laporan berhasil diexport.');
    }

    public function eventParticipants()
    {
        // Logika untuk laporan peserta/volunteer event
        return view('admin.reports.event_participants');
    }
}
