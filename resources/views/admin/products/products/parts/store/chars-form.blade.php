
    @foreach($chars as $char)
        <div class="col-4">
            <div class="form-group">
                <label for="char-{{ $char->id }}">{{ $char->name }}</label>
                <input type="text" name="char_value_{{ $char->id }}" data-charID="{{ $char->id }}" class="form-control findChar">
                <input type="text" name="char_id_{{ $char->id }}" value="{{ $char->id }}" class="d-none">
            </div>
        </div>
    @endforeach
    <script>
        // $('.findChar').autocomplete({
        //     lookup: function (query, done) {
        //         // Do Ajax call or lookup locally, when done,
        //         // call the callback and pass your results:
        //         var result = {
        //             suggestions: [
        //                 { "value": "United Arab Emirates", "data": "AE" },
        //                 { "value": "United Kingdom",       "data": "UK" },
        //                 { "value": "United States",        "data": "US" }
        //             ]
        //         };
        //
        //         done(result);
        //     },
        //     onSelect: function (suggestion) {
        //         alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        //     }
        // });
    </script>

