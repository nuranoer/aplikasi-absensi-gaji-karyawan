<div class="modal fade" id="{{ isset($id) ? $id : 'modalTambah'}}" tabindex="-1"
    aria-labelledby="{{ isset($id) ? $id : 'modalTambah'}}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ isset($route) ? $route : route('admin.karyawan.store') }}" method="POST">
            @csrf
            @method(isset($method) ? $method : 'POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ isset($id) ? $id : 'modalTambah'}}Label">
                        {{ isset($title) ? $title : "Tambah Karyawan" }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-12">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Cth: Heisenberg"
                            value="{{ isset($modal_data) ? $modal_data->nama : '' }}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Cth: angkasa@gmail.com"
                            value="{{ isset($modal_data) ? $modal_data->email : '' }}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="password">Password</label>
                        <input minlength="6" type="password" name="password" id="password" class="form-control" {{isset($modal_data)? 'disabled':'required'}}>
                    </div>
                    <div class="col-md-6">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="Laki-laki" {{ isset($modal_data) && $modal_data->jenis_kelamin == "Laki-laki" ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ isset($modal_data) && $modal_data->jenis_kelamin == "Perempuan" ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" class="form-control"
                            placeholder="Cth: System Management"
                            value="{{ isset($modal_data) ? $modal_data->jabatan : '' }}" required>
                    </div>
                    <div class="col-md-12">
                        <label>Alamat</label>
                        <textarea name="alamat" id="edit-alamat" class="form-control" rows="5"
                            placeholder="Cth: Heisenberg">{{ isset($modal_data) ? $modal_data->alamat : '' }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>