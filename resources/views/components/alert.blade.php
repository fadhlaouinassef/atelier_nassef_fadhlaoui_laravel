<div class="alert alert-{{ in_array($type, ['success', 'error', 'info'], true) ? $type : 'info' }}" role="alert">
    {{ $slot }}
</div>
