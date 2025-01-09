<div>
    <div class="form-floating mb-3">
        <select class="form-select" id="floatingTingkat" name="Tingkat" placeholder="Pilih Tingkat" wire:model="tingkat"
            wire:click="selectKelas">
            <option selected></option>
            <option {{ old("Tingkat")=="Kelas 10" ? "selected" : "" }}>Kelas 10</option>
            <option {{ old("Tingkat")=="Kelas 11" ? "selected" : "" }}>Kelas 11</option>
            <option {{ old("Tingkat")=="Kelas 12" ? "selected" : "" }}>Kelas 12</option>
        </select>
        <label for="floatingTingkat">Tingkat</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="floatingKelas" name="kelas" placeholder="Pilih Kelas" wire:model="kelasSelect">
            <option selected></option>
            <option>Pilih Kelas</option>
            @foreach ($kelas as $item)
            <option value="{{ $item->rombongan_belajar_id }}" {{ old("kelas")==$item->rombongan_belajar_id ? "selected":
                "" }}>{{ $item->kelas }}</option>
            @endforeach
        </select>
        <label for="floatingKelas">Data kelas kelas {{ $tingkat }}</label>
    </div>
</div>
