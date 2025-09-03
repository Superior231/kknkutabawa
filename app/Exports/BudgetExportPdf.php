<?php

namespace App\Exports;

use App\Models\budget;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Mpdf\Mpdf;

class BudgetExportPdf implements FromView
{
    public function view(): View
    {
        $budgets = Budget::where('price_out', '>', 0)->orderBy('name', 'asc')->get();
        $budgets_in = Budget::where('price_in', '>', 0)->orderBy('name', 'asc')->get();
        $sum_budget = $budgets->sum(function ($budget) {
            return $budget->price_out * $budget->quantity;
        });
        $sum_budget_in = $budgets_in->sum('price_in');
        $saldo = $sum_budget_in - $sum_budget;

        return view('exports.budgetPdf', [
            'budgets' => $budgets,
            'sum_budget' => $sum_budget,
            'budgets_in' => $budgets_in,
            'sum_budget_in' => $sum_budget_in,
            'saldo' => $saldo
        ]);
    }

    public function exportPdf()
    {
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($this->view()->render());
        $mpdf->Output('Anggaran KKN Kutabawa 2025.pdf', 'I');
    }
}
