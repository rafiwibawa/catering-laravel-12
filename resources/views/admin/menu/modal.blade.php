<!-- Modal Tambah/Edit Menu -->
<div class="modal fade" id="modal_company" tabindex="-1" aria-labelledby="modalCompanyLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="menu_form" method="POST" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCompanyLabel">Tambah Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"> 
          <div class="row"> 
            <div class="col-md-6"> 
              <div class="mb-3">
                <label for="name" class="form-label">Nama Menu</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="diskon" class="form-label">Diskon (%)</label>
                <input type="number" class="form-control" id="diskon" name="diskon" min="0" max="100">
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select class="form-control" id="category_id" name="category_id" required>
                  <option value="">-- Pilih Kategori --</option>
                </select>
              </div>
            </div>
          </div>

          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_home" name="is_home" value="1">
            <label class="form-check-label" for="is_home">Tampilkan di Beranda</label>
          </div>
 
          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="image" name="image">
            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
            <div id="image_preview" class="mt-2"></div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
