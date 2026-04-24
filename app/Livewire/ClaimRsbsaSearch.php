<?php

namespace App\Livewire;

use App\Models\Enrollment;
use Livewire\Component;

class ClaimRsbsaSearch extends Component
{
    public string $query = '';

    public ?int $selectedEnrollmentId = null;

    /**
     * @var array<string, mixed>|null
     */
    public ?array $selectedEnrollment = null;

    public function mount(string $initialQuery = '', ?int $selectedEnrollmentId = null): void
    {
        $this->query = $this->formatRsbsaQuery($initialQuery);
        $this->selectedEnrollmentId = $selectedEnrollmentId;

        if ($selectedEnrollmentId) {
            $this->loadSelectedEnrollment($selectedEnrollmentId);
        }
    }

    public function selectEnrollment(int $enrollmentId): void
    {
        $this->loadSelectedEnrollment($enrollmentId);

        if (! $this->selectedEnrollment) {
            return;
        }

        $this->dispatch('claim-enrollment-selected', enrollment: $this->selectedEnrollment);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getResultsProperty(): array
    {
        $search = trim($this->query);
        $digitsOnly = preg_replace('/\D/', '', $search) ?? '';

        if (mb_strlen($digitsOnly) < 3) {
            return [];
        }

        return Enrollment::query()
            ->where(function ($query) use ($search): void {
                $digitsOnly = preg_replace('/\D/', '', $search) ?? '';

                $query->where('rsbsa_reference_number', 'like', '%'.$search.'%')
                    ->orWhereRaw("REPLACE(rsbsa_reference_number, '-', '') like ?", ['%'.$digitsOnly.'%']);
            })
            ->limit(10)
            ->get()
            ->map(fn (Enrollment $enrollment): array => [
                'id' => $enrollment->id,
                'rsbsa_reference_number' => $enrollment->rsbsa_reference_number,
                'full_name' => trim(collect([
                    $enrollment->first_name,
                    $enrollment->middle_name,
                    $enrollment->surname,
                ])->filter()->implode(' ')),
                'barangay' => $enrollment->address_barangay,
                'municipality' => $enrollment->address_municipality_city,
                'has_insurance_registered' => (bool) $enrollment->has_insurance_registered,
            ])
            ->all();
    }

    public function getMessageProperty(): string
    {
        $search = trim($this->query);
        $digitsOnly = preg_replace('/\D/', '', $search) ?? '';

        if ($search === '') {
            return 'Type your RSBSA number to search.';
        }

        if (mb_strlen($digitsOnly) < 3) {
            return 'Enter at least 3 digits to search.';
        }

        if (empty($this->results)) {
            return 'No enrollment found for that RSBSA number.';
        }

        $hasEligibleResult = collect($this->results)->contains(
            fn (array $item): bool => ($item['has_insurance_registered'] ?? false) === true
        );

        if (! $hasEligibleResult) {
            return 'Record found, but no registered insurance. You cannot apply yet.';
        }

        return 'Select your record below.';
    }

    public function getMessageIsErrorProperty(): bool
    {
        $digitsOnly = preg_replace('/\D/', '', trim($this->query)) ?? '';

        return mb_strlen($digitsOnly) >= 3 && empty($this->results);
    }

    public function updatedQuery(string $value): void
    {
        $this->query = $this->formatRsbsaQuery($value);
    }

    protected function loadSelectedEnrollment(int $enrollmentId): void
    {
        $enrollment = Enrollment::query()
            ->whereKey($enrollmentId)
            ->where('has_insurance_registered', true)
            ->first();

        if (! $enrollment) {
            $this->selectedEnrollmentId = null;
            $this->selectedEnrollment = null;

            return;
        }

        $this->selectedEnrollmentId = $enrollment->id;
        $this->selectedEnrollment = [
            'id' => $enrollment->id,
            'rsbsa_reference_number' => $enrollment->rsbsa_reference_number,
            'full_name' => trim(collect([
                $enrollment->first_name,
                $enrollment->middle_name,
                $enrollment->surname,
            ])->filter()->implode(' ')),
            'barangay' => $enrollment->address_barangay,
            'municipality' => $enrollment->address_municipality_city,
        ];
    }

    public function render()
    {
        return view('livewire.claim-rsbsa-search', [
            'results' => $this->results,
            'message' => $this->message,
            'messageIsError' => $this->messageIsError,
        ]);
    }

    protected function formatRsbsaQuery(string $value): string
    {
        $digits = preg_replace('/\D/', '', $value) ?? '';
        $digits = mb_substr($digits, 0, 13);

        $parts = [
            mb_substr($digits, 0, 2),
            mb_substr($digits, 2, 2),
            mb_substr($digits, 4, 2),
            mb_substr($digits, 6, 3),
            mb_substr($digits, 9, 4),
        ];

        return collect($parts)->filter()->implode('-');
    }
}
