<div style="display: none" class="modal-container">
    <div class="modal">
        <div class="modal-card">
            <h3>{{ $title }}</h3>
            <p>{{ $description }}</p>
            <div class="action flex_align">
                <button onclick="closeModal()" class="modal-cancel">{{ $cancel ?? 'Cancel' }}</button>
                <button class="modal-ok">{{ $ok }}</button>
            </div>
        </div>
        <span onclick="closeModal()" class="material-icons">close</span>
    </div>
</div>