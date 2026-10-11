<form method="POST" action="{{route('logout')}}">
    @csrf
    <button
        type="submit"
        class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-red-600 cursor-pointer transition-colors duration-200"
    >
        <i class="fa fa-sign-out"></i>
        Logout
    </button>
</form>
