
<div class="modal" id="modal_confirm_ajax" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirm_title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><span id="confirm_titlecaption"></span> <span class="fw-bold" id="confirm_titlename"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="form-cofirm" class="btn btn-primary confirm_submit" id="confirm_titlebtn"></button>
        <form id="form-cofirm" method="POST" action="">
          <input name="id" id="id" type="hidden">
          <input name="paslon1" id="paslon1" type="hidden">
          <input name="paslon2" id="paslon2" type="hidden">
          <input name="paslon3" id="paslon3" type="hidden">
          <input id="title" type="hidden">
        </form>
      </div>
    </div>
  </div>
</div>