<?php

namespace App\Exports;

use App\Models\PettyCash;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PettyCashExport implements FromCollection, WithHeadings, WithMapping
{
    protected $statement_id;
    public function __construct($statement_id)
    {
        $this->statement_id = $statement_id;
    }
    // Define the collection of data
    public function collection()
    {
        return PettyCash::where('statement_id',$this->statement_id)->get();
    }

    // Define headings for the export file
    public function headings(): array
    {
        return [
            'Name',
            'Amount',
           
            'Department',
            'Building',
            'Invoice',
            'Date'
        ];
    }

    // Map each row of the collection to a specific format
    public function map($PettyCash): array
    {
        return [
            $PettyCash->name,
            $PettyCash->amount,
            $PettyCash->department->name,
            $PettyCash->building->name,
            $PettyCash->invoice ? $this->getImageUrl($PettyCash->invoice) : null,
            $PettyCash->created_at,
        ];
    }

    // Generate the URL for the contract file
    private function getImageUrl($filePath)
    {
        // Ensure the URL is correct for public access
        return asset('storage/' . $filePath);
    }

    // Custom method to add images to the worksheet
    public function sheet(Spreadsheet $spreadsheet, Worksheet $sheet)
    {
        $data = $this->collection();
        $row = 2;

        foreach ($data as $license) {
            $sheet->setCellValue('A' . $row, $license->building->name);
            $sheet->setCellValue('B' . $row, $license->start_date);
            $sheet->setCellValue('C' . $row, $license->end_date);

            $filePath = storage_path('app/public/' . $license->contract_file);
            if (file_exists($filePath)) {
                $drawing = new Drawing();
                $drawing->setName('Contract File');
                $drawing->setDescription('Contract File');
                $drawing->setPath($filePath);
                $drawing->setHeight(100); // Adjust the height as needed
                $drawing->setCoordinates('D' . $row);
                $drawing->setWorksheet($sheet);
            }

            $row++;
        }
    }
}
