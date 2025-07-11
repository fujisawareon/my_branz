<header class="bg-white">
    {{-- Logo --}}
    <div class="display-container flex flex-between-center h-full">
        <a href="{{ route('manager_dashboard') }}">
            <img src="/image/MyBRANZ_logo.svg" class="block h-9 w-auto" alt="MyBRANZ Logo" />
        </a>
        <div>
            <div>ようこそ&nbsp;{{ Auth::guard('managers')->user()->user_name }}&nbsp;さん</div>
        </div>
    </div>
</header>
