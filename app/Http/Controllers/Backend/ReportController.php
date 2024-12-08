<?php

namespace App\Http\Controllers\Backend;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function donationVerification()
    {
        $PermissionRole = PermissionRole::getPermission('Blog & Article', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        $data['PermissionAdd'] = PermissionRole::getPermission('Add Blog', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRole::getPermission('Edit Blog', Auth::user()->role_id);
        $data['PermissionShow'] = PermissionRole::getPermission('View Blog', Auth::user()->role_id);

        if (request()->ajax()) {
            $start_date = request('start_date');
            $end_date = request('end_date');

            // Query utama untuk data donasi
            $donations = Donation::query()->where('status', 'pending');

            if ($start_date && $end_date) {
                // Gunakan fungsi DATE untuk mencocokkan hanya bagian tanggal
                $donations = $donations->whereBetween(DB::raw('DATE(created_at)'), [$start_date, $end_date]);
            }

            return DataTables::of($donations)
                ->addIndexColumn()
                ->addColumn('type_donation', function ($donations) {
                    return $donations->amount == null
                        ? '<span class="badge badge-success">Amount</span>'
                        : '<span class="badge badge-primary">Item</span>';
                })
                ->addColumn('proof', function ($donations) {
                    return $donations->receipt->cloudinary_url ?? ''; // Asumsikan kolom `proof_url` menyimpan URL gambar
                })
                ->addColumn('confirmation', function ($donations) {
                    return ''; // Placeholder untuk kolom konfirmasi
                })
                ->rawColumns(['type_donation'])
                ->make(true);
        }

        return view('backend.reports.donations_verification', [
            'page_title' => 'Laporan Verifikasi Donasi',
            'data' => $data
        ]);
    }

    public function confirmDonation($id, Request $request)
    {
        $donation = Donation::findOrFail($id);

        $donation->status = $request->status === 'confirmed' ? 'approved' : 'rejected';
        $donation->save();

        return response()->json(['message' => 'Donasi telah diperbarui!']);
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
