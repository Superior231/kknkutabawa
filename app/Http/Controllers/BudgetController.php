<?php

namespace App\Http\Controllers;

use App\Exports\BudgetExportExcel;
use App\Models\budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BudgetExportPdf;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = budget::orderBy('date', 'asc')->get();
        $total_pemasukan = Budget::sum('price_in');
        $total_pengeluaran = Budget::get()->sum(function($budget) {
            return $budget->price_out * $budget->quantity;
        });
        $sisa_anggaran = $total_pemasukan - $total_pengeluaran;

        return view('pages.budget.index', [
            'title' => 'Anggaran - KKN Desa Kutabawa',
            'navTitle' => 'Anggaran',
            'active' => 'budget',
            'budgets' => $budgets,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'sisa_anggaran' => $sisa_anggaran
        ]);
    }

    public function create()
    {
        if (!(Auth::user()->roles == 'admin' || in_array('Bendahara', explode(', ', Auth::user()->jobs)))) {
            return redirect()->route('budget.index')->with('error', 'Oops... Terjadi kesalahan!');
        }

        $types = collect([
            (object)['name' => 'Sekertaris'],
            (object)['name' => 'Perlengkapan'],
            (object)['name' => 'PDD'],
            (object)['name' => 'Konsumsi'],
            (object)['name' => 'Transportasi'],
            (object)['name' => 'Pilar Ekonomi'],
            (object)['name' => 'Pilar Jati Diri'],
            (object)['name' => 'Pilar Kesehatan'],
            (object)['name' => 'Pilar Lingkungan'],
            (object)['name' => 'Pilar Pendidikan'],
            (object)['name' => 'Lain-lain'],
        ]);

        return view('pages.budget.create', [
            'title' => 'Tambah Pengeluaran - KKN Desa Kutabawa',
            'navTitle' => 'Tambah Pengeluaran',
            'active' => 'budget',
            'types' => $types
        ]);
    }

    public function create_budget_in()
    {
        if (!(Auth::user()->roles == 'admin' || in_array('Bendahara', explode(', ', Auth::user()->jobs)))) {
            return redirect()->route('budget.index')->with('error', 'Oops... Terjadi kesalahan!');
        }

        return view('pages.budget.create-budget-in', [
            'title' => 'Tambah Pemasukan - KKN Desa Kutabawa',
            'navTitle' => 'Tambah Pemasukan',
            'active' => 'budget'
        ]);
    }

    public function store(Request $request)
    {
        if (!(Auth::user()->roles == 'admin' || in_array('Bendahara', explode(', ', Auth::user()->jobs)))) {
            return redirect()->route('budget.index')->with('error', 'Oops... Terjadi kesalahan!');
        }

        $request->validate([
            'name' => 'required',
            'date' => 'required',
        ], [
            'name.required' => 'Nama harus diisi!',
            'date.required' => 'Tanggal harus diisi!',
        ]);

        $data = $request->all();
        $data['price_in'] = $request->filled('price_in') ? str_replace('.', '', $request->price_in) : null;
        $data['price_out'] = $request->filled('price_out') ? str_replace('.', '', $request->price_out) : null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('budgets', $fileName, 'public');
            $data['image'] = $fileName;
        }        
        
        $budget = budget::create($data);

        if ($budget) {
            return redirect()->route('budget.index')->with('success', 'Biaya berhasil ditambahkan!');
        } else {
            return redirect()->route('budget.index')->with('error', 'Biaya gagal ditambahkan!');
        }
    }

    public function edit($id)
    {
        if (!(Auth::user()->roles == 'admin' || in_array('Bendahara', explode(', ', Auth::user()->jobs)))) {
            return redirect()->route('budget.index')->with('error', 'Oops... Terjadi kesalahan!');
        }

        $budget = Budget::findOrFail($id);
        $types = collect([
            (object)['name' => 'Sekertaris'],
            (object)['name' => 'Perlengkapan'],
            (object)['name' => 'PDD'],
            (object)['name' => 'Konsumsi'],
            (object)['name' => 'Transportasi'],
            (object)['name' => 'Pilar Ekonomi'],
            (object)['name' => 'Pilar Jati Diri'],
            (object)['name' => 'Pilar Kesehatan'],
            (object)['name' => 'Pilar Lingkungan'],
            (object)['name' => 'Pilar Pendidikan'],
            (object)['name' => 'Lain-lain'],
        ]);

        return view('pages.budget.edit', [
            'title' => 'Edit Pengeluaran - KKN Desa Kutabawa',
            'navTitle' => 'Edit Pengeluaran - ' . $budget->name,
            'active' => 'budget',
            'budget' => $budget,
            'types' => $types
        ]);
    }

    public function edit_budget_in($id)
    {
        if (!(Auth::user()->roles == 'admin' || in_array('Bendahara', explode(', ', Auth::user()->jobs)))) {
            return redirect()->route('budget.index')->with('error', 'Oops... Terjadi kesalahan!');
        }

        $budget = Budget::findOrFail($id);

        return view('pages.budget.edit-budget-in', [
            'title' => 'Edit Pemasukan - KKN Desa Kutabawa',
            'navTitle' => 'Edit Pemasukan - ' . $budget->name,
            'active' => 'budget',
            'budget' => $budget
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!(Auth::user()->roles == 'admin' || in_array('Bendahara', explode(', ', Auth::user()->jobs)))) {
            return redirect()->route('budget.index')->with('error', 'Oops... Terjadi kesalahan!');
        }

        $request->validate([
            'name' => 'required',
            'date' => 'required',
        ], [
            'name.required' => 'Nama harus diisi!',
            'date.required' => 'Tanggal harus diisi!',
        ]);

        $data = $request->all();
        $data['price_in'] = $request->filled('price_in') ? str_replace('.', '', $request->price_in) : null;
        $data['price_out'] = $request->filled('price_out') ? str_replace('.', '', $request->price_out) : null;

        $budget = Budget::find($id);
        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($budget->image && Storage::disk('public')->exists('budgets/' . $budget->image)) {
                Storage::disk('public')->delete('budgets/' . $budget->image);
            }
        
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('budgets', $fileName, 'public');
            $data['image'] = $fileName;
        }

        $budget->update($data);

        if ($budget) {
            return redirect()->route('budget.index')->with('success', 'Biaya berhasil diubah!');
        } else {
            return redirect()->route('budget.index')->with('error', 'Biaya gagal diubah!');
        }
    }

    public function destroy($id)
    {
        if (!(Auth::user()->roles == 'admin' || in_array('Bendahara', explode(', ', Auth::user()->jobs)))) {
            return redirect()->route('budget.index')->with('error', 'Oops... Terjadi kesalahan!');
        }

        $budget = Budget::find($id);
        if ($budget->image && Storage::disk('public')->exists('budgets/' . $budget->image)) {
            Storage::disk('public')->delete('budgets/' . $budget->image);
        }
        $budget->delete();

        if ($budget) {
            return redirect()->route('budget.index')->with('success', 'Biaya berhasil dihapus!');
        } else {
            return redirect()->route('budget.index')->with('error', 'Biaya gagal dihapus!');
        }
    }

    public function show($id)
    {
        return redirect()->route('budget.excel')->with('error', 'Halaman tidak tersedia.');
    }

    public function budget_excel()
    {
        return Excel::download(new BudgetExportExcel, 'Anggaran KKN Kutabawa 2025.xlsx');
    }

    public function budget_pdf()
    {
        $exportPdf = new BudgetExportPdf();
        $exportPdf->exportPdf();
    }
}
