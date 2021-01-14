<div class="modal fade pl-0" id="uploadPayment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="upload-payment-form" class="auth-form" method="POST" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="payment-id-text badge badge-danger"></span>
                    <h5 class="text-danger">Rp.<span class="payment-price-text"></span></h5>

                    <input name="transactionID" class="transaction-id" type="text" style="display: none;" required>
                    <input name="deadline" class="deadline" type="text" style="display: none;" required>
                    
                    <div class="form-group">
                        <label for="payment-pict">Upload Bukti Pembayaran</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label for="payment-pict" class="input-group-text" id="payment-pictAddon">Browse</label>
                            </div>
                            <div class="input-files">
                                <p class="input-files-filename">{{ old('payment_slip_path') }}</p>
                                <input placeholder="payment-pict_ahmadsupriyanto.jpg" name="payment_slip_path" id="payment-pict" type="file" class="form-control @error('payment_slip_path') is-invalid @enderror" value="{{ old('payment_slip_path') }}" aria-describedby="payment-pictAddon" required>
                            </div>
                        </div>
                        @error('payment_slip_path')
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