<div class="flex space-x-2">
    <a href="{{ route('categories.edit', $id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
    <form action="{{ route('categories.destroy', $id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
    </form>
</div>