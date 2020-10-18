<div class="modal fade pl-0" id="uploadPayment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="auth-form" method="POST" action="">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span id="payment-id-text" class="badge badge-danger"></span>
                    <h4 id="payment-name-text"></h4>
                    <h5 class="text-danger">Rp.<span id="payment-price-text"></span></h5>
                    <input name="payment-id" id="payment-id" style="display: none;"/>
                    <div class="form-group">
                        <label for="payment-pict">Upload Bukti Pembayaran</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label for="payment-pict" class="input-group-text" id="payment-pictAddon">Browse</label>
                            </div>
                            <div class="input-files">
                                <p class="input-files-filename">{{ old('payment-pict_link') }}</p>
                                <input placeholder="payment-pict_ahmadsupriyanto.jpg" name="payment-pict_link" id="payment-pict" type="file" class="form-control @error('payment-pict_link') is-invalid @enderror" value="{{ old('payment-pict_link') }}" aria-describedby="payment-pictAddon" required>
                            </div>
                        </div>
                        @error('payment-pict_link')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>