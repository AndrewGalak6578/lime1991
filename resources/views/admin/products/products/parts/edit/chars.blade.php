<section>
    @if($product->chars)
    <div class="row">
        @foreach($product->chars as $char)
					<div class="col-4">
							<div class="form-group">
									<label for="char-{{$char['charId']}}">{{ $char['name'] }}</label>
									<input type="text" value="{{ $char['value'] }}" name="char_value_{{$char['charId']}}" data-charID="{{$char['charId']}}" class="form-control findChar">
									<input type="text" name="char_id_{{$char['charId']}}" value="{{$char['charId']}}" class="d-none">
							</div>
					</div>
        @endforeach
    </div>
    @endif
</section>
