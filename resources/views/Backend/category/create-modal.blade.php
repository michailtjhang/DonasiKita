<div class="modal fade" id="modalCreate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Please Enter Category Name" value="{{ old('name') }}">
                        <small class="form-text text-muted">
                            *Masukkan nama yang jelas dan deskriptif untuk memudahkan pemahaman.*
                        </small>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="description">Category Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{!! old('description') !!}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="image">Category Image</label>
                        <input type="file" name="img" id="image"
                            class="form-control @error('img') is-invalid @enderror" placeholder="Please Enter Image"
                            value="{{ old('img') }}">
                        <small class="form-text text-muted">
                            *Unggah foto dengan ukuran maksimal 2MB dan format JPG, PNG, atau JPEG. Pastikan foto yang
                            diunggah jelas dan tidak mengandung unsur yang tidak pantas.*
                        </small>

                        @error('img')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
