<div id="farmersSection" class="hidden">
    <x-label value="For Farmers" />
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1 bg-emerald-50/50 border border-emerald-900/5 rounded-xl p-4">
        <label class="inline-flex items-center"><input type="checkbox" name="farming_activities[]" value="rice" class="text-emerald-600"><span class="ml-2">Rice</span></label>
        <label class="inline-flex items-center"><input type="checkbox" name="farming_activities[]" value="corn" class="text-emerald-600"><span class="ml-2">Corn</span></label>
    </div>
    <div class="mt-3">
        <x-label value="Other Crops (specify)" />
        <div class="flex flex-wrap items-center border border-gray-300 rounded-md px-3 py-2 gap-2" id="cropChips"></div>
        <div class="mt-2 flex gap-2"><x-input id="cropInput" placeholder="Add crop..." class="flex-1" /><x-secondary-button type="button" id="addCropBtn">Add</x-secondary-button></div>
        <div id="cropHidden"></div>
    </div>
    <div class="mt-3">
        <x-label value="Livestock (specify)" />
        <div class="flex flex-wrap items-center border border-gray-300 rounded-md px-3 py-2 gap-2" id="livestockChips"></div>
        <div class="mt-2 flex gap-2"><x-input id="livestockInput" placeholder="Add livestock..." class="flex-1" /><x-secondary-button type="button" id="addLivestockBtn">Add</x-secondary-button></div>
        <div id="livestockHidden"></div>
    </div>
    <div class="mt-3">
        <x-label value="Poultry (specify)" />
        <div class="flex flex-wrap items-center border border-gray-300 rounded-md px-3 py-2 gap-2" id="poultryChips"></div>
        <div class="mt-2 flex gap-2"><x-input id="poultryInput" placeholder="Add poultry..." class="flex-1" /><x-secondary-button type="button" id="addPoultryBtn">Add</x-secondary-button></div>
        <div id="poultryHidden"></div>
    </div>
</div>

<div id="farmworkersSection" class="hidden">
    <x-label value="For Farmworkers" />
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1">
        @foreach (['Land preparation','Planting/Transplanting','Cultivation','Harvesting'] as $work)
            <label class="inline-flex items-center"><input type="checkbox" name="farmworker_kinds_of_work[]" value="{{ $work }}" class="text-emerald-600"><span class="ml-2">{{ $work }}</span></label>
        @endforeach
    </div>
    <div class="mt-3">
        <x-label value="Others, specify" />
        <div class="flex flex-wrap items-center border border-gray-300 rounded-md px-3 py-2 gap-2" id="fwOtherChips"></div>
        <div class="mt-2 flex gap-2"><x-input id="fwOtherInput" placeholder="Add other work..." class="flex-1" /><x-secondary-button type="button" id="addFwOtherBtn">Add</x-secondary-button></div>
        <div id="fwOtherHidden"></div>
    </div>
</div>

<div id="fisherfolkSection" class="hidden">
    <x-label value="For Fisherfolk" />
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-1">
        @foreach (['Fish capture','Fish Processing','Aquaculture','Fish Vending','Gleaning'] as $f)
            <label class="inline-flex items-center"><input type="checkbox" name="fishing_activities[]" value="{{ $f }}" class="text-emerald-600"><span class="ml-2">{{ $f }}</span></label>
        @endforeach
    </div>
    <div class="mt-3">
        <x-label value="Others, specify" />
        <div class="flex flex-wrap items-center border border-gray-300 rounded-md px-3 py-2 gap-2" id="fishOtherChips"></div>
        <div class="mt-2 flex gap-2"><x-input id="fishOtherInput" placeholder="Add other activity..." class="flex-1" /><x-secondary-button type="button" id="addFishOtherBtn">Add</x-secondary-button></div>
        <div id="fishOtherHidden"></div>
    </div>
</div>

<div id="agriYouthSection" class="hidden">
    <x-label value="For Agri Youth" />
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-1">
        @foreach ([
            'part of a farming household',
            'attending/attended formal agri-fishery related course',
            'attending/attended non-formal agri-fishery related course',
            'participated in any agricultural activity/program'
        ] as $y)
            <label class="inline-flex items-center"><input type="checkbox" name="agriyouth_involvements[]" value="{{ $y }}" class="text-emerald-600"><span class="ml-2">{{ $y }}</span></label>
        @endforeach
    </div>
    <div class="mt-3">
        <x-label value="Others, specify" />
        <div class="flex flex-wrap items-center border border-gray-300 rounded-md px-3 py-2 gap-2" id="youthOtherChips"></div>
        <div class="mt-2 flex gap-2"><x-input id="youthOtherInput" placeholder="Add involvement..." class="flex-1" /><x-secondary-button type="button" id="addYouthOtherBtn">Add</x-secondary-button></div>
        <div id="youthOtherHidden"></div>
    </div>
</div>


