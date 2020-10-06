<div class="modal fade pl-0" id="editProject" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="auth-form" method="POST" action="">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="badge badge-secondary">Menunggu Pembayaran</span>
                    <h4>Penyelenggara Relawan COVID</h4>
                    <h5 class="text-danger">Rp.1.300.000</h5>
                    <div class="form-group">
                        <label for="project-category">Kategori</label>
                        <select class="form-control">
                            <option value="">Pilih opsi</option>
                            <option value="Seragam Putih">Seragam Putih</option>
                            <option value="Seragam Kantoran">Seragam Kantoran</option>
                            <option value="Seragam TNI">Seragam TNI</option>
                            <option value="Seragam Pilot">Seragam Pilot</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="project-order">Jumlah Pesanan</label>
                        <input placeholder="Masukkan jumlah pesanan di sini" type="text" class="form-control" id="project-order" aria-describedby="orderHelp">
                    </div>
                    <div class="form-group">
                        <label for="project-quotation">Jumlah Penawaran</label>
                        <input placeholder="Masukkan jumlah penawaran di sini" type="text" class="form-control" id="project-quotation" aria-describedby="quotationHelp">
                        <button class="btn btn-danger mt-1">Lihat Penawaran</button>
                    </div>
                    <div class="form-group">
                        <label for="project-address">Alamat</label>
                        <input placeholder="Masukkan alamat di sini" type="text" class="form-control" id="project-address" aria-describedby="addressHelp">
                    </div>
                    <div class="form-group">
                        <label for="project-address">Vendor</label>
                        <input placeholder="Masukkan alamat di sini" type="text" class="form-control" id="project-address" aria-describedby="addressHelp">
                    </div>
                    <div class="form-group">
                        <label for="project-startDate">Mulai Pengerjaan</label>
                        <input placeholder="Masukkan mulai pengerjaan di sini" type="text" class="form-control" id="project-startDate" aria-describedby="startDateHelp">
                    </div>
                    <div class="form-group">
                        <label for="project-deadline">Deadline</label>
                        <input placeholder="Masukkan deadline di sini" type="text" class="form-control" id="project-deadline" aria-describedby="deadlineHelp">
                    </div>
                    <div class="form-group">
                        <label for="project-note">Catatan</label>
                        <textarea type="text" class="form-control" id="project-note" aria-describedby="noteHelp" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="project-picture">Upload Gambar</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label for="project-picture" class="input-group-text" id="pictureAddon">Browse</label>
                            </div>
                            <div class="input-files">
                                <p class="input-files-filename"></p>
                                <input id="project-picture" type="file" class="form-control" aria-describedby="pictureAddon">
                            </div>
                        </div>
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