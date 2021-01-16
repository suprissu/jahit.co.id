<div class="modal fade pl-0" id="chatAccept" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="chat-negotiation-accept-form" class="auth-form" method="POST" action="">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span id="negotiation-project-id-text" class="badge badge-danger"></span>
                    <h4 id="negotiation-project-name-text">Persetujuan Negosiasi Proyek</h4>
                    <p id="negotiation-project-description-text">Apakah kamu menyetujui untuk negosiasi pada proyek ini?</p>
                
                    <input name="inboxID" class="negotiation-inbox-id" type="text" style="display: none;" required>
                    <input name="chatID" class="negotiation-chat-id" type="text" style="display: none;" required>
                    <input name="negotiationID" class="negotiation-negotiation-id" type="text" style="display: none;" required>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Oke</button>
                </div>
            </form>
        </div>
    </div>
</div>