<?php

namespace App\Http\Controllers\Backend;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function donationVerification()
    {
        $PermissionRole = PermissionRole::getPermission('Report Verify Donations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // $data['PermissionAdd'] = PermissionRole::getPermission('Add Blog', Auth::user()->role_id);
        // $data['PermissionEdit'] = PermissionRole::getPermission('Edit Blog', Auth::user()->role_id);
        // $data['PermissionShow'] = PermissionRole::getPermission('View Blog', Auth::user()->role_id);

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
            // 'data' => $data
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
        $PermissionRole = PermissionRole::getPermission('Report Donations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // $data['PermissionAdd'] = PermissionRole::getPermission('Add Blog', Auth::user()->role_id);
        // $data['PermissionEdit'] = PermissionRole::getPermission('Edit Blog', Auth::user()->role_id);
        // $data['PermissionShow'] = PermissionRole::getPermission('View Blog', Auth::user()->role_id);

        if (request()->ajax()) {
            $start_date = request('start_date');
            $end_date = request('end_date');

            // Query utama untuk data donasi
            $donations = Donation::query()->where('status', 'approved');

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
                ->addColumn('donation', function ($donations) {
                    return $donations->amount ? 
                        'Rp. ' . number_format($donations->amount, 0, ',', '.') : $donations->description_item;
                })
                ->rawColumns(['type_donation'])
                ->make(true);
        }

        // Logika untuk laporan donasi yang masuk
        return view('backend.reports.donations', [
            'page_title' => 'Laporan Donasi',
            // 'data' => $data
        ]);
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
        $PermissionRole = PermissionRole::getPermission('Report Events', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // $data['PermissionAdd'] = PermissionRole::getPermission('Add Blog', Auth::user()->role_id);
        // $data['PermissionEdit'] = PermissionRole::getPermission('Edit Blog', Auth::user()->role_id);
        // $data['PermissionShow'] = PermissionRole::getPermission('View Blog', Auth::user()->role_id);

        if (request()->ajax()) {
            $start_date = request('start_date');
            $end_date = request('end_date');

            // Query utama untuk data donasi
            $events = EventRegistration::query()
                ->with(['event', 'event.thumbnail', 'event.category', 'user']);

            if ($start_date && $end_date) {
                // Gunakan fungsi DATE untuk mencocokkan hanya bagian tanggal
                $events = $events->whereBetween(DB::raw('DATE(created_at)'), [$start_date, $end_date]);
            }

            return DataTables::of($events)
                ->addIndexColumn()
                ->addColumn('status', function ($events) {
                    return $events->status == 'peserta'
                        ? '<span class="badge badge-success">Participant</span>'
                        : '<span class="badge badge-primary">Volunteer</span>';
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        // Logika untuk laporan peserta/volunteer event
        return view('backend.reports.event_participants', [
            'page_title' => 'Laporan Peserta Event',
            // 'data' => $data
        ]);
    }
}
