<div class="modal fade pl-0" id="askSample" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="auth-form" method="POST" action="">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span id="project-id-text" class="badge badge-danger"></span>
                    <h4 id="project-name-text">Permintaan Sample</h4>
                    <p id="project-description-text">Permintaan sample akan membutuhkan akan dikenakan biaya. Apakah kamu ingin melanjutkan?</p>
                    <input name="project-id" id="project-id" type="text" style="display: none;" >
                    <input name="project-ask-sample" id="project-ask-sample" type="text" value="1" style="display: none;" >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Oke</button>
                </div>
            </form>
        </div>
    </div>
</div>