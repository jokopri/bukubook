<div>
    <form method="POST" action="{{ $action }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">DELETE</button>
    </form>
</div>
