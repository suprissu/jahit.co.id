<div class="modal fade pl-0" id="revisionReject" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="chat-revision-reject-form" class="auth-form" method="POST" action="">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span id="revision-project-id-text" class="badge badge-danger"></span>
                    <h4 id="revision-project-name-text">Null</h4>
                    <input name="project-id" id="revision-project-id" type="text" style="display: none;" >
                    <p>Kamu akan menolak revisi proyek. Apakah kamu dapat memberitahu kami kenapa kamu menolaknya?</p>
                    <div class="form-group">
                        <label for="revision-reject-excuse">Alasan</label>
                        <textarea name="revision-reject-excuse" placeholder="Masukkan catatan tambahan di sini" type="text" class="form-control" id="revision-reject-excuse" aria-describedby="noteHelp" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Revisi</button>
                </div>
            </form>
        </div>
    </div>
</div>