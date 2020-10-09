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
                        <label for="project-name">Nama Proyek</label>
                        <input type="text" class="form-control" id="project-name" aria-describedby="nameHelp">
                    </div>
                    <div class="form-group">
                        <label for="project-order">Jumlah Pesanan</label>
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
                        <input type="text" class="form-control" id="project-order" aria-describedby="orderHelp">
                    </div>
                    <div class="form-group">
                        <label for="project-address">Alamat</label>
                        <input type="text" class="form-control" id="project-address" aria-describedby="addressHelp">
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
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>