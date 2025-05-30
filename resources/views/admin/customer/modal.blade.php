<!-- Modal Tambah/Edit Category -->
<div class="modal fade" id="modal_category" tabindex="-1" aria-labelledby="modalCompanyLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="category_form"> 
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCompanyLabel">Tambah Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"> 
          <div class="mb-3">
            <label for="name" class="form-label">Nama Category</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div> 
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" id="btnSaveCategory">
            Simpan
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
  