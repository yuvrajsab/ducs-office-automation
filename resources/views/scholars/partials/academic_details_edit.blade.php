<div class="mb-4">
    <add-remove-elements :existing-elements ="{{ is_array(old('authors')) ? json_encode(old('authors')) : json_encode($paper->authors)}}">
        <template v-slot="{ elements, addElement, removeElement }">
            <div class="flex items-baseline mb-2">
                <label for="authors[]" class="form-label block mb-1">
                    Authors <span class="text-red-600">*</span>
                </label>
                <button v-on:click.prevent="addElement" class="ml-auto btn is-sm text-blue-700 bg-gray-300">+</button>
            </div>
            <div v-for="(element, index) in elements" :key="index" class="flex items-baseline">
                <input type="text" v-model= "element.value" name="authors[]" class="form-input block mb-2 w-full">
                <button v-on:click.prevent="removeElement(index)" v-if="elements.length > 1" class="btn is-sm ml-2 text-red-600">x</button>
            </div>
        </template>
    </add-remove-elements>
</div>
<div class="mb-4">
    <label for="title" class="form-label block mb-1">
        Title <span class="text-red-600">*</span>
    </label>
    <input type="text" value="{{ old('title', $paper->title) }}" name="title" 
        class="form-input w-full {{ $errors->has('title') ? ' border-red-600' : ''}}">
</div>
<div class="flex mb-4">
    <div class="w-1/2">
        <label for="date" class="form-label block mb-1">
            Date <span class="text-red-600">*</span>
        </label>
        <input type="date" value="{{ old('date', $paper->date) }}" name="date" 
            class="form-input w-full {{ $errors->has('date') ? ' border-red-600' : ''}}">
    </div>
    <div class="ml-4 w-1/2">
        <label for="volume" class="form-label block mb-1">
            Volume 
        </label>
        <input type="number" value="{{ old('volume', $paper->volume) }}" name="volume" 
            class="form-input w-full {{ $errors->has('volume') ? ' border-red-600' : ''}}">
    </div>
</div>
<div class="mb-4">
    <label for="venue[]" class="form-label block mb-1">
        Venue <span class="text-red-600">*</span>
    </label>
    <div class="flex">
        <input type="text" value="{{ old('venue.city', $paper->venue['city']) }}" name="venue[city]" 
            class="form-input text-sm w-full {{ $errors->has('venue[city]') ? ' border-red-600' : ''}}">
        <input type="text" value="{{ old('venue.country', $paper->venue['country']) }}" name="venue[country]" 
            class="form-input text-sm w-full ml-4 {{ $errors->has('venue[country]') ? ' border-red-600' : ''}}">
    </div>
</div>
<div class="flex mb-4">
    <div class="w-1/2">
        <label for="number" class="form-label block mb-1">
            Number 
        </label>
        <input type="number" value="{{ old('number', $paper->number) }}" name="number" 
            class="form-input w-full {{ $errors->has('number') ? ' border-red-600' : ''}}">
    </div>
    <div class="ml-4 w-1/2">
        <label for="publisher" class="form-label block mb-1">
            Publisher <span class="text-red-600">*</span>
        </label>
        <input type="text" value="{{ old('publisher', $paper->publisher) }}" name="publisher" 
            class="form-input w-full {{ $errors->has('publisher') ? ' border-red-600' : ''}}">
    </div>
</div>
<div class="mb-4">
    <label for="page_numbers[]" class="form-label block mb-1">
        Page Numbers <span class="text-red-600">*</span>
    </label>
    <div class="flex">
        <input type="number" value="{{ old('page_numbers.from', $paper->page_numbers['from']) }}" name="page_numbers[from]" 
            class="form-input text-sm w-1/2 {{ $errors->has('page_numbers[from]') ? ' border-red-600' : ''}}">
        <input type="number" value="{{ old('page_numbers.to', $paper->page_numbers['to']) }}" name="page_numbers[to]" 
            class="form-input text-sm w-1/2 ml-4 {{ $errors->has('page_numbers[to]') ? ' border-red-600' : ''}}">
    </div>
</div>
<div class="mb-4">
    <label for="indexed_in[]" class="form-label block mb-1">
        Indexed In <span class="text-red-600">*</span>
    </label>
    @foreach ($indexedIn as $acronym => $index)
        <div class="flex mb-1">
            <input type="checkbox" name="indexed_in[]" value="{{$acronym}}" 
                {{ in_array($acronym, $paper->indexed_in) || 
                    (is_array(old('indexed_in')) && in_array( $acronym, old('indexed_in'))) 
                    ? 'checked': ''}} > 
            <label for="{{ $acronym }}" class="ml-2 form-label is-sm"> {{ $index }}</label>
        </div>
    @endforeach
</div>
<div class="mb-4">
    <label for="conference" class="form-label block mb-1">
        Conference <span class="text-red-600">*</span>
    </label>
    <input type="text" value="{{ old('conference', $paper->conference) }}" name="conference" 
        class="form-input w-full {{ $errors->has('conference') ? ' border-red-600' : ''}}">
</div>
<div class="mt-6">
    <button type="submit" class="w-full btn btn-magenta">Update</button>
</div>