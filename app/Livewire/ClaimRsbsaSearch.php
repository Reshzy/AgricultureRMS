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
        $this->query = trim($initialQuery);
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

        if (mb_strlen($search) < 3) {
            return [];
        }

        return Enrollment::query()
            ->where('has_insurance_registered', true)
            ->where(function ($query) use ($search): void {
                $query->where('rsbsa_reference_number', 'like', '%'.$search.'%')
                    ->orWhere('first_name', 'like', '%'.$search.'%')
                    ->orWhere('surname', 'like', '%'.$search.'%');
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
            ])
            ->all();
    }

    public function getMessageProperty(): string
    {
        $search = trim($this->query);

        if ($search === '') {
            return 'Type your RSBSA number or name to search.';
        }

        if (mb_strlen($search) < 3) {
            return 'Enter at least 3 characters to search.';
        }

        if (empty($this->results)) {
            return 'No insured enrollment found. Only enrollments with registered insurance can apply.';
        }

        return 'Select your record below.';
    }

    public function getMessageIsErrorProperty(): bool
    {
        return mb_strlen(trim($this->query)) >= 3 && empty($this->results);
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
}
