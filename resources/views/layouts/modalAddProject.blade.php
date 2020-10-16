<div class="modal fade pl-0" id="addProject" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="auth-form" method="POST" action="">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4>Tambah Proyek</h4>
                    <div class="form-group">
                        <label for="add-project-name">Nama Proyek</label>
                        <input type="text" class="form-control" id="add-project-name" aria-describedby="nameHelp">
                    </div>
                    <div class="form-group">
                        <label for="add-project-order">Jumlah Pesanan</label>
                        <select class="form-control">
                            <option value="">Pilih opsi</option>
                            <option value="Seragam Putih">Seragam Putih</option>
                            <option value="Seragam Kantoran">Seragam Kantoran</option>
                            <option value="Seragam TNI">Seragam TNI</option>
                            <option value="Seragam Pilot">Seragam Pilot</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add-project-order">Jumlah Pesanan</label>
                        <input type="text" class="form-control" id="add-project-order" aria-describedby="orderHelp">
                    </div>
                    <div class="form-group">
                        <label for="add-project-address">Alamat</label>
                        <input type="text" class="form-control" id="add-project-address" aria-describedby="addressHelp">
                    </div>
                    <div class="form-group">
                        <label for="add-project-note">Catatan</label>
                        <textarea type="text" class="form-control" id="add-project-note" aria-describedby="noteHelp" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="add-project-picture">Upload Gambar</label>
                        <div class="upload-files__container">
                            <div class="upload-files__wrapper">
                                <input class="upload-files__input" name="project_pict_path[]" id="add-project-picture" type="file" class="form-control @error('project_pict_path.0') is-invalid @enderror" value="{{ old('project_pict_path.0') }}" aria-describedby="pictureAddon" multiple>
                                <label for="add-project-picture" class="upload-files__add">Upload file</label>
                            </div>
                            <div class="upload-files__preview">
                            </div>
                        </div>
                        @error('project_pict_path.0')
                        <span class="invalid-feedback" role="alert">
                            Some files might have invalid format or more than 2,5MB.
                        </span>
                        @enderror
                        <small id="pictureAddon" class="form-text text-muted">Dapat pilih banyak gambar dengan menggunakan CTRL (PC) atau hold image satu per satu (HP)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>