<?php

namespace App\Http\Requests;

use App\Models\Claim;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClaimRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'enrollment_id' => [
                'required',
                'integer',
                Rule::exists('enrollments', 'id')
                    ->where(fn (Builder $query): Builder => $query->where('has_insurance_registered', true)),
            ],
            'claim_type' => ['required', 'string', Rule::in(Claim::claimTypes())],
            'contact_email' => ['required', 'string', 'email:rfc,dns', 'max:255'],
            'documents' => ['required', 'array'],
            'documents.*' => ['nullable', 'array', 'max:5'],
            'documents.*.*' => [
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:5120',
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'enrollment_id.exists' => 'Only enrollments with registered insurance can apply claims.',
        ];
    }

    /**
     * @return array<int, Closure>
     */
    public function after(): array
    {
        return [
            function ($validator): void {
                $claimType = (string) $this->input('claim_type');
                $requirements = Claim::requirementsFor($claimType);
                $documents = (array) $this->input('documents', []);

                foreach ($requirements as $documentKey => $label) {
                    $uploadedFiles = $this->file('documents.'.$documentKey, []);
                    $documentPayload = $documents[$documentKey] ?? null;

                    if (empty($uploadedFiles) && empty($documentPayload)) {
                        $validator->errors()->add(
                            'documents.'.$documentKey,
                            $label.' is required for this claim type.'
                        );
                    }
                }
            },
        ];
    }
}
