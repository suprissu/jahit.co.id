<div class="modal fade pl-0" id="chatInitiationReject" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="chat-initiation-reject-form" class="auth-form" method="POST" action="">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span id="negotiation-project-id-text" class="badge badge-danger"></span>
                    <h4 class="negotiation-project-name-text">Tolak Proyek</h4>

                    <input name="chatID" class="negotiation-chat-id" type="text" style="display: none;" required>

                    <p>Kamu akan menolak proyek ini. Apakah kamu dapat memberitahu kami kenapa kamu menolaknya?</p>
                    <div class="form-group">
                        <label for="initiation-reject-excuse">Alasan</label>
                        <textarea name="excuse" placeholder="Masukkan catatan tambahan di sini" type="text" class="form-control" id="initiation-reject-excuse" aria-describedby="noteHelp" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Proyek</button>
                </div>
            </form>
        </div>
    </div>
</div>