<?php

namespace App\Http\Controllers\Backend;

use App\Models\Donation;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;
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

        if (request()->ajax()) {

            // Query utama untuk data donasi
            $donations = Donation::latest()->where('status', 'pending')->get();

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
                ->rawColumns(['type_donation', 'proof', 'confirmation'])
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

    public function exportData($type, $format)
    {
        $start_date = request('start_date');
        $end_date = request('end_date');

        $title = $type === 'donations' ? 'Donations Report' : 'Participants Report';
        $range = ($start_date && $end_date)
            ? date('d F Y', strtotime($start_date)) . ' - ' . date('d F Y', strtotime($end_date))
            : 'All Time';

        $data = $type === 'donations'
            ? Donation::query()
            ->where('status', 'approved')
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                // Hanya tambahkan filter tanggal jika $start_date dan $end_date tidak kosong
                $query->whereBetween(DB::raw('DATE(created_at)'), [$start_date, $end_date]);
            })     
            ->get()
            ->map(function ($donation) {
                return [
                    'name' => $donation->name,
                    'email' => $donation->email,
                    'amount/description_item' => $donation->amount
                        ? 'Rp. ' . number_format($donation->amount, 0, ',', '.')
                        : $donation->description_item,
                    'type_donation' => $donation->amount == null ? 'Item' : 'Amount',
                    'created_at' => $donation->created_at->format('Y-m-d'),
                ];
            })
            : EventRegistration::query()
            ->with(['event', 'event.thumbnail', 'event.category', 'user'])
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                $query->whereBetween(DB::raw('DATE(created_at)'), [$start_date, $end_date]);
            })    
            ->get()
            ->map(function ($participant) {
                return [
                    'name' => $participant->user->name,
                    'email' => $participant->user->email,
                    'event' => $participant->event->title,
                    'status' => $participant->status,
                    'created_at' => $participant->created_at->format('Y-m-d'),
                ];
            });

        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'No data available for export.');
        }

        if ($format === 'pdf') {
            $pdf = PDF::loadView('backend.reports.pdf', compact('data', 'title', 'range'));
            return $pdf->download("{$type}-report.pdf");
        } elseif ($format === 'csv') {
            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename={$type}-report.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ];

            $columns = $type === 'donations'
                ? ['Name', 'Email', 'Amount/Description Items', 'Type Donation', 'Date']
                : ['Name', 'Email', 'Event', 'Status', 'Date'];

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($data as $row) {
                    fputcsv($file, array_values($row));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        return redirect()->back()->with('message', 'Report exported successfully.');
    }


    public function eventParticipants()
    {
        $PermissionRole = PermissionRole::getPermission('Report Events', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

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
