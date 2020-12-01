<div class="modal fade pl-0" id="revisionAccept" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="auth-form" method="POST" action="">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span id="revision-project-id-text" class="badge badge-danger"></span>
                    <h4 id="revision-project-name-text">Persetujuan Revisi Proyek</h4>
                    <p id="revision-project-description-text">Apakah kamu menyetujui untuk mengerjakan revisi proyek?</p>
                    <input name="revision-project-id" id="revision-project-id" type="text" style="display: none;" >
                    <input name="revision-project-accept" id="revision-project-accept" type="text" value="1" style="display: none;" >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Oke</button>
                </div>
            </form>
        </div>
    </div>
</div>