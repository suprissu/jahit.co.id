<div class="modal fade pl-0" id="editProject" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="auth-form" method="POST" action="{{ route('home.customer.project.edit') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="badge badge-secondary" id="edit-project-status"></span>
                    <h4 id="edit-project-title"></h4>
                    <h5 class="text-danger" id="edit-project-amount"></h5>
                    <input name="id" id="edit-project-id" type="text" style="display: none;">
                    @error('id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="form-group">
                        <label for="edit-project-name">Nama Proyek</label>
                        <input name="name" placeholder="Masukkan nama proyek di sini" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="edit-project-name" aria-describedby="nameHelp" required autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit-project-category">Kategori</label>
                        <select class="form-control" name="category" id="edit-project-category" required>
                            @foreach( $categories as $category )
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit-project-order">Jumlah Pesanan</label>
                        <input name="count" placeholder="Masukkan jumlah pesanan di sini" type="number" class="form-control @error('count') is-invalid @enderror" value="{{ old('count') }}" id="edit-project-order" aria-describedby="orderHelp" required>
                        @error('count')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit-project-quotation">Jumlah Penawaran</label>
                        <input name="quotation" type="number" class="form-control" id="edit-project-quotation" aria-describedby="quotationHelp" disabled>
                        <button class="btn btn-danger mt-1" disabled>Lihat Penawaran</button>
                    </div>
                    <div class="form-group">
                        <label for="edit-project-address">Alamat</label>
                        <input name="address" placeholder="Masukkan alamat di sini" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" id="edit-project-address" aria-describedby="addressHelp" required autocomplete="address">
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit-project-vendor">Vendor</label>
                        <input name="project-vendor" placeholder="Masukkan alamat di sini" type="text" class="form-control" id="edit-project-vendor" aria-describedby="addressHelp">
                    </div>
                    <div class="form-group">
                        <label for="edit-project-startDate">Mulai Pengerjaan</label>
                        <input name="startDate" type="date" class="form-control" id="edit-project-startDate" aria-describedby="startDateHelp" disabled>
                    </div>
                    <div class="form-group">
                        <label for="edit-project-endDate">Selesai Pengerjaan</label>
                        <input name="deadline" placeholder="Masukkan deadline di sini" type="date" class="form-control" id="edit-project-endDate" aria-describedby="deadlineHelp" disabled>
                    </div>
                    <div class="form-group">
                        <label for="edit-project-note">Catatan</label>
                        <textarea name="note" placeholder="Masukkan catatan tambahan di sini" type="text" class="form-control" id="edit-project-note" aria-describedby="noteHelp" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-project-picture">Preview Gambar</label>
                        <div class="upload-files__container">
                        </div>
                        @error('project_pict_path.0')
                        <span class="invalid-feedback" role="alert">
                            Some files might have invalid format or more than 2,5MB.
                        </span>
                        @enderror
                        <small id="pictureAddon" class="form-text text-muted">Dapat pilih banyak gambar dengan menggunakan CTRL (PC) atau hold image satu per satu (HP)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>