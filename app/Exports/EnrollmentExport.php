<?php

namespace App\Exports;

use App\Models\Enrollment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class EnrollmentExport implements FromView, WithDrawings, WithEvents
{
    public function __construct(
        public Enrollment $enrollment
    ) {
        $this->enrollment->load(['farmParcels.items']);
    }

    public function view(): View
    {
        return view('admin.enrollments.excel', [
            'enrollment' => $this->enrollment,
        ]);
    }

    /**
     * @return Drawing|Drawing[]
     */
    public function drawings()
    {
        $drawings = [];

        $logoPath = storage_path('app/public/images/da-logo.png');
        if (! file_exists($logoPath)) {
            $logoPath = public_path('storage/images/da-logo.png');
        }
        if (file_exists($logoPath)) {
            $logo = new Drawing;
            $logo->setName('DA Logo');
            $logo->setPath($logoPath);
            $logo->setHeight(80);
            $logo->setCoordinates('A1');
            $drawings[] = $logo;
        }

        if ($this->enrollment->photo_path) {
            $photoPath = storage_path('app/public/'.$this->enrollment->photo_path);
            if (file_exists($photoPath)) {
                $photo = new Drawing;
                $photo->setName('Enrollee Photo');
                $photo->setPath($photoPath);
                $photo->setHeight(120);
                $photo->setCoordinates('G1');
                $drawings[] = $photo;
            }
        }

        return $drawings;
    }

    /**
     * @return array<string, callable>
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_FOLIO); // 8.5" x 13"
                $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_PORTRAIT);
                $sheet->getPageSetup()->setFitToPage(true);
                $sheet->getPageSetup()->setFitToWidth(1);
                $sheet->getPageSetup()->setFitToHeight(0);
            },
        ];
    }
}
