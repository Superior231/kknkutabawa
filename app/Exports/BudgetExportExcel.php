<?php

namespace App\Exports;

use App\Models\Budget;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BudgetExportExcel implements WithStyles, FromView, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Anggaran KKN Kutabawa 2025';
    }

    public function view(): View
    {
        $budgets = Budget::where('price_out', '>', 0)->orderBy('name', 'asc')->get();
        $budgets_in = Budget::where('price_in', '>', 0)->orderBy('name', 'asc')->get();
        $sum_budget = Budget::sum('price_out');
        $sum_budget_in = Budget::sum('price_in');
        $saldo = $sum_budget_in - $sum_budget;

        return view('exports.budgetExcel', [
            'budgets' => $budgets,
            'sum_budget' => $sum_budget,
            'budgets_in' => $budgets_in,
            'sum_budget_in' => $sum_budget_in,
            'saldo' => $saldo
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        foreach(range('A','G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }


        $sheet->getStyle('A1:G1')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '257cc4'],
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => false,
            ],
        ]);

        $sheet->getStyle('A2:A200')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => false,
            ],
        ]);

        $sheet->getStyle('D2:D200')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => false,
            ],
        ]);

        $sheet->getStyle('E2:E200')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => false,
            ],
        ]);

        $sheet->getStyle('F2:F200')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => false,
            ],
        ]);

        $sheet->getStyle('G2:G200')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => false,
            ],
        ]);
    }
}
