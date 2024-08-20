<div class="modal first" id="successModal">
    <div class="modal-dialog success">
        <div class="modal-content success">
            <div class="modal-header success">
                <h5 class="modal-title">¡Acción Exitosa!</h5>
                <button class="close" onclick="closeModal('successModal')">&times;</button>
            </div>
            <div class="modal-body success">
				<i class="fa-solid fa-circle-check"></i>
                <p>{{ $slot }}</p>
            </div>
            <div class="modal-footer success">
                <button type="button" class="btn btn-secondary" onclick="closeModal('successModal')">Cerrar</button>
            </div>
        </div>
    </div>
</div>
