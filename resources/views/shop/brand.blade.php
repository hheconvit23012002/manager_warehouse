<form class=" col-1" >
    <input type="hidden" name="center_id" value="{{ $value }}">
    <button type="submit" class="d-flex flex-column rounded p-1 mt-2 mb-2" style="background-color: white;border: 1px solid rgb(138 131 131 / 97%);">
        <img src="{{ asset("storage/". $logo) }}" alt="..." class="img-thumbnail text-center rounded p-1" style="width: 100%;border: none">
        <span class="text-center w-100" style="font-size: 10px"><i>{{ $name }}</i></span>
    </button>
</form>
