<template id="parcelTemplate">
    <div class="p-4 border rounded-md grid grid-cols-1 md:grid-cols-3 gap-3 parcel-card">
        <div>
            <x-label value="Barangay" />
            <select class="w-full border-gray-300 rounded-md parcelBrgy"></select>
            <input type="hidden" name="parcels[INDEX][barangay]" />
        </div>
        <div>
            <x-label value="Municipality/City" />
            <select class="w-full border-gray-300 rounded-md parcelCity"></select>
            <input type="hidden" name="parcels[INDEX][municipality]" />
        </div>
        <x-input type="number" step="0.01" name="parcels[INDEX][total_farm_area_ha]" placeholder="Total Farm Area (ha)" />
        <x-input name="parcels[INDEX][ownership_document_no]" placeholder="Ownership Doc No" />
        <label class="inline-flex items-center"><input type="checkbox" name="parcels[INDEX][within_ancestral_domain]" value="1" class="text-emerald-600"><span class="ml-2">Within Ancestral Domain</span></label>
        <label class="inline-flex items-center"><input type="checkbox" name="parcels[INDEX][is_agrarian_reform_beneficiary]" value="1" class="text-emerald-600"><span class="ml-2">Agrarian Reform Beneficiary</span></label>
        <select name="parcels[INDEX][ownership_type]" class="border-gray-300 rounded-md">
            <option value="">Ownership Type</option>
            <option value="registered_owner">Registered Owner</option>
            <option value="tenant">Tenant</option>
            <option value="lessee">Lessee</option>
            <option value="others">Others</option>
        </select>
        <x-input name="parcels[INDEX][land_owner_name]" placeholder="Land Owner Name" disabled />
        <x-input name="parcels[INDEX][ownership_other_specify]" placeholder="Ownership Other (specify)" disabled />
        <div class="md:col-span-3 col-span-1">
            <x-label value="Items (Crop/Commodity/Livestock & Poultry)" />
            <div class="space-y-2 parcel-items"></div>
            <button type="button" class="addParcelItemBtn mt-2 px-3 py-2 rounded-lg bg-white hover:bg-emerald-50 text-emerald-900 border">Add Item</button>
        </div>
        <div class="flex gap-2">
            <button type="button" class="duplicateParcelBtn px-3 py-2 rounded-lg bg-white hover:bg-emerald-50 text-emerald-900 border">Duplicate</button>
            <button type="button" class="removeParcelBtn px-3 py-2 rounded-lg bg-white hover:bg-rose-50 text-rose-700 border">Remove</button>
        </div>
    </div>
</template>

<template id="parcelItemTemplate">
    <div class="p-3 border rounded parcel-item grid grid-cols-1 md:grid-cols-6 gap-2">
        <select name="parcels[PARIDX][items][ITEMIDX][kind]" class="border-gray-300 rounded-md kindSelect">
            <option value="crop">Crop/Commodity</option>
            <option value="livestock">Livestock</option>
            <option value="poultry">Poultry</option>
        </select>
        <x-input name="parcels[PARIDX][items][ITEMIDX][name]" placeholder="Name (e.g., Rice, Chicken, Cow)" />
        <x-input type="number" step="0.01" name="parcels[PARIDX][items][ITEMIDX][size_ha]" placeholder="Size (ha)" />
        <x-input type="number" name="parcels[PARIDX][items][ITEMIDX][num_of_head]" class="numOfHead" placeholder="No. of head" />
        <x-input name="parcels[PARIDX][items][ITEMIDX][farm_type]" placeholder="Farm type" />
        <div class="flex items-center gap-2">
            <label class="inline-flex items-center"><input type="checkbox" name="parcels[PARIDX][items][ITEMIDX][is_organic_practitioner]" value="1" class="text-emerald-600"><span class="ml-2">Organic Practitioner</span></label>
        </div>
        <div class="md:col-span-5">
            <x-input name="parcels[PARIDX][items][ITEMIDX][remarks]" placeholder="Remarks" />
        </div>
        <div class="flex gap-2">
            <x-secondary-button type="button" class="removeParcelItemBtn">Remove Item</x-secondary-button>
        </div>
    </div>
</template>


