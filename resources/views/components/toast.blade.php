@if(!empty($message))
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1090;">
        <div id="liveToast" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header {{ 
                ($type === 'success' || $type === 'danger') 
                    ? 'text-white bg-'.$type 
                    : 'bg-light text-dark' 
                }}">

                <i class="bi {{ $icon }} me-2 {{ 
                ($type === 'success' || $type === 'danger') 
                    ? 'text-white' 
                    : 'text-'.$type }}">
                </i>

                <strong class="me-auto">{{ $title }}</strong>
                <small class="{{ 
                    ($type === 'success' || $type === 'danger') 
                        ? 'text-white-50' 
                        : 'text-muted' 
                }}">À l'instant</small>
                
                <button type="button" class="btn-close {{ 
                ($type === 'success' || $type === 'danger') 
                    ? 'btn-close-white' 
                    : '' }}" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            
            <div class="toast-body bg-white text-dark">
                {{ $message }}
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('liveToast');
        if (toastEl && typeof bootstrap !== 'undefined') {
            var toast = new bootstrap.Toast(toastEl, { delay: 5000 }); // Disparaît après 5s
            toast.show();
        }
    });
</script>