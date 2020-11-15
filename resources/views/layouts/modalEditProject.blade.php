<div class="modal fade pl-0" id="editProject" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="auth-form" method="POST" action="">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 id="edit-project-name-text"></h4>
                    <h5 class="text-danger" id="edit-project-price-text"></h5>
                    <input name="project-id" id="edit-project-id" type="text" style="display: none;" >
                    <div class="form-group">
                        <label for="edit-project-name">Nama Proyek</label>
                        <input name="project-name" placeholder="Masukkan nama proyek di sini" type="text" class="form-control" id="edit-project-name" aria-describedby="nameHelp">
                    </div>
                    <div class="form-group">
                        <label for="edit-project-category">Kategori</label>
                        <select class="form-control" name="project-category" id="edit-project-category">
                            <option value="">Pilih opsi</option>
                            <option value="Seragam Putih">Seragam Putih</option>
                            <option value="Seragam Kantoran">Seragam Kantoran</option>
                            <option value="Seragam TNI">Seragam TNI</option>
                            <option value="Seragam Pilot">Seragam Pilot</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-project-order">Jumlah Pesanan</label>
                        <input name="project-order" placeholder="Masukkan jumlah pesanan di sini" type="number" class="form-control" id="edit-project-order" aria-describedby="orderHelp">
                    </div>
                    <div class="form-group">
                        <label for="edit-project-quotation">Jumlah Penawaran</label>
                        <input name="project-quotation" disabled placeholder="Masukkan jumlah penawaran di sini" type="number" class="form-control" id="edit-project-quotation" aria-describedby="quotationHelp">
                        <button class="btn btn-danger mt-1">Lihat Penawaran</button>
                    </div>
                    <div class="form-group">
                        <label for="edit-project-address">Alamat</label>
                        <input name="project-address" placeholder="Masukkan alamat di sini" type="text" class="form-control" id="edit-project-address" aria-describedby="addressHelp">
                    </div>
                    <div class="form-group">
                        <label for="edit-project-vendor">Vendor</label>
                        <input name="project-vendor" placeholder="Masukkan alamat di sini" type="text" class="form-control" id="edit-project-vendor" aria-describedby="addressHelp">
                    </div>
                    <div class="form-group">
                        <label for="edit-project-startDate">Mulai Pengerjaan</label>
                        <input name="project-startDate" placeholder="Masukkan mulai pengerjaan di sini" type="date" class="form-control" id="edit-project-startDate" aria-describedby="startDateHelp">
                    </div>
                    <div class="form-group">
                        <label for="edit-project-endDate">Selesai Pengerjaan</label>
                        <input name="project-endDate" placeholder="Masukkan deadline di sini" type="date" class="form-control" id="edit-project-endDate" aria-describedby="deadlineHelp">
                    </div>
                    <div class="form-group">
                        <label for="edit-project-note">Catatan</label>
                        <textarea name="project-note" placeholder="Masukkan catatan tambahan di sini" type="text" class="form-control" id="edit-project-note" aria-describedby="noteHelp" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-project-picture">Preview Gambar</label>
                        <div class="upload-files__container">
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
                    <button type="button" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>