<div class="col-4">
    <b>{{ $name }}:</b>
    @if ($isMultiply === true)
        @foreach($filters as $filter)
            <input name="filter[{{ $filter->id }}]" value="{{ $id }}" type="checkbox" class="form-control" {{ isset($activeFilters[$filter->id]) ? "checked" : "" }} />
            {{ $filter->getValue() }}
        @endforeach
    @else
        <select class="form-control" name="filter-type[{{ $id }}]">
            <option value="0">All</option>
            @foreach($filters as $filter)
                <option value="{{ $filter->id }}"  {{ isset($activeFilters[$filter->id]) ? "selected" : "" }}>{{ $filter->getValue() }}</option>
            @endforeach
        </select>
    @endif
</div>
