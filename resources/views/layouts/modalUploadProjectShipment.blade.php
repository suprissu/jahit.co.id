<div class="modal fade pl-0" id="uploadProjectShipment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="upload-project-shipment-form" class="auth-form" method="POST" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="shipment-id-text badge badge-danger"></span>

                    <input name="projectID" class="project-id" type="text" style="display: none;" required>
                    
                    <div class="form-group">
                        <label for="shipment-pict">Upload Bukti Resi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label for="shipment-pict" class="input-group-text" id="shipment-pictAddon">Browse</label>
                            </div>
                            <div class="input-files">
                                <p class="input-files-filename">{{ old('shipment_receipt_path') }}</p>
                                <input placeholder="shipment-pict_ahmadsupriyanto.jpg" name="shipment_receipt_path" id="shipment-pict" type="file" class="form-control @error('shipment_receipt_path') is-invalid @enderror" value="{{ old('shipment_receipt_path') }}" aria-describedby="shipment-pictAddon" required>
                            </div>
                        </div>
                        @error('shipment_receipt_path')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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