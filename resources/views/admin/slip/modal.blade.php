<div class="modal fade" id="{{ $id ?? 'modalTambah' }}" tabindex="-1"
    aria-labelledby="{{ ($id ?? 'modalTambah') . 'Label' }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ isset($route) ? $route : route('admin.slip.store') }}" method="POST">
            @csrf
            @method(isset($method) ? $method:"POST")
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ ($id ?? 'modalTambah') . 'Label' }}">
                        {{ ($title ?? 'Tambah Slip Gaji') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="karyawan_id">Karyawan</label>
                            <select id="karyawan_id" name="karyawan_id" class="form-control" {{ isset($modal_data) ? 'disabled' : 'required' }}>
                                @foreach(App\Models\Karyawan::all() as $k)
                                    <option value="{{ $k->id }}" {{ isset($modal_data) && $modal_data->karyawan->id == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="periode_bulan">Periode Bulan</label>
                            @php
                                $bulan = isset($modal_data) ? $modal_data->periode_bulan : \Carbon\Carbon::now()->month;
                            @endphp

                            <select name="periode_bulan" id="periode_bulan" class="form-control">
                                <option value="1" {{ $bulan == 1 ? 'selected' : '' }}>Januari</option>
                                <option value="2" {{ $bulan == 2 ? 'selected' : '' }}>Februari</option>
                                <option value="3" {{ $bulan == 3 ? 'selected' : '' }}>Maret</option>
                                <option value="4" {{ $bulan == 4 ? 'selected' : '' }}>April</option>
                                <option value="5" {{ $bulan == 5 ? 'selected' : '' }}>Mei</option>
                                <option value="6" {{ $bulan == 6 ? 'selected' : '' }}>Juni</option>
                                <option value="7" {{ $bulan == 7 ? 'selected' : '' }}>Juli</option>
                                <option value="8" {{ $bulan == 8 ? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{ $bulan == 9 ? 'selected' : '' }}>September</option>
                                <option value="10" {{ $bulan == 10 ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ $bulan == 11 ? 'selected' : '' }}>November</option>
                                <option value="12" {{ $bulan == 12 ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="periode_tahun">Periode Tahun</label>
                            <input min="2000" type="number" name="periode_tahun" placeholder="Cth: 2025" class="form-control"
                                value="{{ isset($modal_data) ? $modal_data->periode_tahun : now()->year }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="gaji_pokok">Gaji Pokok</label>
                            <input id="gaji_pokok" type="number" name="gaji_pokok" class="form-control" placeholder="Cth: 1000"
                                value="{{ isset($modal_data) ? $modal_data->gaji_pokok : '' }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="tunjangan">Tunjangan</label>
                            <input id="tunjangan" type="number" name="tunjangan" class="form-control" placeholder="Cth: 1000" value={{ isset($modal_data) ? $modal_data->tunjangan : '' }}>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="keterangan">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" class="form-control"
                                rows="5">{{ isset($modal_data) ? $modal_data->keterangan : '' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>