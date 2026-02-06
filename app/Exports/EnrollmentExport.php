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
    private ?string $croppedPhotoPath = null;

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
                $croppedPath = $this->cropImageToSquare($photoPath);
                if ($croppedPath) {
                    $this->croppedPhotoPath = $croppedPath;
                    $photo = new Drawing;
                    $photo->setName('Enrollee Photo');
                    $photo->setPath($croppedPath);
                    $photo->setHeight(120);
                    $photo->setWidth(120);
                    $photo->setCoordinates('G1');
                    $photo->setOffsetX(15);
                    $photo->setOffsetY(10);
                    $drawings[] = $photo;
                }
            }
        }

        return $drawings;
    }

    /**
     * Crop an image to 1:1 aspect ratio (center crop).
     *
     * @return string|null Path to cropped temp file, or null on failure
     */
    private function cropImageToSquare(string $path): ?string
    {
        $imageInfo = @getimagesize($path);
        if (! $imageInfo) {
            return null;
        }

        $width = $imageInfo[0];
        $height = $imageInfo[1];
        $type = $imageInfo[2];

        $source = match ($type) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($path),
            IMAGETYPE_PNG => @imagecreatefrompng($path),
            IMAGETYPE_GIF => @imagecreatefromgif($path),
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : null,
            default => null,
        };

        if (! $source) {
            return null;
        }

        $size = min($width, $height);
        $x = (int) (($width - $size) / 2);
        $y = (int) (($height - $size) / 2);

        $cropped = imagecrop($source, ['x' => $x, 'y' => $y, 'width' => $size, 'height' => $size]);
        imagedestroy($source);

        if (! $cropped) {
            return null;
        }

        $tempPath = tempnam(sys_get_temp_dir(), 'enrollment_photo_').'.png';
        if (! imagepng($cropped, $tempPath)) {
            imagedestroy($cropped);

            return null;
        }
        imagedestroy($cropped);

        return $tempPath;
    }

    /**
     * @return array<string, callable>
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_LETTER);
                $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_PORTRAIT);
                $sheet->getPageSetup()->setFitToPage(true);
                $sheet->getPageSetup()->setFitToWidth(1);
                $sheet->getPageSetup()->setFitToHeight(0);

                $sheet->getColumnDimension('A')->setWidth(10);
                $sheet->getColumnDimension('B')->setWidth(12);
                $sheet->getColumnDimension('C')->setWidth(10);
                $sheet->getColumnDimension('D')->setWidth(12);
                $sheet->getColumnDimension('E')->setWidth(10);
                $sheet->getColumnDimension('F')->setWidth(12);
                $sheet->getColumnDimension('G')->setWidth(14);

                $highestRow = $sheet->getHighestRow();
                $sheet->getStyle("B2:F{$highestRow}")->getAlignment()->setWrapText(true);
            },
        ];
    }

    public function __destruct()
    {
        if ($this->croppedPhotoPath && file_exists($this->croppedPhotoPath)) {
            @unlink($this->croppedPhotoPath);
        }
    }
}
