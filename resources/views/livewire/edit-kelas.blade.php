<div>
    <div class="card my-3">
        <div class="card-body">
            <span style="font-size: 12pt">Nama Kelas</span>
            <div class="form-floating">
                <input type="Text" name="kelas" class="form-control" id="NamaKelas" placeholder="{{ $kelas }}"
                    wire:model="kelas">
                <label for="NamaKelas">{{ $kelas }}</label>
            </div>
        </div>
    </div>
    <div class="card my-3">
        <div class="card-body">
            <span style="font-size: 12pt">Wali Kelas</span>
            <div class="form-floating">
                <input type="Text" name="waliKelas" class="form-control" id="NamawaliKelas"
                    placeholder="{{ $waliKelas }}" wire:model="waliKelas">
                <label for="NamawaliKelas">{{ $waliKelas }}</label>
            </div>
        </div>
    </div>
    <button wire:click="update" class="btn"
        style="background-color: rgb(103, 58, 183);color: rgba(255, 255, 255, 1);"
        onclick="location.reload();">Update</button>
</div>
