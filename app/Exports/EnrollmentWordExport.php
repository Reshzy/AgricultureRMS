<?php

namespace App\Exports;

use App\Models\Enrollment;
use PhpOffice\PhpWord\Element\Cell;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class EnrollmentWordExport
{
    private const SECTION_HEADER_BG = '1a5f3f';

    private const SECTION_HEADER_FONT = ['color' => 'FFFFFF', 'bold' => true];

    private ?string $croppedPhotoPath = null;

    public function __construct(
        public Enrollment $enrollment
    ) {
        $this->enrollment->load(['farmParcels.items']);
    }

    public function build(): PhpWord
    {
        $phpWord = new PhpWord;
        $section = $phpWord->addSection();

        $table = $section->addTable(['borderSize' => 1, 'borderColor' => '000000']);

        $this->addHeaderRow($table);
        $this->addPersonalInfo($table);
        $this->addAddressContact($table);
        $this->addPersonalDetails($table);
        $this->addHouseholdInfo($table);
        $this->addEmergencyContact($table);
        $this->addLivelihoodFarmProfile($table);
        $this->addFarmParcels($table);
        $this->addFooterRow($table);

        return $phpWord;
    }

    public function saveToTemp(): string
    {
        $tempPath = tempnam(sys_get_temp_dir(), 'enrollment_word_').'.docx';
        $writer = IOFactory::createWriter($this->build(), 'Word2007');
        $writer->save($tempPath);

        return $tempPath;
    }

    public function __destruct()
    {
        if ($this->croppedPhotoPath && file_exists($this->croppedPhotoPath)) {
            @unlink($this->croppedPhotoPath);
        }
    }

    private function addHeaderRow(\PhpOffice\PhpWord\Element\Table $table): void
    {
        $logoPath = storage_path('app/public/images/da-logo.png');
        if (! file_exists($logoPath)) {
            $logoPath = public_path('storage/images/da-logo.png');
        }

        $table->addRow(400);
        $logoCell = $table->addCell(2000, ['gridSpan' => 2, 'vMerge' => 'restart', 'valign' => 'top']);
        if (file_exists($logoPath)) {
            $logoCell->addImage($logoPath, ['width' => 80, 'height' => 80]);
        }

        $titleCell = $table->addCell(4000, ['gridSpan' => 4, 'bgColor' => 'f8f9fa', 'valign' => 'center']);
        $titleCell->addText('Republic of the Philippines', self::SECTION_HEADER_FONT, ['size' => 9]);
        $titleCell->addText('Registry System for Basic Sectors in Agriculture', self::SECTION_HEADER_FONT, ['size' => 12]);
        $titleCell->addText('Department of Agriculture - Claveria, Cagayan', ['size' => 9]);

        $photoCell = $table->addCell(2000, ['vMerge' => 'restart', 'valign' => 'top', 'align' => 'center']);
        if ($this->enrollment->photo_path) {
            $photoPath = storage_path('app/public/'.$this->enrollment->photo_path);
            if (file_exists($photoPath)) {
                $croppedPath = $this->cropImageToSquare($photoPath);
                if ($croppedPath) {
                    $this->croppedPhotoPath = $croppedPath;
                    $photoCell->addImage($croppedPath, ['width' => 120, 'height' => 120]);
                }
            }
        }

        $table->addRow(100);
        $table->addCell(null, ['vMerge' => 'continue']);
        $table->addCell(4000, ['gridSpan' => 4, 'bgColor' => 'f8f9fa']);
        $table->addCell(null, ['vMerge' => 'continue']);

        $table->addRow(100);
        $table->addCell(null, ['vMerge' => 'continue']);
        $table->addCell(4000, ['gridSpan' => 4, 'bgColor' => 'f8f9fa']);
        $table->addCell(null, ['vMerge' => 'continue']);

        $table->addRow(200);
        $formCell = $table->addCell(5000, ['gridSpan' => 5]);
        $formCell->addText('Farmer/Fisherfolk Enrollment Form', ['italic' => true, 'size' => 8, 'color' => '666666']);

        $rsbsaCellStyle = ['gridSpan' => 2, 'align' => 'right'];
        if ($this->enrollment->rsbsa_reference_number) {
            $rsbsaCellStyle['bgColor'] = '1a5f3f';
        }
        $rsbsaCell = $table->addCell(2000, $rsbsaCellStyle);
        if ($this->enrollment->rsbsa_reference_number) {
            $rsbsaCell->addText('RSBSA No: '.$this->enrollment->rsbsa_reference_number, ['bold' => true, 'color' => 'FFFFFF']);
        }
    }

    private function addSectionHeader(\PhpOffice\PhpWord\Element\Table $table, string $title): void
    {
        $table->addRow(250);
        $cell = $table->addCell(10000, ['gridSpan' => 7, 'bgColor' => self::SECTION_HEADER_BG]);
        $cell->addText($title, self::SECTION_HEADER_FONT);
    }

    private function addPersonalInfo(\PhpOffice\PhpWord\Element\Table $table): void
    {
        $this->addSectionHeader($table, 'I. Personal Information');

        $table->addRow();
        $this->addLabelCell($table, 'Full Name:');
        $table->addCell(8000, ['gridSpan' => 6])->addText($this->formatName());

        $table->addRow();
        $this->addLabelCell($table, 'Sex:');
        $table->addCell(1500)->addText(ucfirst($this->enrollment->sex));
        $this->addLabelCell($table, 'Date of Birth:');
        $table->addCell(1500)->addText($this->enrollment->date_of_birth?->format('F d, Y') ?? 'N/A');
        $this->addLabelCell($table, 'Place of Birth:');
        $table->addCell(2000, ['gridSpan' => 2])->addText($this->enrollment->place_of_birth ?? 'N/A');
    }

    private function addAddressContact(\PhpOffice\PhpWord\Element\Table $table): void
    {
        $this->addSectionHeader($table, 'II. Address & Contact Information');

        $address = trim(implode(' ', [
            $this->enrollment->address_house_lot,
            $this->enrollment->address_street,
            $this->enrollment->address_barangay,
            $this->enrollment->address_municipality_city,
            $this->enrollment->address_province,
            $this->enrollment->address_region,
        ]));

        $table->addRow();
        $this->addLabelCell($table, 'Complete Address:');
        $table->addCell(8000, ['gridSpan' => 6])->addText($address ?: 'N/A');

        $table->addRow();
        $this->addLabelCell($table, 'Mobile:');
        $table->addCell(1500)->addText($this->enrollment->mobile_number ?? 'N/A');
        $this->addLabelCell($table, 'Landline:');
        $table->addCell(5000, ['gridSpan' => 4])->addText($this->enrollment->landline_number ?? 'N/A');
    }

    private function addPersonalDetails(\PhpOffice\PhpWord\Element\Table $table): void
    {
        $this->addSectionHeader($table, 'III. Personal Details');

        $table->addRow();
        $this->addLabelCell($table, 'Education:');
        $table->addCell(1500)->addText($this->enrollment->highest_formal_education ?? 'N/A');
        $this->addLabelCell($table, 'Religion:');
        $table->addCell(1500)->addText($this->enrollment->religion ?? 'N/A');
        $this->addLabelCell($table, 'Civil Status:');
        $table->addCell(2000, ['gridSpan' => 2])->addText(ucfirst($this->enrollment->civil_status ?? 'N/A'));

        if ($this->enrollment->name_of_spouse) {
            $table->addRow();
            $this->addLabelCell($table, 'Spouse Name:');
            $table->addCell(8000, ['gridSpan' => 6])->addText($this->enrollment->name_of_spouse);
        }

        $table->addRow();
        $this->addLabelCell($table, "Mother's Maiden Name:");
        $table->addCell(8000, ['gridSpan' => 6])->addText($this->enrollment->mothers_maiden_name ?? 'N/A');
    }

    private function addHouseholdInfo(\PhpOffice\PhpWord\Element\Table $table): void
    {
        $this->addSectionHeader($table, 'IV. Household Information');

        $householdText = $this->enrollment->household_head
            ? 'YES - This person is the household head'
            : trim(($this->enrollment->household_head_name ?? 'N/A').($this->enrollment->relationship_to_head ? " ({$this->enrollment->relationship_to_head})" : ''));

        $table->addRow();
        $this->addLabelCell($table, 'Household Head:');
        $table->addCell(8000, ['gridSpan' => 6])->addText($householdText);

        $table->addRow();
        $this->addLabelCell($table, 'Total Members:');
        $table->addCell(1000)->addText((string) $this->enrollment->household_members_total);
        $this->addLabelCell($table, 'Male:');
        $table->addCell(1000)->addText((string) $this->enrollment->household_members_male);
        $this->addLabelCell($table, 'Female:');
        $table->addCell(2000, ['gridSpan' => 2])->addText((string) $this->enrollment->household_members_female);

        if ($this->enrollment->is_pwd || $this->enrollment->is_four_ps_beneficiary || $this->enrollment->is_indigenous_group_member) {
            $parts = [];
            if ($this->enrollment->is_pwd) {
                $parts[] = 'PWD';
            }
            if ($this->enrollment->is_four_ps_beneficiary) {
                $parts[] = "4P's Beneficiary";
            }
            if ($this->enrollment->is_indigenous_group_member) {
                $parts[] = $this->enrollment->indigenous_group_specify ?? '';
            }
            $table->addRow();
            $this->addLabelCell($table, 'Special Status:');
            $table->addCell(8000, ['gridSpan' => 6])->addText(implode(' ', $parts));
        }

        if ($this->enrollment->has_government_id) {
            $table->addRow();
            $this->addLabelCell($table, 'Government ID:');
            $table->addCell(8000, ['gridSpan' => 6])->addText("{$this->enrollment->government_id_type} - {$this->enrollment->government_id_number}");
        }
    }

    private function addEmergencyContact(\PhpOffice\PhpWord\Element\Table $table): void
    {
        $this->addSectionHeader($table, 'V. Emergency Contact');

        $table->addRow();
        $this->addLabelCell($table, 'Contact Person:');
        $table->addCell(4000, ['gridSpan' => 3])->addText($this->enrollment->emergency_contact_name ?? 'N/A');
        $this->addLabelCell($table, 'Contact Number:');
        $table->addCell(2000, ['gridSpan' => 2])->addText($this->enrollment->emergency_contact_number ?? 'N/A');
    }

    private function addLivelihoodFarmProfile(\PhpOffice\PhpWord\Element\Table $table): void
    {
        $this->addSectionHeader($table, 'VI. Livelihood & Farm Profile');

        $table->addRow();
        $this->addLabelCell($table, 'Main Livelihood:');
        $table->addCell(8000, ['gridSpan' => 6])->addText(str_replace('_', ' ', $this->enrollment->main_livelihood));

        if ($this->enrollment->main_livelihood === 'farmer' && $this->enrollment->farming_activities && count($this->enrollment->farming_activities) > 0) {
            $table->addRow();
            $this->addLabelCell($table, 'Farming Activities:');
            $table->addCell(8000, ['gridSpan' => 6])->addText(implode(', ', array_map('ucfirst', $this->enrollment->farming_activities)));
        }

        if ($this->enrollment->other_crop_specify) {
            $table->addRow();
            $this->addLabelCell($table, 'Other Crops:');
            $table->addCell(8000, ['gridSpan' => 6])->addText($this->enrollment->other_crop_specify);
        }

        if ($this->enrollment->livestock_type_specify) {
            $table->addRow();
            $this->addLabelCell($table, 'Livestock Types:');
            $table->addCell(8000, ['gridSpan' => 6])->addText($this->enrollment->livestock_type_specify);
        }

        if ($this->enrollment->poultry_type_specify) {
            $table->addRow();
            $this->addLabelCell($table, 'Poultry Types:');
            $table->addCell(8000, ['gridSpan' => 6])->addText($this->enrollment->poultry_type_specify);
        }

        $table->addRow();
        $table->addCell(2000, ['gridSpan' => 2, 'bgColor' => 'f8f9fa'])->addText('Farming Income', ['bold' => true]);
        $table->addCell(2000, ['gridSpan' => 2])->addText('₱'.number_format($this->enrollment->gross_income_farming ?? 0, 2), ['bold' => true, 'color' => self::SECTION_HEADER_BG]);
        $table->addCell(2000, ['bgColor' => 'f8f9fa'])->addText('Non-Farming Income', ['bold' => true]);
        $table->addCell(2000, ['gridSpan' => 2])->addText('₱'.number_format($this->enrollment->gross_income_non_farming ?? 0, 2), ['bold' => true, 'color' => self::SECTION_HEADER_BG]);
    }

    private function addFarmParcels(\PhpOffice\PhpWord\Element\Table $table): void
    {
        if (! $this->enrollment->farmParcels || $this->enrollment->farmParcels->count() === 0) {
            return;
        }

        $count = $this->enrollment->farmParcels->count();
        $this->addSectionHeader($table, "VII. Farm Parcels ({$count} Total)");

        foreach ($this->enrollment->farmParcels as $i => $parcel) {
            $table->addRow();
            $cell = $table->addCell(10000, ['gridSpan' => 7, 'bgColor' => 'f5f5f5']);
            $cell->addText('Parcel #'.($i + 1).": {$parcel->barangay}, {$parcel->municipality}", ['bold' => true, 'color' => self::SECTION_HEADER_BG]);

            $table->addRow();
            $this->addLabelCell($table, 'Total Farm Area:');
            $table->addCell(1500)->addText("{$parcel->total_farm_area_ha} hectares");
            $this->addLabelCell($table, 'Ownership:');
            $table->addCell(1500)->addText(ucfirst(str_replace('_', ' ', $parcel->ownership_type ?? 'N/A')));
            if ($parcel->ownership_document_no) {
                $this->addLabelCell($table, 'Document No:');
                $table->addCell(2000, ['gridSpan' => 2])->addText($parcel->ownership_document_no);
            } else {
                $table->addCell(2000, ['gridSpan' => 2]);
            }

            if ($parcel->items && $parcel->items->count() > 0) {
                foreach ($parcel->items as $item) {
                    $parts = ['('.ucfirst($item->kind).')'];
                    if ($item->size_ha) {
                        $parts[] = "{$item->size_ha} ha";
                    }
                    if ($item->num_of_head && $item->kind !== 'crop') {
                        $parts[] = "{$item->num_of_head} heads";
                    }
                    if ($item->farm_type) {
                        $parts[] = $item->farm_type;
                    }
                    if ($item->is_organic_practitioner) {
                        $parts[] = 'Organic Practitioner';
                    }
                    if ($item->remarks) {
                        $parts[] = '- '.$item->remarks;
                    }
                    $table->addRow();
                    $this->addLabelCell($table, $item->name, '1a5f3f');
                    $table->addCell(8000, ['gridSpan' => 6])->addText(implode(' ', $parts));
                }
            }
        }
    }

    private function addFooterRow(\PhpOffice\PhpWord\Element\Table $table): void
    {
        $table->addRow();
        $cell = $table->addCell(10000, ['gridSpan' => 7, 'align' => 'center']);
        $cell->addText('Department of Agriculture - Claveria, Cagayan', ['bold' => true, 'color' => self::SECTION_HEADER_BG]);
        $cell->addText('Registry System for Basic Sectors in Agriculture (RSBSA)');
        $cell->addText('Document generated on '.now()->format('F d, Y').' at '.now()->format('g:i A'), ['size' => 8, 'color' => '666666']);
    }

    private function addLabelCell(\PhpOffice\PhpWord\Element\Table $table, string $label, string $color = '000000'): Cell
    {
        $cell = $table->addCell(2000);
        $cell->addText($label, ['bold' => true, 'color' => $color]);

        return $cell;
    }

    private function formatName(): string
    {
        $parts = array_filter([
            $this->enrollment->surname.',',
            $this->enrollment->first_name,
            $this->enrollment->middle_name,
            $this->enrollment->extension_name,
        ]);

        return implode(' ', $parts);
    }

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
}
