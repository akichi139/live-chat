<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 items-center bg-white rounded-lg">
            @livewire('live-chat', ['user_id' => $user_id])
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    Livewire.on('userChanged', user_id => {
        alert('User change to the id of: ' + user_id);
    })
</script>
@endpush
