<div class="modal fade pl-0" id="chatNegotiation" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="chat-negotiation-form" class="auth-form" method="POST" action="">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span id="negotiation-project-id-text" class="badge badge-danger"></span>
                    <h4 class="negotiation-project-name-text">Negosiasi Proyek</h4>
                    
                    <input name="projectID" class="negotiation-project-id" type="text" style="display: none;" required>
                    <input name="customerID" class="negotiation-customer-id" type="text" style="display: none;" required>
                    <input name="partnerID" class="negotiation-partner-id" type="text" style="display: none;" required>
                    <input name="inboxID" class="negotiation-inbox-id" type="text" style="display: none;" required>
                    <input name="chatID" class="negotiation-chat-id" type="text" style="display: none;" required>

                    <div class="form-group">
                        <label for="negotiation-project-price">Harga Proyek</label>
                        <input name="cost" placeholder="Masukkan harga proyek di sini" type="number" class="form-control" id="negotiation-project-price" aria-describedby="priceHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="negotiation-project-startDate">Mulai Pengerjaan</label>
                        <input name="startDate" placeholder="Masukkan mulai pengerjaan di sini" type="date" class="form-control" id="negotiation-project-startDate" aria-describedby="startDateHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="negotiation-project-endDate">Selesai Pengerjaan</label>
                        <input name="deadline" placeholder="Masukkan deadline di sini" type="date" class="form-control" id="negotiation-project-endDate" aria-describedby="deadlineHelp" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>