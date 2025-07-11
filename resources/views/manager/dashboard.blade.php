<x-manager-system-app-layout>
    @push('scripts')
        <script>
            console.log('foo');
        </script>
    @endpush

    <x-slot name="view_name">
        ダッシュボード
    </x-slot>

    <div class="content-area" style="width: 500px;">

    </div>
</x-manager-system-app-layout>
