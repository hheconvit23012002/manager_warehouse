<table class="table table-centered mb-0" style="overflow-x: scroll " id="{{ $idTable ?? ""}}">
    <thead>
        <tr>
            @if( $usingIndex ?? true )
                <th>#</th>
            @endif
            @foreach($field as $head => $value)
                <th>{{ $head }}</th>
            @endforeach
            @if(count($actions ?? []) > 0 )
                <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($data as $value)
            <tr>
            @if( $usingIndex ?? true )
                <td>{{ $loop->index+1 }}</td>
            @endif
            @foreach($field as $nameDisplay)
                    @if(str_contains($nameDisplay, 'image'))
                        <td>
                            <img src="{{ asset("storage/" . $value->$nameDisplay) }}"  height="100" width="100">
                        </td>
                    @elseif(str_contains($nameDisplay, 'link'))
                        <td>
                            <a href="{{ $value->$nameDisplay }}">View</a>
                        </td>
                    @elseif(str_contains($nameDisplay, 'note'))
                        <td>
                            @foreach($value->$nameDisplay as $note)
                                <button class="btn btn-primary rounded-pill">
                                    {{ $note->name }}
                                </button>
                            @endforeach
                        </td>
                    @elseif(str_contains($nameDisplay,'click'))
                        <td>
                            <button id="{{ $value->id }}" class="action-row">{{ $value->$nameDisplay }}</button>
                        </td>
                    @else
                        <td>{{ $value->$nameDisplay }}</td>
                    @endif

            @endforeach
                @if(count($actions ?? []) > 0 )
                    <td>
                        @foreach($actions as $name)
                            @php
                                $hiddenCondition = $name['hiddenCondition'] ?? null;
                                $hidden = is_null($hiddenCondition) ? false : $hiddenCondition($value);
                            @endphp
                            <button title="{{ $name['title'] ?? $name['onclick'] }}" class="{{ $name['classButton'] ?? 'btn' }} {{ $hidden ? 'd-none' : '' }}" id="{{ $name['classButton'] ?? '' }}" data-id="{{ $value->id }}" onclick="{{ isset($name['onclick']) ? $name['onclick'] . '(' .$value->id.')' : '' }}">
                                <a class="{{ $name['classLink'] ?? 'link' }}" href="{{ ($name['router'] ?? null) ? route($name['router'], ['id' => $value->id]) : '#' }}">
                                    <i class="{{ $name['icon'] }}"></i>
                                </a>
                            </button>
                        @endforeach
                    </td>
                @endif

            </tr>


        @endforeach

    </tbody>
</table>
