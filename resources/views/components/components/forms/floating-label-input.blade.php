<div class="floating-label {{$class??''}} px-1">
    <label class="w-100">
        <input type="{{$type??'text'}}"
               class="w-100 {{$inputClass??'p-2'}}"
               name="{{$name??''}}"
               placeholder="{{$placeholder??' '}}" {{$inputAttributes??''}}
        >
        <span class="{{$labelClass??''}} px-1">
            {{$slot??''}}
        </span>
    </label>
</div>
