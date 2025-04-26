<a href="{{ route('admin.pins.create') }}" class="btn btn-primary btn-sm mb-3">Add a pin</a>
@include('shared.success-message')
<div class="pin-container">
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Pin</th>
                <th>Category</th>
                <th>Description</th>
                <th>Image Link</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pins as $pin)
                <tr>
                    <td>{{ $pin->pin_name ?? 'N/A' }}</td>
                    <td>{{ $pin->pinCategory->category_name ?? 'N/A' }}</td>
                    <td>{{ $pin->pin_description ?? 'N/A' }}</td>
                    <td>{{ $pin->image_link ?? 'N/A' }}</td>
                    <td>{{ $pin->latitude ?? 'N/A' }}</td>
                    <td>{{ $pin->longitude ?? 'N/A' }}</td>
                    <td>{{ $pin->created_at ? $pin->created_at->diffForHumans() : 'N/A' }}</td>
                    <td>{{ $pin->updated_at ? $pin->updated_at->diffForHumans() : 'N/A' }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('admin.pins.edit', $pin->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('admin.pins.destroy', $pin->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this pin?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>