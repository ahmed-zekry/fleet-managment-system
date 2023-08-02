@props(['link'])
<div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 text-red-500">
    <form action="{{ url($link) }}" method="post" onsubmit="return confirm({{ __('Are you sure you want to delete this record?') }})">
        @csrf
        <button type="submit">
           <img src="/images/delete.png" />
        </button>
    </form>
</div>
