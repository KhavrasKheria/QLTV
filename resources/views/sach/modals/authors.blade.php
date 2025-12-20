@php
    $selectedTacGiaIds = $selectedTacGiaIds ?? [];
@endphp

<div class="modal fade" id="authorsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">✏️ Chọn tác giả</h5>
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row g-2">
                    @foreach ($tacGias as $tg)
                        <div class="col-6 col-md-4">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="{{ $tg->MaTG }}"
                                    id="author{{ $tg->MaTG }}"
                                    {{ in_array($tg->MaTG, $selectedTacGiaIds) ? 'checked' : '' }}
                                >
                                <label class="form-check-label"
                                       for="author{{ $tg->MaTG }}">
                                    {{ $tg->TenTG }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Đóng
                </button>
                <button type="button"
                        class="btn btn-primary"
                        id="saveAuthorsBtn">
                    Lưu
                </button>
            </div>

        </div>
    </div>
</div>
