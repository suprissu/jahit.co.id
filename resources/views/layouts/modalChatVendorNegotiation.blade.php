<div class="modal fade pl-0" id="chatVendorNegotiation" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="auth-form" method="POST" action="">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span id="negotiation-project-id-text" class="badge badge-danger"></span>
                    <h4 id="negotiation-project-name-text">Null</h4>
                    <input name="project-id" id="negotiation-project-id" type="text" style="display: none;" >
                    <div class="form-group">
                        <label for="negotiation-project-price">Harga Proyek</label>
                        <input name="project-price" placeholder="Masukkan harga proyek di sini" type="number" class="form-control" id="negotiation-project-price" aria-describedby="priceHelp">
                    </div>
                    <div class="form-group">
                        <label for="negotiation-project-startDate">Mulai Pengerjaan</label>
                        <input name="project-startDate" placeholder="Masukkan mulai pengerjaan di sini" type="date" class="form-control" id="negotiation-project-startDate" aria-describedby="startDateHelp">
                    </div>
                    <div class="form-group">
                        <label for="negotiation-project-endDate">Selesai Pengerjaan</label>
                        <input name="project-endDate" placeholder="Masukkan deadline di sini" type="date" class="form-control" id="negotiation-project-endDate" aria-describedby="deadlineHelp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>